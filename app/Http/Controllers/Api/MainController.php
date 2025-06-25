<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

// flutterwave rave
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
use Illuminate\Support\Facades\Mail;

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
    public function getCourses(Request $request)
    {
        $course = Course::latest()->get();
        $course->load(
            [
                'user', // Eager load user and their profile
                'categories', // Eager load category and its parent category
                'orders', // Eager load orders and their order items
                'review' // Assuming 'reviews' is a new relationship on the Course model
            ]
        );
        try {
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
