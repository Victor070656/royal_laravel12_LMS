<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Course;
use App\Models\Order;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $userCount = User::all()->count();
        $courseCount = Course::all()->where("user_id", "=", auth()->user()->id)->count();
        $orderCount = Order::all()->count();
        $courses = Course::latest()->where("user_id", "=", auth()->user()->id)->limit(5)->get();
        return view('backend.instructor.dashboard', [
            "userCount" => $userCount,
            "courseCount" => $courseCount,
            "orderCount" => $orderCount,
            "courses" => $courses
        ]);
    }

    public function addCourse()
    {
        return view("backend.instructor.add-course");
    }

    public function getCourses(Request $request)
    {
        $courses = Course::latest()->where("user_id", "=", auth()->user()->id)->paginate(5);
        return view("backend.instructor.courses", [
            "courses" => $courses
        ]);
    }
    public function viewCourse(Request $request, Course $course)
    {
        if ($course->user_id != auth()->user()->id) {
            return redirect()->route("instructor.courses")->with("error", "You are not allowed to view a course that doesn't belong to you!");
        }

        $rating = $course->reviews?->avg("star") ?? 0;
        $review = $course->reviews?->count() ?? 0;
        return view("backend.instructor.view-course", [
            "course" => $course,
            "rating" => $rating,
            "review" => $review
        ]);
    }
    public function editCourse(Request $request, Course $course)
    {

        return view("backend.instructor.edit-course", [
            "course" => $course
        ]);
    }

    public function createCourse(Request $request)
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
            "thumbnail" => "required|image|max:2048",
            "price" => "required|numeric"
        ]);

        $validated["user_id"] = auth()->user()->id;
        $validated["thumbnail"] = $request->file("thumbnail")->store("thumbnails", "public");

        $course = Course::create($validated);

        if ($course) {
            return redirect()->route("instructor.course.add")->with("success", "Course created successfully");
        } else {
            return redirect()->route("instructor.course.add")->with("error", "Course creation failed");
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

        if ($course->user_id != auth()->user()->id) {
            return redirect()->route("instructor.courses")->with("error", "You are not allowed to edit a course that doesn't belong to you!");
        }

        $validated["thumbnail"] = $request->file("thumbnail") ? $request->file("thumbnail")->store("thumbnails", "public") : $course->thumbnail;

        $update = $course->update($validated);

        if ($update) {
            return redirect()->route("instructor.courses")->with("success", "Course updated successfully");
        } else {
            return redirect()->route("instructor.courses")->with("error", "Course update failed");
        }
    }

    public function addSection(Course $course)
    {
        return view("backend.instructor.add-section", [
            "course" => $course
        ]);
    }

    public function createSection(Request $request, Course $course)
    {
        $validated = $request->validate([
            "section_name" => "required|max:255"
        ]);

        $add = $course->sections()->create($validated);
        if ($add) {
            return redirect()->route("instructor.course.view", $course)->with("success", "Section Added");
        } else {
            return redirect()->route("instructor.course.view", $course)->with("error", "Error adding section!");
        }
    }
    public function editSection(Section $section)
    {
        return view("backend.instructor.edit-section", [
            "section" => $section
        ]);
    }

    public function updateSection(Request $request, Section $section)
    {
        $validated = $request->validate([
            "section_name" => "required|max:255"
        ]);

        $add = $section->update($validated);
        if ($add) {
            return redirect()->route("instructor.course.view", $section->course)->with("success", "Section Updated");
        } else {
            return redirect()->route("instructor.course.view", $section->course)->with("error", "Error updating section!");
        }
    }

    public function addContent(Section $section)
    {
        return view("backend.instructor.add-content", [
            "section" => $section
        ]);
    }

    public function createContent(Request $request, Section $section) {
        $validated = $request->validate([
            "title" => "required|max:255",
            "type" => "required|in:video,material",
            "link" => "required"
        ]);

        $add = $section->courseContent()->create($validated);
        if ($add) {
            return redirect()->route("instructor.course.view", $section->course)->with("success", "Content Added");
        } else {
            return redirect()->route("instructor.course.view", $section->course)->with("error", "Error adding content!");
        }
    }
}
