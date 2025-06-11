<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::all()->count();
        $courseCount = Course::all()->count();
        $orderCount = Order::all()->count();
        $orderAmount = Order::sum("amount");
        $users = User::latest()->whereNot("id", "=", auth()->user()->id)->limit(5)->get();
        return view('backend.admin.dashboard',  [
            "userCount" => $userCount,
            "courseCount" => $courseCount,
            "orderCount" => $orderCount,
            "orderAmount" => $orderAmount,
            "users" => $users
        ]);
    }

    public function getUsers(Request $request)
    {
        $id = auth()->user()->id;
        $users = User::latest()->whereNot("id", "=", $id)->paginate(30);

        return view("backend.admin.view-users", [
            "users" => $users
        ]);
    }

    public function activateUser(User $user)
    {
        $user->status = "1";
        $user->save();

        return redirect()->route("manager.users.view")->with("success", "User Activated");
    }

    public function deactivateUser(User $user)
    {
        $user->status = "0";
        $user->save();

        return redirect()->route("manager.users.view")->with("success", "User Deactivated");
    }

    public function addCourse()
    {
        return view("backend.admin.add-course");
    }

    public function getCourses(Request $request)
    {
        $courses = Course::latest()->paginate(20);
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

    public function updateCourse(Request $request, Course $course)
    {
        // dd($request);
        $validated = $request->validate([
            "course_name" => "required|string|max:255",
            "category_id" => "required",
            "short_desc" => "required|string",
            "long_desc" => "string",
            "scheme" => "required|string",
            "requirements" => "required|string",
            "duration" => "required|string",
            "thumbnail" => "image|max:2048",
            "price" => "required|numeric"
        ]);

        $validated["thumbnail"] = $request->file("thumbnail") ? $request->file("thumbnail")->store("thumbnails", "public") : $course->thumbnail;

        $update = $course->update($validated);

        if ($update) {
            return redirect()->route("manager.courses")->with("success", "Course updated successfully");
        } else {
            return redirect()->route("manager.courses")->with("error", "Course update failed");
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

    public function viewCourse(Request $request, Course $course)
    {

        $rating = $course->review?->avg("star") ?? 0;
        $review = $course->review?->count() ?? 0;
        return view("backend.admin.view-course", [
            "course" => $course,
            "rating" => $rating,
            "review" => $review
        ]);
    }

    public function deleteCourse(Request $request, Course $course)
    {
        return view("backend.admin.delete-course", [
            "course" => $course
        ]);
    }

    public function destroyCourse(Request $request, Course $course)
    {
        $thumb = $course->thumbnail;
        $destroy = $course->delete();

        if ($destroy) {
            if (file_exists(asset("storage/" . $thumb))) {
                unlink(asset("storage/" . $thumb));
            }
            return redirect()->route("manager.courses")->with("success", "Course deleted successfully");
        } else {
            return redirect()->route("manager.courses")->with("error", "Course delete failed");
        }
    }

    public function editRole(Request $request, User $user)
    {
        return view("backend.admin.edit-role", [
            "user" => $user
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            "role" => "required|in:instructor,user"
        ]);

        $user->role = $validated["role"];
        $user->save();

        return redirect()->route("manager.users.view")->with("success", "User role updated successfully");
    }
    public function showReply(Request $request, Comment $comment)
    {
        return view("backend.admin.reply-comment", [
            "comment" => $comment
        ]);
    }
    public function replyComment(Request $request, Comment $comment)
    {


            $validated = $request->validate([
                "reply" => "required"
            ]);

            $reply = $comment->update([
                "reply" => $validated["reply"]
            ]);

            if($reply){
                return redirect()->route("manager.course.view", $comment->course)->with("success", "Comment successfully replied");
            }else{
                return redirect()->route("manager.course.view", $comment->course)->with("error", "Comment reply failed");
            }

    }
}
