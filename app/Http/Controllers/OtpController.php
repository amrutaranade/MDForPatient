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
use GuzzleHttp\Client;
use App\Http\Controllers\PatientController;
use App\Services\ShareFileService;

class OtpController extends Controller
{

    protected $emailController;
    protected $patientController;
    protected $shareFileService;

    public function __construct(EmailController $emailController, PatientController $patientController, ShareFileService $shareFileService)
    {
        $this->emailController = $emailController;
        $this->patientController = $patientController;
        $this->shareFileService = $shareFileService;
    }
    public function showOTPForm()
    {
        session(["otp_verified" => false]);
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
        $recipientEmail = $patient->email;

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
            session(["otp_verified" => true]);
            return redirect()->action([OtpController::class, 'patientConsultationView'], [$otpEntry->patient_id]);
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

    public function validateCaseNumber(Request $request) {
        $caseNumber = $request->input('case_number');
        // Replace with actual validation logic
        $validCaseNumbers = PatientsRegistrationDetail::Where('patient_consulatation_number', $caseNumber)->first();

        if ($caseNumber == $validCaseNumbers->patient_consulatation_number) {
            $this->generateOtp($validCaseNumbers->id);
            return response()->json(['message' => 'Valid case number.']);
        }

        return response()->json(['message' => 'Invalid case number.'], 400);
    }

    public function patientConsultationView ($patientId)
    {
        if(session("otp_verified") == false)  {
            return redirect()->route('show.otp.form');
        }
        $patientDetails = PatientsRegistrationDetail::Where("id", $patientId)->first();
        $contactParty = ContactParty::Where('patient_id', $patientId)->first();
        $referringPhysician = ReferringPhysician::Where('patient_id', $patientId)->first();
        $patientPrimaryConcern = PatientPrimaryConcern::Where('patient_id', $patientId)->first();
        $expertOpinionRequests = PatientExpertOpinionRequest::Where('patient_id', $patientId)->first();
        $medicalRecords = PatientMedicalRecords::Where('patient_id', $patientId)->first();
        $paymentDetails = Transaction::Where('patient_id', $patientId)->first();
        $countries = Country::get()->toArray();
        $states = State::get()->toArray();

        $customeShareFiles = $this->patientController->getShareFilesByFolderId($medicalRecords->folder_id);
        if(!empty($customeShareFiles)) {
            $customeShareFiles = array_map(function ($item) {
                                    return [
                                        'fileName' => $item['FileName'],
                                        'url' => $item['url'],
                                        'creationDate' => $item['CreationDate'],
                                        'id' => $item['Id']
                                    ];
                                }, $customeShareFiles);
        } else {
            $customeShareFiles = [];
        }
       
        return view('patient_consultation_view', [
            'patientDetails' => $patientDetails,
            'contactParty' => $contactParty,
            'referringPhysician' => $referringPhysician,
            'patientPrimaryConcern' => $patientPrimaryConcern,
            'expertOpinionRequests' => $expertOpinionRequests,
            'paymentDetails' => $paymentDetails,
            'medicalRecords' => $medicalRecords,
            "customeShareFiles" => $customeShareFiles,
            'countries' => $countries,
            'states' => $states
        ]);
    }

    public function downloadFile($id, $localPath) {
        // Call the download_item function
        $fileStream = $this->shareFileService->downloadFile($id, $localPath);

        if ($fileStream) {
            // Send the file stream to the browser for download
            return response()->streamDownload(function() use ($fileStream) {
                echo $fileStream;
            }, 'filename.ext');
        }

        // Optionally, you can return a response or redirect after downloading
        return response()->download($localPath)->deleteFileAfterSend(true);
    }
}
?>