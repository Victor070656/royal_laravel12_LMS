<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.admin.dashboard');
    }

    public function getUsers(Request $request)
    {
        $users = User::latest()->paginate(2);

        return view("backend.admin.view-users", [
            "users" => $users
        ]);
    }

    public function activateUser(User $user) {}

    public function addCourse()
    {
        return view("backend.admin.add-course");
    }

    public function getCourses(Request $request)
    {
        $courses = Course::latest()->paginate(5);
        return view("backend.admin.courses", [
            "courses" => $courses
        ]);
    }
    public function editCourse(Request $request, Course $course)
    {

        return view("backend.admin.edit-course", [
            "course" => $course
        ]);
    }

    public function createCourse(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            "course_name" => "required|string|max:255",
            "user_id" => "required",
            "category_id" => "required",
            "short_desc" => "required|string",
            "long_desc" => "string",
            "scheme" => "required|string",
            "requirements" => "required|string",
            "duration" => "required|string",
            "thumbnail" => "required|image|max:2048",
            "price" => "required|numeric"
        ]);

        $validated["thumbnail"] = $request->file("thumbnail")->store("thumbnails", "public");

        $course = Course::create($validated);

        if ($course) {
            return redirect()->route("manager.course.add")->with("success", "Course created successfully");
        } else {
            return redirect()->route("manager.course.add")->with("error", "Course creation failed");
        }
    }

    public function getCategories()
    {
        $categories = Category::latest()->get();
        return view("backend.admin.add-category", [
            "categories" => $categories
        ]);
    }

    public function editCategory(Category $category)
    {

        return view("backend.admin.edit-category", [
            "category" => $category
        ]);
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            "category_name" => "required|max:255|unique:categories,category_name"
        ]);

        $category = Category::create($validated);
        if ($category) {
            return redirect()->route("manager.categories.index")->with("success", "Category Successfully Added!");
        } else {
            return redirect()->route("manager.categories.index")->with("error", "Category failed to add!");
        }
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            "category_name" => "required|max:255|unique:categories,category_name"
        ]);

        $category = $category->update($validated);
        if ($category) {
            return redirect()->route("manager.categories.index")->with("success", "Category Successfully Updated!");
        } else {
            return redirect()->route("manager.categories.index")->with("error", "Category failed to update!");
        }
    }
}
