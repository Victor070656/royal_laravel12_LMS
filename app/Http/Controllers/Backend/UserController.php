<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseContent;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        return view("backend.student.dashboard");
    }

    public function myCourses(Request $request)
    {
        // dd($request->user()->orders);
        $orders = $request->user()->orders;
        return view("backend.student.my-courses", [
            "orders" => $orders
        ]);
    }

    public function viewCourse(Request $request, Order $order)
    {
        if ($order->user_id != auth()->user()->id) {
            return redirect()->route("student.courses")->with("error", "You are not allowed to view a course that you didn't pay for!");
        }

        $course = $order->course;
        // dd($course->review->where("user_id", "=", auth()->user()->id));
        $rating = $course->review?->avg("star") ?? 0;
        $review = $course->review?->count() ?? 0;
        $hasReviewed = $course->review->where("user_id", "=", auth()->user()->id);
        return view("backend.student.view-course", [
            "course" => $course,
            "rating" => $rating,
            "review" => $review,
            "hasReviewed" => $hasReviewed,
        ]);
    }

    public function watchLesson(Request $request, CourseContent $courseContent)
    {
        $order = Order::where("user_id", auth()->user()->id)->where("course_id", $courseContent->section->course->id)->first();
        $course = $courseContent->section->course;
        if (!$order) {
            return redirect()->route("student.courses")->with("error", "You are not allowed to view a course that you didn't pay for!");
        }
        return view("backend.student.watch-lesson", [
            "lesson" => $courseContent,
            "course" => $course
        ]);
    }

    public function writeReview(Request $request, Course $course)
    {
        $validated = $request->validate([
            "star" => "required",
            "review" => "required|min:5"
        ]);

        $review = $course->review()->create([
            "user_id" => auth()->user()->id,
            "star" => $validated["star"],
            "review" => $validated["review"]
        ]);

        if ($review) {
            return redirect()->back()->with("success", "Review Added");
        } else {
            return redirect()->back()->with("error", "Something went wrong");
        }
    }
}
