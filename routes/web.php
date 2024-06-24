<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StripeController;
//use App\Http\Controllers\StripeTempController;
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
Route::get('/final-submission', [PatientController::class, 'finalSubmission'])->name("final-submission");
Route::get('/get-states/{country_id}', [PatientController::class, 'getStates']);
Route::post('/save-patients-details-form', [PatientController::class, 'savePatientsDetailsFormSection1'])->name('save.form')->middleware('update.form.timestamp');;

Route::post('/save-contact-party-form', [PatientController::class, 'saveContactPartyFormSection2'])->name('save.section2')->middleware('update.form.timestamp');;
Route::post('/save-patients-physician-form', [PatientController::class, 'savePatientsPhysicianFormSection3'])->name('save.section3')->middleware('update.form.timestamp');;
Route::post('/save-primary-concerns-form', [PatientController::class, 'savePrimaryConcernsFormSection4'])->name('save.section4')->middleware('update.form.timestamp');;
Route::post('/check-email', [PatientController::class, 'checkEmail'])->name('check.email');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('create-checkout-session');

Route::get("/discard-application", [PatientController::class, 'discardApplication'])->name('discard-application');


//ShareFile Integration routes
Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [PatientController::class, 'upload'])->name("upload");


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
Route::get('/patient_consultation_view/{id}', [OtpController::class, 'patientConsultationView'])->name('patient.consultation.view');

//ShreFile Controllers
Route::get('/files/download/{id}/{filePath}', [OtpController::class, 'downloadFile'])->name('files.download');
Route::get('/download/{id}', [OtpController::class, 'download'])->name('download');
Route::get('/view-file/{id}', [OtpController::class, 'viewFile'])->name('view-file');



// //StripeTempController
// Route::get('/stripe', [StripeTempController::class, 'checkout'])->name('checkout');
// Route::post('/test', 'App\Http\Controllers\StripeTempController@test');
// Route::post('/live', 'App\Http\Controllers\StripeTempController@live');
// Route::get('/success', 'App\Http\Controllers\StripeTempController@success')->name('success');


//Stripe Related Routes
Route::post('create-payment-intent', [StripeController::class, 'createPaymentIntent']);
Route::post('create-customer', [StripeController::class, 'createCustomer']);
Route::post('handle-payment', [StripeController::class, 'handlePayment']);
Route::post('/attach-payment-method', [StripeController::class, 'attachPaymentMethodToCustomer']);

Route::get('/ping', function () {
    return response()->json(['status' => 'ok'], 200);
});

Route::get('/fineUpload', function () {
    return view('fineUpload');
});
Route::post('/handleUpload', [PatientController::class, 'handleUpload']);
Route::delete('/deleteFineUpload', [PatientController::class, 'handleDelete']);

Route::get("thank-you",[PatientController::class, 'thankYou'])->name("thank-you");
Route::get("redirectToHome",[PatientController::class, 'redirectToHome'])->name("redirectToHome");