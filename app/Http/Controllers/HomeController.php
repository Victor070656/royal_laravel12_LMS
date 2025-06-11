<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Category;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
// paystack
use Matscode\Paystack\Transaction;
// Flutterwave
// use Flutterwave\Flutterwave;
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
use Illuminate\Support\Facades\Mail;

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
                ->latest()->paginate(12);
        } else {
            $courses = Course::latest()->paginate(12);
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
        $perc5 = 0;
        $perc4 = 0;
        $perc3 = 0;
        $perc2 = 0;
        $perc1 = 0;
        if (isset($course->review)) {
            $count_review = $course->review->count();
            $perc5Count = $course->review->where("star", "=", 5)->count() ?? 0;
            $perc4Count = $course->review->where("star", "=", 4)->count() ?? 0;
            $perc3Count = $course->review->where("star", "=", 3)->count() ?? 0;
            $perc2Count = $course->review->where("star", "=", 2)->count() ?? 0;
            $perc1Count = $course->review->where("star", "=", 1)->count() ?? 0;
        }
        if ($count_review > 0) {
            $perc5 = ($perc5Count / $count_review) * 100;
            $perc4 = ($perc4Count / $count_review) * 100;
            $perc3 = ($perc3Count / $count_review) * 100;
            $perc2 = ($perc2Count / $count_review) * 100;
            $perc1 = ($perc1Count / $count_review) * 100;
            foreach ($course->review as $review) {
                $rating += $review->star;
            }
            $rating = $rating / $count_review;
        } else {
            $rating = 0;
        }
        $rating = round($rating, 1);

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
            "check" => $check,
            "perc5" => $perc5,
            "perc4" => $perc4,
            "perc3" => $perc3,
            "perc2" => $perc2,
            "perc1" => $perc1,
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
            $res = $this->payWithFlutter($user->first_name, $user->last_name, $email, $price, route('home.course.pay', $course));
            // dd($res);
            return $res;

        } else {
            return redirect()->route("home.course.details", $course)->with("error", "Course already bought by you!");
        }
    }

    public function payCourse(Request $request, Course $course)
    {
        // dd($request);
        $status = request()->status;

        //if payment is successful
        if ($status == 'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            // dd($data);
            if ($data["status"] == "success") {
                $order = $course->orders()->create([
                    "user_id" => auth()->user()->id,
                    "amount" => $course->price,
                    "reference" => $request->query('txref')
                ]);
                Mail::to([
                    "support@royalsolutions.com.ng",
                    "ikechukwuv052@gmail.com",
                    // $course->user->email
                ])
                    ->send(new OrderPlaced($course));

                if ($order) {
                    return redirect()->route("home.course.details", $course)->with("success", "Payment was successful!");
                } else {
                    return redirect()->route("home.course.details", $course)->with("error", "Order Failed!");
                }
            } else {
                return redirect()->route("home.course.details", $course)->with("error", "Order Failed. Something went wrong!");
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


    /**
     * Summary of payWithFlutter
     * @param mixed $first_name
     * @param mixed $last_name
     * @param mixed $email
     * @param mixed $amount
     * @param mixed $callback_url
     * @param mixed $currency
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function payWithFlutter($first_name, $last_name, $email, $amount, $callback_url, $currency = "NGN")
    {
        \Log::info('Starting payment process');

        try {
            $reference = Flutterwave::generateReference();
            \Log::info('Generated reference: ' . $reference);

            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $amount,
                'email' => $email,
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => $callback_url,
                'customer' => [
                    'email' => $email,
                    "name" => $first_name . " " . $last_name
                ],
                "customizations" => [
                    "title" => 'Royal Educity',
                    "description" => "Payment for course",
                ]
            ];

            \Log::info('Payment data prepared', $data);

            $payment = Flutterwave::initializePayment($data);
            $payment = (array) $payment;
            \Log::info('Payment response received', $payment);

            // dd($payment);

            if ($payment['status'] !== 'success') {
                \Log::error('Payment initialization failed', $payment);
                return back()->with('error', 'Payment initialization failed');
            }

            $redirectUrl = $payment['data']['link'];
            \Log::info('Redirecting to: ' . $redirectUrl);
            // dd($payment);


            // return redirect()->away($redirectUrl, 301);
            return view("payment.flutterwave", [
                "url" => $redirectUrl,
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing payment');
        }
    }


}
