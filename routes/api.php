<?php

use App\Http\Controllers\Api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// auth
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("forgot", [AuthController::class, "forgotPassword"]);

// main
Route::get("get-courses", [MainController::class, "getCourses"]);
Route::get("get-course/{id}", [MainController::class, "getSingleCourse"]);
Route::get("get-user/{id}", [MainController::class, "getUser"]);
Route::post("update-profile/{id}", [MainController::class, "updateProfile"]);
Route::get("get-orders/{id}", [MainController::class, "getOrders"]);
Route::get("get-order/{orderId}/{id}", [MainController::class, "getOrder"]);
Route::post("buy-course/{courseId}/{userId}", [MainController::class, "buyCourse"]);
Route::get("verify-payment/{id}/{courseId}", [MainController::class, "verifyPayment"])->name("api.verify.payment");


Route::get("/", function (Request $request) {
    return "It Works";
});

Route::get('/db-test', function () {
    try {
        \DB::connection()->getPdo();
        return '✅ DB Connected';
    } catch (\Exception $e) {
        return '❌ DB Connection failed: ' . $e->getMessage();
    }
});
