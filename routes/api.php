<?php

use App\Http\Controllers\Api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("forgot", [AuthController::class, "forgotPassword"]);

Route::get("get-courses", [MainController::class, "getCourses"]);
Route::get("get-course/{id}", [MainController::class, "getSingleCourse"]);
Route::get("get-user/{id}", [MainController::class, "getUser"]);


Route::get("/", function (Request $request) {
    return "It Works";
});
