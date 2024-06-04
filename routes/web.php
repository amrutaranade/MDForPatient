<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StripeController;
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
Route::post('/save-patients-details-form', [PatientController::class, 'savePatientsDetailsFormSection1'])->name('save.form');

Route::post('/save-contact-party-form', [PatientController::class, 'saveContactPartyFormSection2'])->name('save.section2');
Route::post('/save-patients-physician-form', [PatientController::class, 'savePatientsPhysicianFormSection3'])->name('save.section3');
Route::post('/save-primary-concerns-form', [PatientController::class, 'savePrimaryConcernsFormSection4'])->name('save.section4');
Route::post('/check-email', [PatientController::class, 'checkEmail'])->name('check.email');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('create-checkout-session');