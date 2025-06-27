<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

// flutterwave rave
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function getUser($id)
    {
        try {
            //code...
            $user = User::whereId($id)->first();
            if ($user) {
                return response()->json([
                    "status" => "success",
                    "message" => "User Found",
                    "data" => $user
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "User Not Found",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
            ])->setStatusCode($th->getCode() ?? 400, "Bad request");
        }
    }

    public function updateProfile(Request $request, $id)
    {
        try {
            $user = User::whereId($id)->first();

            if ($user) {
                $rules = [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                    'photo' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
                    'phone' => ['nullable', 'string', 'max:255'],
                    'bio' => ['nullable', 'string'],
                    'gender' => ['nullable', 'string'],
                    'address' => ['nullable', 'string'],
                    'city' => ['nullable', 'string'],
                    'country' => ['nullable', 'string'],
                    'day' => ['nullable', 'integer'],
                    'month' => ['nullable', 'string'],
                    'year' => ['nullable', 'integer'],
                ];

                $validated = $request->validate($rules);

                // Handle photo upload if present
                if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                    $photo = $request->file('photo');

                    // Ensure the destination folder exists
                    $destinationPath = public_path('uploads/photos');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Create a unique filename
                    $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();

                    // Move the file to public/uploads/photos
                    $photo->move($destinationPath, $filename);

                    // Save path in database (relative to public/)
                    $validated['photo'] = 'uploads/photos/' . $filename;
                } else {
                    // Preserve existing photo if none uploaded
                    $validated['photo'] = $user->photo;
                }

                // Update user
                $user->fill($validated);

                if ($user->isDirty('email')) {
                    $user->email_verified_at = null;
                }

                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully',
                    'data' => $user
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (\Exception $th) {
            //throw $th;
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }

    }

    public function getCourses(Request $request)
    {
        try {
            $course = Course::latest()->get();
            $course->load(
                [
                    'user', // Eager load user and their profile
                    'categories', // Eager load category and its parent category
                    'orders', // Eager load orders and their order items
                    'review' // Assuming 'reviews' is a new relationship on the Course model
                ]
            );
            if ($course->count() > 0) {
                return response()->json([
                    "status" => "success",
                    "message" => "Courses found",
                    "data" => $course
                ])->setStatusCode(200, "OK");
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Courses not found",
                ])->setStatusCode(404, "Not found");
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
            ])->setStatusCode(400);
        }
    }
    public function getSingleCourse(Request $request, $id)
    {
        try {
            //code...
            $course = Course::whereId($id)->first();
            if ($course) {
                $course->load(
                    [
                        'user', // Eager load user and their profile
                        'categories', // Eager load category and its parent category
                        'orders', // Eager load orders and their order items
                        'review', // Assuming 'reviews' is a new relationship on the Course model
                        "sections", // Eager load sections
                        "sections.courseContent", // Eager load courseContent in sections
                        "comments", // Eager load comments in courseContent
                        "comments.user", // Eager load user in comments
                    ]
                );
                return response()->json([
                    "status" => "success",
                    "message" => "Course Found",
                    "data" => $course
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Course Not Found",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
            ]);
        }
    }

    // order
    public function getOrders($id)
    {
        try {
            $order = Order::where("user_id", "=", $id)->get();
            if (isset($order) && $order->count() > 0) {
                return response()->json([
                    "status" => "success",
                    "message" => "Orders Found",
                    "data" => $order
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "No Order Found",
                ])->setStatusCode(404);
            }
        } catch (\Exception $th) {
            //throw $th;
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
            ]);
        }
    }


    public function payWithFlutter($first_name, $last_name, $email, $amount, $callback_url, $currency = "NGN")
    {
        \Log::info('Starting payment process');

        try {
            $reference = Flutterwave::generateReference();
            \Log::info('Generated reference: ' . $reference);

            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $amount,
                'email' => $email,
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => $callback_url,
                'customer' => [
                    'email' => $email,
                    "name" => $first_name . " " . $last_name
                ],
                "customizations" => [
                    "title" => 'Royal Educity',
                    "description" => "Payment for course",
                ]
            ];

            \Log::info('Payment data prepared', $data);

            $payment = Flutterwave::initializePayment($data);
            $payment = (array) $payment;
            \Log::info('Payment response received', $payment);

            // dd($payment);

            if ($payment['status'] !== 'success') {
                \Log::error('Payment initialization failed', $payment);
                return back()->with('error', 'Payment initialization failed');
            }

            $redirectUrl = $payment['data']['link'];
            \Log::info('Redirecting to: ' . $redirectUrl);
            // dd($payment);


            // return redirect()->away($redirectUrl, 301);
            return view("payment.flutterwave", [
                "url" => $redirectUrl,
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing payment');
        }
    }

    public function buyCourse(Request $request, Course $course)
    {
        $user = auth()->user();

        if ($user->role != "user") {
            return redirect()->route("home");
        }

        $email = $user->email;
        $price = $course->price;
        $check = $course->orders()->where("user_id", "=", $user->id)->first() ?? null;
        if (!$check) {

            // $this->makePayment($email, $price, route('home.course.pay', $course));
            // dd(route('home.course.pay', $course));
            $res = $this->payWithFlutter($user->first_name, $user->last_name, $email, $price, route('home.course.pay', $course));
            // dd($res);
            return $res;

        } else {
            return redirect()->route("home.course.details", $course)->with("error", "Course already bought by you!");
        }
    }

    public function payCourse(Request $request, Course $course)
    {
        // dd($request);
        $status = request()->status;

        //if payment is successful
        if ($status == 'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            // dd($data);
            if ($data["status"] == "success") {
                $order = $course->orders()->create([
                    "user_id" => auth()->user()->id,
                    "amount" => $course->price,
                    "reference" => $request->query('txref')
                ]);
                Mail::to([
                    "support@royalsolutions.com.ng",
                    "ikechukwuv052@gmail.com",
                    // $course->user->email
                ])
                    ->send(new OrderPlaced($course));

                if ($order) {
                    return redirect()->route("home.course.details", $course)->with("success", "Payment was successful!");
                } else {
                    return redirect()->route("home.course.details", $course)->with("error", "Order Failed!");
                }
            } else {
                return redirect()->route("home.course.details", $course)->with("error", "Order Failed. Something went wrong!");
            }

        } else {
            return redirect()->route("home.course.details", $course)->with("error", "Something went wrong!");
        }

    }
}
