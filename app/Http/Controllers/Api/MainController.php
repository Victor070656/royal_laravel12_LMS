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






    public function buyCourse(Request $request, $courseId, $userId)
    {
        $user = User::whereId($userId)->first();

        if (!$user || $user->role !== 'user') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Only users can buy courses.',
            ], 403);
        }

        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found.',
            ], 404);
        }

        // Check if already purchased
        $existingOrder = $course->orders()->where('user_id', $user->id)->first();

        if ($existingOrder) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already purchased this course.',
            ], 409);
        }

        $callbackUrl = route('api.verify.payment', ['id' => $userId, "courseId" => $courseId]);

        // Initialize payment with Flutterwave
        $paymentResponse = $this->payWithFlutter(
            $user->first_name,
            $user->last_name,
            $user->email,
            $course->price,
            $callbackUrl
        );

        if ($paymentResponse['status'] !== 'success') {
            return response()->json([
                'status' => 'error',
                'message' => $paymentResponse['message'],
                'data' => $paymentResponse['data'] ?? null,
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payment link generated successfully.',
            "data" => [
                'link' => $paymentResponse['link'],
                'tx_ref' => $paymentResponse['tx_ref'],
            ],
        ]);
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
                'currency' => $currency,
                'redirect_url' => $callback_url,
                'customer' => [
                    'email' => $email,
                    'name' => $first_name . " " . $last_name
                ],
                'customizations' => [
                    'title' => 'Royal Educity',
                    'description' => 'Payment for course',
                ],
            ];

            \Log::info('Payment data prepared', $data);

            $payment = Flutterwave::initializePayment($data);
            $payment = (array) $payment;

            \Log::info('Payment response received', $payment);

            if ($payment['status'] !== 'success') {
                \Log::error('Payment initialization failed', $payment);
                return [
                    'status' => 'error',
                    'message' => 'Payment initialization failed',
                    'data' => $payment,
                ];
            }

            $redirectUrl = $payment['data']['link'];
            \Log::info('Payment link: ' . $redirectUrl);

            return [
                'status' => 'success',
                'message' => 'Payment link generated',
                'link' => $redirectUrl,
                'tx_ref' => $reference,
            ];

        } catch (\Exception $e) {
            \Log::error('Payment error: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'An error occurred while processing payment',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function verifyPayment(Request $request, $id, $courseId)
    {


        // Verify with Flutterwave
        try {
            $transaction_id = $request->query("transaction_id");
            $tx_ref = $request->query("tx_ref");

            if (!$transaction_id || !$tx_ref) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing required parameters: transaction_id or tx_ref',
                ], 422);
            }

            $user = User::whereId($id)->first();

            $course = Course::find($courseId);
            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course not found.',
                ], 404);
            }
            $data = Flutterwave::verifyTransaction($transaction_id);
            \Log::info('Flutterwave verification data: ' . json_encode($data));
            // dd($data);
            if ($data['status'] !== 'success') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment verification failed at Flutterwave.',
                    'data' => $data,
                ], 400);
            }

            // Check if already ordered
            $existingOrder = $course->orders()->where('user_id', $user->id)->first();
            if ($existingOrder) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course already purchased.',
                ], 409);
            }

            // Create order
            $order = $course->orders()->create([
                'user_id' => $user->id,
                'amount' => $course->price,
                'reference' => $tx_ref,
            ]);

            // Send email notification
            try {
                Mail::to([
                    'support@royalsolutions.com.ng',
                    'ikechukwuv052@gmail.com'
                ])->send(new OrderPlaced($course));
            } catch (\Exception $e) {
                \Log::error('Error sending email: ' . $e->getMessage());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Payment verified and order created.',
                'data' => [
                    'order_id' => $order->id,
                    'course_id' => $course->id,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Payment verification error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while verifying payment.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
