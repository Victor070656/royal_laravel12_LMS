<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
// paystack
use Matscode\Paystack\Transaction;
// Flutterwave
use Flutterwave\Flutterwave;


class HomeController extends Controller
{

    private $secKey;
    private $FLW_BASE_URL = "https://api.flutterwave.com/v3/";
    private $FLW_PUBLIC_KEY = 'FLWPUBK_TEST-f4b43a2d9868b3754826fb550a2710e6-X'; // Your public key
    private $FLW_SECRET_KEY = 'FLWSECK_TEST-f937a637a169210afca61ddbfaba0ad6-X'; // Your secret key
    private $FLW_ENCRYPTION_KEY = 'FLWSECK_TEST7af78d33db85'; // Your encryption key

    public function __construct()
    {
        $this->secKey = config('app.paystackSec');
    }

    public function index(Request $request)
    {
        $courses = Course::latest()->limit(6)->get();
        return view("home.index", [
            "courses" => $courses
        ]);
    }

    public function getCourses(Request $request)
    {
        $search = $request->query("search");
        $query = Course::query();
        if (!empty($search)) {
            $courses = $query
                ->whereLike("course_name", "%$search%")
                ->orWhereLike("short_desc", "%$search%")
                ->orWhereLike("long_desc", "%$search%")
                ->orWhereLike("scheme", "%$search%")
                ->orWhereLike("requirements", "%$search%")
                ->latest()->paginate(6);
        } else {
            $courses = Course::latest()->paginate(6);
        }
        // dd($courses);
        return view("home.courses", [
            "courses" => $courses
        ]);
    }

    public function courseDetails(Request $request, Course $course)
    {
        $lessons = 0;
        $sections = $course->sections;
        if (isset($course->sections)) {
            foreach ($sections as $section) {
                $lessons += $section->courseContent->count();
            }
        }

        $rating = 0;
        $count_review = 0;
        if (isset($course->review)) {
            $count_review = $course->review->count();
        }
        if ($count_review > 0) {
            foreach ($course->review as $review) {
                $rating += $review->star;
            }
            $rating = $rating / $count_review;
        } else {
            $rating = 0;
        }
        $rating = number_format($rating, 1);

        $category = Category::where('id', '=', $course->category_id)->get();

        $requirements = explode(",", $course->requirements);
        $schemes = explode(",", $course->scheme);

        $learned = 0;
        $getCourses = $course->user->courses;
        // dd(is_object($getCourses));
        if (is_object($getCourses)) {
            foreach ($getCourses as $c) {
                $learned = $c->orders->count();
            }
        }

        $user = auth()->user();
        $check = null;
        // dd($user);
        // dd($course->orders->where("user_id", "=", $user->id)                                                                                   ->first());
        if ($user) {
            if (is_object($course->orders)) {

                $check = $course->orders()->where("user_id", "=", $user->id)->first();
            }
        }

        return view("home.course-details", [
            "course" => $course,
            "lessons" => $lessons,
            "count_review" => $count_review,
            "rating" => $rating,
            "category" => $category,
            "sections" => $sections,
            "requirements" => $requirements,
            "schemes" => $schemes,
            "learned" => $learned,
            "check" => $check
        ]);
    }

    public function contactUs()
    {
        return view("home.contact");
    }

    public function buyCourse(Request $request, Course $course)
    {
        $user = auth()->user();
        $email = $user->email;
        $price = $course->price;
        $check = $course->orders()->where("user_id", "=", $user->id)->first() ?? null;
        if (!$check) {

            // $this->makePayment($email, $price, route('home.course.pay', $course));
            // dd(route('home.course.pay', $course));
            $this->payWithFlutter($user->first_name, $user->last_name, $email, $price, route('home.course.pay', $course));
            // dd($res);

        } else {
            return redirect()->route("home.course.details", $course)->with("error", "Course already bought by you!");
        }
    }

    public function payCourse(Request $request, Course $course)
    {
        // dd($request);
        if ($this->confirmTransaction($request->query("txref"))) {
            $order = $course->orders()->create([
                "user_id" => auth()->user()->id,
                "amount" => $course->price,
                "reference" => $request->query('txref')
            ]);

            if ($order) {
                return redirect()->route("home.course.details", $course)->with("success", "Payment was successful!");
            } else {
                return redirect()->route("home.course.details", $course)->with("error", "Payment was not successful!");
            }
        } else {
            return redirect()->route("home.course.details", $course)->with("error", "Something went wrong!");
        }
    }


    // PAYSTACK FUNCTIONS
    public function makePayment($email, $amount, $callback)
    {
        $transaction = new Transaction($this->secKey);

        $response = $transaction
            ->setCallbackUrl($callback)
            ->setEmail($email)
            ->setAmount($amount)
            ->initialize();

        $_SESSION["ref"] = $response->reference;
        echo "<script>location.href = '" . $response->authorizationUrl . "'</script>";
        // Http::redirect($response->authorizationUrl);
    }

    public function confirmTransaction($ref)
    {
        $transaction = new Transaction($this->secKey);
        return $transaction->isSuccessful($ref);
    }

    public function payWithFlutter($first_name, $last_name, $email, $amount, $callback_url, $currency = "NGN", $tx_ref = null)
    {
        if (!$tx_ref) {
            $tx_ref = 'TX-' . uniqid() . '-' . time();
        }

        Flutterwave::setUp([
            'secret_key' => $this->FLW_SECRET_KEY,
            'public_key' => $this->FLW_PUBLIC_KEY,
            'encryption_key' => $this->FLW_ENCRYPTION_KEY,
            'environment' => "test", // or 'live'
        ]);

        $flutterwave = new Flutterwave();

        $flutterwave->setAmount($amount)
            ->setCurrency($currency)
            ->setEmail($email)
            ->setFirstname($first_name)
            ->setPhoneNumber("")
            ->setLastname($last_name)
            ->setRedirectUrl($callback_url)
            ->setTitle("Royal Educity")
            ->setDescription("Course Payment")
            ->setCountry("NG")
            ->setLogo("")
            ->setPaymentOptions("card,account")
            ->initialize(); // returns raw HTML + JS

    }


}
