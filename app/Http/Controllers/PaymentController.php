<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flutterwave\Flutterwave;

class PaymentController extends Controller
{
    public function pay()
    {
        $tx_ref = uniqid("TX_");

        $paymentData = [
            "tx_ref" => $tx_ref,
            "amount" => 1000, // Replace with your dynamic amount
            "currency" => "NGN",
            "redirect_url" => route('payment.callback'),
            "payment_options" => "card,banktransfer",
            "customer" => [
                "email" => "test@example.com",
                "name" => "John Buyer"
            ],
            "customizations" => [
                "title" => "Toy Store",
                "description" => "Buying toys online",
                "logo" => "https://yourdomain.com/logo.png"
            ]
        ];

        try {
            $flutter = new Flutterwave;
            $payment  = $flutter->setAmount($amount);

            if ($payment['status'] === 'success') {
                return redirect($payment['data']['link']);
            }

            return back()->with('error', 'Payment initialization failed.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $status = $request->query('status');
        $transaction_id = $request->query('transaction_id');

        if ($status === 'successful') {
            try {
                $verification = Flutterwave::verifyTransaction($transaction_id);

                if ($verification['status'] === 'success') {
                    // You can save the verified payment info here
                    return view('payment.success', ['data' => $verification['data']]);
                }
            } catch (\Exception $e) {
                return view('payment.failed', ['error' => $e->getMessage()]);
            }
        }

        return view('payment.failed', ['error' => 'Payment was not successful.']);
    }
}
