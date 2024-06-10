<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ShareFileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('patient-registration');
// });

Route::get('/', [PatientController::class, 'patientFormView'])->name('home');
Route::get('/get-states/{country_id}', [PatientController::class, 'getStates']);
Route::post('/save-patients-details-form', [PatientController::class, 'savePatientsDetailsFormSection1'])->name('save.form')->middleware('update.form.timestamp');;

Route::post('/save-contact-party-form', [PatientController::class, 'saveContactPartyFormSection2'])->name('save.section2')->middleware('update.form.timestamp');;
Route::post('/save-patients-physician-form', [PatientController::class, 'savePatientsPhysicianFormSection3'])->name('save.section3')->middleware('update.form.timestamp');;
Route::post('/save-primary-concerns-form', [PatientController::class, 'savePrimaryConcernsFormSection4'])->name('save.section4')->middleware('update.form.timestamp');;
Route::post('/check-email', [PatientController::class, 'checkEmail'])->name('check.email');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('create-checkout-session');

//ShareFile Integration routes
Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [ShareFileController::class, 'upload']);


//Gmail Routes
Route::get('auth/google', [EmailController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [EmailController::class, 'handleGoogleCallback']);
Route::get('send-email', [EmailController::class, 'sendEmail'])->name('send-email');

// //Stripe Payment Routes
// Route::get('/payment', function () {
//     return view('payment');
// });

// Route::post('/payment', [StripeController::class, 'handlePost'])->name('stripe.post');
Route::post('/stripe-post', [StripeController::class, 'stripePost'])->name('stripe.post');


//OTP Related Routes
Route::post('/validate-case-number', [OtpController::class, 'validateCaseNumber']);
Route::post('/generate-otp', [OtpController::class, 'generateOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);
Route::get('/otp', [OtpController::class, 'showOTPForm'])->name('show.otp.form');
Route::get('/patient_consultation_view', [OtpController::class, 'patientConsultationView'])->name('show.otp.form');