<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
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
Route::post('/save-another-form', [PatientController::class, 'saveAnotherForm'])->name('save.another_form');