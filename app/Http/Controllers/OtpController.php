<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use App\Models\PatientsRegistrationDetail;
use App\Models\Country;
use App\Models\State;

class OtpController extends Controller
{
    public function showOTPForm()
    {
        return view('showOTPForm');
    }

    public function generateOtp($patientId)
    {
        //$user = auth()->user();
        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        // Save OTP to database
        Otp::create([
            'patient_id' => $patientId,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Send OTP via email
        // Mail::raw("Your OTP is: $otp", function($message) use ($user) {
        //     $message->to($user->email)
        //             ->subject('Your OTP Code');
        // });

        return response()->json(['message' => 'OTP sent to your email.']);
    }

    public function verifyOtp(Request $request)
    {
        //$user = auth()->user();
        $otp = $request->input('otp');

        // Retrieve the latest OTP for the user
        $otpEntry = Otp:://where('user_id', $user->id)
                        Where('otp', $otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->orderBy('created_at', 'desc')
                        ->first();

        if ($otpEntry) {
            return redirect()->action([OtpController::class, 'patientConsultationView']);
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

    public function validateCaseNumber(Request $request) {
        $caseNumber = $request->input('case_number');
        // Replace with actual validation logic
        $validCaseNumbers = ['1'];

        if (in_array($caseNumber, $validCaseNumbers)) {
            $this->generateOtp(1);
            return response()->json(['message' => 'Valid case number.']);
        }

        return response()->json(['message' => 'Invalid case number.'], 400);
    }

    public function patientConsultationView() {
        
        //$patientRegistration = PatientsRegistrationDetail::Where([])->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();
        $patientRegistration = PatientsRegistrationDetail::take(1)->get()->toArray();

        $getCountriesData = Country::get()->toArray();
        $getStatesData = State::get()->toArray();
        
        return view('patient_consultation_view', [
            'patient_registration' => $patientRegistration,
            'patient_contact_Party' => $patientRegistration,
            'patient_physician' => $patientRegistration,
            'patient_primary_concern' => $patientRegistration,
            'patient_consent_payment' => $patientRegistration,
            'patient_medical_Records' => $patientRegistration,
            'countries' => $getCountriesData,
            'states' => $getStatesData
        ]);
    }
}
?>