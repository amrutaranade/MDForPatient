<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use App\Models\Transaction;
use Stripe\Checkout\Session;
use Stripe\Charge;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.stripe_key'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Your Product Name',
                    ],
                    'unit_amount' => 2000, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function handlePost(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.stripe_key'));
        $requestData = $request->all();

        try {
            $charge = Charge::create([
                'amount' => $request['amount'] * 100, // Amount in cents
                'currency' => 'usd',
                'description' => 'Payment description',
                'source' => $request['stripeToken'],
            ]);

            // Save transaction details in the database
            $transaction = new Transaction();
            $transaction->user_id = auth()->id();
            $transaction->amount = $request['amount'];
            $transaction->currency = 'usd';
            $transaction->description = 'Payment description';
            $transaction->stripe_charge_id = $charge->id;
            $transaction->payment_date = new DateTime();
            $transaction->payment_status = 'success';
            $transaction->save();

            return back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function stripePost(Request $request)
    {
        // Set your secret key
        Stripe::setApiKey(config('services.stripe.stripe_key'));

        // Get the token and other data from the request
        $token = $request->input('token');
        $email = $request->input('email');
        $cardLast4 = $request->input('card_last4');
        $cardBrand = $request->input('card_brand');
        $cardExpMonth = $request->input('card_exp_month');
        $cardExpYear = $request->input('card_exp_year');

        try {
            // Create a Customer
            $customer = Customer::create([
                'email' => $email,
                'description' => 'Customer for MD For Patients',
            ]);

            // Attach the payment method to the customer
            $paymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'token' => $token, 
                ],
            ]);

            // Attach the Payment Method to the Customer
            $paymentMethod->attach(['customer' => $customer->id]);

            // Create a Payment Intent
            $paymentIntent = PaymentIntent::create([
                'customer' => $customer->id,
                'amount' => 19900, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $paymentMethod->id,
                'off_session' => true,
                'confirm' => true,
                'description' => 'Payment for consultation fee',
                'receipt_email' => $email,
                'metadata' => [
                    'card_last4' => $cardLast4,
                    'card_brand' => $cardBrand,
                    'card_exp_month' => $cardExpMonth,
                    'card_exp_year' => $cardExpYear,
                ],
            ]);

            // Save transaction details to the database
            Transaction::create([
                'email' => $email,
                'card_last4' => $cardLast4,
                'card_brand' => $cardBrand,
                'card_exp_month' => $cardExpMonth,
                'card_exp_year' => $cardExpYear,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'charge_id' => $paymentIntent->latest_charge,
                'status' => $paymentIntent->status,
            ]);

            return response()->json(['status' => 'success', 'paymentIntent' => $paymentIntent]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
