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
use App\Http\Controllers\EmailController;
use App\Models\ContactParty;
use App\Models\ReferringPhysician;
use App\Models\PatientPrimaryConcern;
use App\Models\PatientExpertOpinionRequest;
use App\Models\PatientMedicalRecords;
use App\Models\Transaction;

class OtpController extends Controller
{

    protected $emailController;

    public function __construct(EmailController $emailController)
    {
        $this->emailController = $emailController;
    }
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

        // Get patient email
        $patient = PatientsRegistrationDetail::find($patientId);
        $recipientEmail = 'taiyabbashaikh19@gmail.com';

        // Prepare email details
        $details = [
            'title' => 'Your OTP Code',
            'body' => $otp
        ];

        // Send OTP via email using EmailController's sendEmail method
        $this->emailController->sendEmail($recipientEmail, $details);
        // Send OTP via email
        // Mail::raw("Your OTP is: $otp", function($message) use ($user) {
        //     $message->to($user->email)
        //             ->subject('Your OTP Code');
        // });

        return response()->json(['message' => 'OTP sent to your email.']);
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');

        // Retrieve the latest OTP for the user
        $otpEntry = Otp::Where('otp', $otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->orderBy('created_at', 'desc')
                        ->first();

        if ($otpEntry) {
            return redirect()->action([OtpController::class, 'patientConsultationView'], [$otpEntry->patient_id]);
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

    public function validateCaseNumber(Request $request) {
        $caseNumber = $request->input('case_number');
        // Replace with actual validation logic
        $validCaseNumbers = PatientsRegistrationDetail::Where('patient_consulatation_number', $caseNumber)->first();

        if ($caseNumber == $validCaseNumbers->patient_consulatation_number) {
            $this->generateOtp(1);
            return response()->json(['message' => 'Valid case number.']);
        }

        return response()->json(['message' => 'Invalid case number.'], 400);
    }

    public function patientConsultationView ($patientId)
    {
        $patientDetails = PatientsRegistrationDetail::Where("id", $patientId)->first();
        $contactParty = ContactParty::where('patient_id', $patientId)->first();
        $referringPhysician = ReferringPhysician::where('patient_id', $patientId)->first();
        $patientPrimaryConcern = PatientPrimaryConcern::where('patient_id', $patientId)->first();
        $expertOpinionRequests = PatientExpertOpinionRequest::where('patient_id', $patientId)->get();
        $medicalRecords = PatientMedicalRecords::where('patient_id', $patientId)->get();
        $paymentDetails = Transaction::where('patient_id', $patientId)->get();
        $countries = Country::get()->toArray();
        $states = State::get()->toArray();

        return view('patient_consultation_view', [
            'patientDetails' => $patientDetails,
            'contactParty' => $contactParty,
            'referringPhysician' => $referringPhysician,
            'patientPrimaryConcern' => $patientPrimaryConcern,
            'expertOpinionRequests' => $expertOpinionRequests,
            'paymentDetails' => $paymentDetails,
            'medicalRecords' => $medicalRecords,
            'countries' => $countries,
            'states' => $states
        ]);
    }
}
?>