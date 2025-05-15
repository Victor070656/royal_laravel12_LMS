<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseContent;
use App\Models\Order;
use App\Http\Controllers\Controller;
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
        return view("backend.student.my-courses",[
            "orders"=>$orders
        ]);
    }

    public function viewCourse(Request $request, Order $order)
    {
        if ($order->user_id != auth()->user()->id) {
            return redirect()->route("student.courses")->with("error", "You are not allowed to view a course that you didn't pay for!");
        }

        $course = $order->course;
        $rating = $course->reviews?->avg("star") ?? 0;
        $review = $course->reviews?->count() ?? 0;
        return view("backend.student.view-course", [
            "course" => $course,
            "rating" => $rating,
            "review" => $review
        ]);
    }

    public function watchLesson(Request $request, CourseContent $courseContent){
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
}
