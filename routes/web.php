<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\InstructorController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// front
Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/contact', [HomeController::class, "contactUs"])->name("home.contact");
Route::get('/courses', [HomeController::class, "getCourses"])->name("home.courses");
Route::get('/course/{course}', [HomeController::class, "courseDetails"])->name("home.course.details");

// student
Route::middleware(['auth', 'verified', "isUser"])->group(function () {
    Route::post('/course/{course}/buy', [HomeController::class, "buyCourse"])->name("home.course.buy");
    Route::get("/course/{course}/pay", [HomeController::class, "payCourse"])->name("home.course.pay");
    Route::get('/dashboard', [UserController::class, "index"])->name('dashboard');
    Route::get('/my-courses', [UserController::class, "myCourses"])->name('student.courses');
    Route::get('/my-courses/{order}', [UserController::class, "viewCourse"])->name('student.course.details');
    Route::get('/lesson/{courseContent}/watch', [UserController::class, "watchLesson"])->name('student.lesson.watch');
});


// instructor
Route::middleware(['auth', 'verified', "isInstructor"])->prefix("instructor")->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get("/dashboard", [InstructorController::class, "index"])->name("instructor.index");
    Route::get("/add-course", [InstructorController::class, "addCourse"])->name("instructor.course.add");
    Route::post("/add-course", [InstructorController::class, "createCourse"])->name("instructor.course.add");
    Route::get("/course/{course}/edit", [InstructorController::class, "editCourse"])->name("instructor.course.edit");
    Route::put("/course/{course}/edit", [InstructorController::class, "updateCourse"])->name("instructor.course.edit");
    Route::get("/course/{course}/delete", [InstructorController::class, "deleteCourse"])->name("instructor.course.delete");
    Route::delete("/course/{course}/delete", [InstructorController::class, "destroyCourse"])->name("instructor.course.delete");
    Route::get("/courses", [InstructorController::class, "getCourses"])->name("instructor.courses");
    Route::get("/course/{course}", [InstructorController::class, "viewCourse"])->name("instructor.course.view");
    Route::get("/course/{course}/add-section", [InstructorController::class, "addSection"])->name("instructor.course.add-section");
    Route::post("/course/{course}/add-section", [InstructorController::class, "createSection"])->name("instructor.course.add-section");
    Route::get("/section/{section}/edit", [InstructorController::class, "editSection"])->name("instructor.section.edit");
    Route::put("/section/{section}/edit", [InstructorController::class, "updateSection"])->name("instructor.section.edit");
    Route::get("/section/{section}/add-content", [InstructorController::class, "addContent"])->name("instructor.section.add-content");
    Route::post("/section/{section}/add-content", [InstructorController::class, "createContent"])->name("instructor.section.add-content");
    Route::get("/content/{courseContent}/edit", [InstructorController::class, "editContent"])->name("instructor.content.edit");
    Route::put("/content/{courseContent}/edit", [InstructorController::class, "updateContent"])->name("instructor.content.edit");
});


// admin
Route::middleware(['auth', 'verified', "isAdmin"])->prefix("manager")->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get("/dashboard", [AdminController::class, "index"])->name("manager.index");
    Route::get("/users", [AdminController::class, "getUsers"])->name("manager.users.view");
    Route::post("/users/{user}/activate", [AdminController::class, "activateUser"])->name("manager.users.activate");
    Route::post("/users/{user}/deactivate", [AdminController::class, "deactivateUser"])->name("manager.users.deactivate");
    Route::get("/users/{user}/role", [AdminController::class, "editRole"])->name("manager.users.role");
    Route::put("/users/{user}/role", [AdminController::class, "updateRole"])->name("manager.users.role");
    Route::get("/add-course", [AdminController::class, "addCourse"])->name("manager.course.add");
    Route::post("/add-course", [AdminController::class, "createCourse"])->name("manager.course.add");
    Route::get("/categories", [AdminController::class, "getCategories"])->name("manager.categories.index");
    Route::post("/categories", [AdminController::class, "createCategory"])->name("manager.categories.index");
    Route::get("/categories/{category}/edit", [AdminController::class, "editCategory"])->name("manager.categories.edit");
    Route::put("/categories/{category}/edit", [AdminController::class, "updateCategory"])->name("manager.categories.edit");
    Route::get("/course/{course}/edit", [AdminController::class, "editCourse"])->name("manager.course.edit");
    Route::put("/course/{course}/edit", [AdminController::class, "updateCourse"])->name("manager.course.edit");
    Route::get("/course/{course}/delete", [AdminController::class, "deleteCourse"])->name("manager.course.delete");
    Route::delete("/course/{course}/delete", [AdminController::class, "destroyCourse"])->name("manager.course.delete");
    Route::get("/courses", [AdminController::class, "getCourses"])->name("manager.courses");
});




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
