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
use Stripe\Exception\ApiErrorException;
use App\Models\PatientExpertOpinionRequest;

class StripeController extends Controller
{
    public function createCustomer(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.stripe_secret_key'));

            // Create a new customer
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return response()->json(['customer_id' => $customer->id]);
        } catch (ApiErrorException $e) {
            logger()->error('Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            logger()->error('Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.stripe_secret_key'));

            $paymentIntent = PaymentIntent::create([
                'amount' => config('services.stripe.stripe_amount'), // amount in cents
                'currency' => config('services.stripe.stripe_currency'),
                'customer' => $request->customer_id,
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            logger()->error('Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            logger()->error('Error: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function handlePayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.stripe_secret_key'));

        try {
            // Retrieve the PaymentIntent
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            logger()->info('Retrieved PaymentIntent: ', ['paymentIntent' => $paymentIntent]);
    
            // Check if the PaymentIntent is already succeeded
            if ($paymentIntent->status === 'succeeded') {
                // Retrieve the latest charge using the latest_charge property
                $chargeId = $paymentIntent->latest_charge;
                if ($chargeId) {
                    $charge = \Stripe\Charge::retrieve($chargeId);
                    logger()->info('Retrieved Charge: ', ['charge' => $charge]);
    
                    // Get charge ID and last 4 digits of the card
                    $last4 = $charge->payment_method_details->card->last4;
    
                    //Save transaction details to the database      
                    Transaction::create([
                        'card_holder_email' => $request->cardHolderEmail,
                        'card_holder_name' => $request->cardHolderName,
                        "patient_id" => session('patient_id'),
                        'card_last4' => $last4,
                        'amount' => $paymentIntent->amount,
                        'currency' => $paymentIntent->currency,
                        'charge_id' => $paymentIntent->latest_charge,
                        'status' => $paymentIntent->status,
                    ]);
        
                    PatientExpertOpinionRequest::create([
                        'patient_agreement' =>$request->patient_agreement,
                        "patient_id" => session('patient_id'),
                        'appendix_1' => $request->appendix_1,
                        'appendix_2' => $request->appendix_2,
                        'appendix_3' => $request->appendix_3,
                        'appendix_4' =>$request->appendix_4,
                        're_type_name' => $request->re_type_name,
                        // 'cover_letter' =>$coverLetterContents,
                        // 'agreement' =>$agreementContents
        
                    ]);
                    session(['stripe_charge_id' => $paymentIntent->latest_charge]);
                    
                    return response()->json([
                        'success' => true,
                        'paymentDetails' => [
                            'charge_id' => $chargeId,
                            'last4' => $last4,
                        ],
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'error' => 'No charges found in PaymentIntent.'
                    ]);
                }
            } else {
                // Confirm the PaymentIntent
                $paymentIntent = $paymentIntent->confirm();
                logger()->info('Confirmed PaymentIntent: ', ['paymentIntent' => $paymentIntent]);
    
                // Check if the payment is successful
                if ($paymentIntent->status === 'succeeded') {
                    // Retrieve the latest charge using the latest_charge property
                    $chargeId = $paymentIntent->latest_charge;
                    if ($chargeId) {
                        $charge = \Stripe\Charge::retrieve($chargeId);
                        logger()->info('Retrieved Charge after confirmation: ', ['charge' => $charge]);
    
                        // Get charge ID and last 4 digits of the card
                        $last4 = $charge->payment_method_details->card->last4;
                        
                        //Save transaction details to the database      
                        Transaction::create([
                            'card_holder_email' => $request->cardHolderEmail,
                            'card_holder_name' => $request->cardHolderName,
                            "patient_id" => session('patient_id'),
                            'card_last4' => $last4,
                            'amount' => $paymentIntent->amount,
                            'currency' => $paymentIntent->currency,
                            'charge_id' => $paymentIntent->latest_charge,
                            'status' => $paymentIntent->status,
                        ]);
            
                        PatientExpertOpinionRequest::create([
                            'patient_agreement' =>$request->patient_agreement,
                            "patient_id" => session('patient_id'),
                            'appendix_1' => $request->appendix_1,
                            'appendix_2' => $request->appendix_2,
                            'appendix_3' => $request->appendix_3,
                            'appendix_4' =>$request->appendix_4,
                            're_type_name' => $request->re_type_name,
                            // 'cover_letter' =>$coverLetterContents,
                            // 'agreement' =>$agreementContents
            
                        ]);
                        session(['stripe_charge_id' => $paymentIntent->latest_charge]);
    
                        return response()->json([
                            'success' => true,
                            'paymentDetails' => [
                                'charge_id' => $chargeId,
                                'last4' => $last4,
                            ],
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'error' => 'No charges found in PaymentIntent.'
                        ]);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'error' => 'Payment did not succeed.'
                    ]);
                }
            }
        } catch (ApiErrorException $e) {
            logger()->error('Stripe API error: ', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            logger()->error('General error: ', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function attachPaymentMethodToCustomer(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.stripe_secret_key'));

        try {
            // Attach the payment method to the customer
            $paymentMethod = PaymentMethod::retrieve($request->payment_method_id);
            $paymentMethod->attach(['customer' => $request->customer_id]);

            // Update the default payment method for the customer
            Customer::update($request->customer_id, [
                'invoice_settings' => [
                    'default_payment_method' => $request->payment_method_id,
                ],
            ]);

            return response()->json(['success' => true]);
        } catch (ApiErrorException $e) {
            logger()->error('Error: ', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
