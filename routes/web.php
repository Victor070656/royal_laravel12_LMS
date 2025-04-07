<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\InstructorController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', function () {
    return view('home.index');
})->name("home");

// student
Route::get('/dashboard', function () {
    return view('backend.student.dashboard');
})->middleware(['auth', 'verified', "isUser"])->name('dashboard');


// instructor
Route::get('/instructor', function () {
    return redirect('/instructor/dashboard');
});
Route::get("/instructor/dashboard", [InstructorController::class, "index"])->middleware(['auth', 'verified', "isInstructor"])->name("instructor.index");


// admin
Route::middleware(['auth', 'verified', "isAdmin"])->prefix("manager")->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get("/dashboard", [AdminController::class, "index"])->name("manager.index");
    Route::get("/users", [AdminController::class, "getUsers"])->name("manager.users.view");
    Route::post("/users/{user}/activate", [AdminController::class, "activateUser"])->name("manager.users.activate");
    Route::post("/users/{user}/deactivate", [AdminController::class, "deactivateUser"])->name("manager.users.deactivate");
    Route::get("/add-course", [AdminController::class, "addCourse"])->name("manager.course.add");
    Route::post("/add-course", [AdminController::class, "createCourse"])->name("manager.course.add");
    Route::get("/categories", [AdminController::class, "getCategories"])->name("manager.categories.index");
    Route::post("/categories", [AdminController::class, "createCategory"])->name("manager.categories.index");
    Route::get("/categories/{category}/edit", [AdminController::class, "editCategory"])->name("manager.categories.edit");
    Route::put("/categories/{category}/edit", [AdminController::class, "updateCategory"])->name("manager.categories.edit");
    Route::get("/course/{course}/edit", [AdminController::class, "editCourse"])->name("manager.course.edit");
    Route::get("/courses", [AdminController::class, "getCourses"])->name("manager.courses");
});




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
