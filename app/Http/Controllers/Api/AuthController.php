<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\Api\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                "first_name" => "required|string|max:255",
                "last_name" => "required|string|max:255",
                "email" => "required|email|unique:users,email",
                "password" => "required|string|min:8",
            ]);
            //code...
            $user = User::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]);
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Registration failed",
                ])->setStatusCode(400, "Bad Request");
            }
            return response()->json([
                "status" => "success",
                "message" => "User registered successfully",
                "data" => $user
            ])->setStatusCode(201, "Created");

        } catch (\Exception $th) {
            //throw $th;
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            //code...
            $validated = $request->validate([
                "email" => "required|email",
                "password" => "required|min:8"
            ]);

            $getUser = User::where("email", "=", $request->email)->where("role", "=", "user")->first();
            if ($getUser && Hash::check($request->password, $getUser->password)) {
                $user = $getUser;
                return response()->json([
                    "status" => "success",
                    "message" => "Logged in successfully",
                    "data" => $user
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Incorrect credentials"
                ]);
            }
        } catch (\Exception $th) {
            //throw $th;
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage()
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            //code...
            // Implement forgot password logic here
            $request->validate([
                "email" => "required|email"
            ]);
            $email = $request->email;
            $findEmail = User::where("email", "=", $email)->count();
            if ($findEmail == 0) {
                return response()->json([
                    "status" => "error",
                    "message" => "Email not found"
                ])->setStatusCode(404, "Not Found");
            }
            $code = Str::random(6);
            $sendMail = Mail::to($email)->send(new ForgotPassword($code));
            if ($sendMail != null) {
                // You can save the code to the database or perform other actions here
                return response()->json([
                    "status" => "success",
                    "message" => "Reset code sent to your email",
                    "data" => [
                        "code" => $code,
                        "email" => $email
                    ]
                ])->setStatusCode(200, "OK");
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Failed to send reset code"
                ]);

            }
        } catch (\Exception $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage()
            ]);
        }
    }

    public function resendCode(Request $request)
    {
        // Implement resend code logic here
        try {
            // Implement forgot password logic here
            $request->validate([
                "email" => "required|email",
                "code" => "required|min:6"
            ]);
            $email = $request->email;
            $findEmail = User::where("email", "=", $email)->count();
            if ($findEmail == 0) {
                return response()->json([
                    "status" => "error",
                    "message" => "Email not found"
                ])->setStatusCode(404, "Not Found");
            }
            $code = Str::random(6);
            $sendMail = Mail::to($email)->send(new ForgotPassword($code));
            if ($sendMail != null) {
                // You can save the code to the database or perform other actions here
                return response()->json([
                    "status" => "success",
                    "message" => "Reset code resent to your email",
                    "data" => [
                        "code" => $code,
                        "email" => $email
                    ]
                ])->setStatusCode(200, "OK");
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Failed to resend reset code"
                ]);

            }
        } catch (\Exception $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage()
            ]);
        }

        // CC296924832939GC
    }

    public function resetPassword(Request $request)
    {
        // Implement reset password logic here
        try {
            //code...
            $request->validate([
                "password" => "required|min:8"
            ]);
            $user = User::update([
                "password" => bcrypt($request->password)
            ]);

            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Password update failed",
                ])->setStatusCode(400, "Bad Request");
            }
            return response()->json([
                "status" => "success",
                "message" => "Password updated successfully",
                "data" => $user
            ])->setStatusCode(200, "OK");
        } catch (\Exception $th) {
            //throw $th;
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
            ])->setStatusCode(400, "Bad Request");
        }

    }
}
