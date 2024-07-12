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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class OtpController extends Controller
{

    protected $emailController;
    protected $patientController;
    protected $shareFileService;
    protected $client;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;
    protected $subdomain;

    public function __construct(EmailController $emailController, PatientController $patientController, ShareFileService $shareFileService)
    {
        $this->emailController = $emailController;
        $this->patientController = $patientController;
        $this->shareFileService = $shareFileService;
        $this->client = new Client();
        $this->clientId = config('services.shareFile.sharefile_client_id');
        $this->clientSecret = config('services.shareFile.sharefile_client_secret');
        $this->username = config('services.shareFile.sharefile_username');
        $this->password = config('services.shareFile.sharefile_password');
        $this->subdomain = config('services.shareFile.sharefile_subdomain');
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
        $patientDetailsEmail = $patient->email;
        $recipientEmail =  $patientDetailsEmail;

        // Prepare email details
        $details = [
            'title' => 'Your OTP Code',
            'body' => $otp
        ];

        // Send OTP via email using EmailController's sendEmail method
        $this->emailController->sendEmail($recipientEmail, $details, null, null);
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
        session(['msg'=>"Invalid or expired OTP. Please try again."]);
        
        return redirect()->route('home');
    }

    public function validateCaseNumber(Request $request) {
        $caseNumber = $request->input('case_number');
        
        // Fetch all patient records
        $patients = PatientsRegistrationDetail::all();
        
        foreach ($patients as $patient) {
            try {
                // Accessing the decrypted value using the model's accessor
                $decryptedCaseNumber = $patient->patient_consulatation_number;
                
                if ($caseNumber === $decryptedCaseNumber) {
                    $this->generateOtp($patient->id);
                    return response()->json(['message' => 'Valid case number.']);
                }
            } catch (DecryptException $e) {
                // Handle decryption failure if necessary
                continue;
            }
        }
    
        return response()->json(['message' => 'Invalid case number.'], 400);
    }

    public function patientConsultationView ($patientId)
    {
        if(session("otp_verified") == false)  {
            return redirect()->route('home');
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

        $customeShareFiles = (isset($medicalRecords->folder_id)) ? $this->patientController->getShareFilesByFolderId($medicalRecords->folder_id) : null;
        
        session(['patient_consulatation_number' => $patientDetails->patient_consulatation_number, 'patient_id' => $patientId]);

        if(!empty($patientDetails && $contactParty && $referringPhysician && $patientPrimaryConcern && $expertOpinionRequests && $paymentDetails)) {
            
            return view('patient_consultation_view', [
                'patientDetails' => $patientDetails,
                'contactParty' => $contactParty,
                'referringPhysician' => $referringPhysician,
                'patientPrimaryConcern' => $patientPrimaryConcern,
                'expertOpinionRequests' => $expertOpinionRequests,
                'paymentDetails' => $paymentDetails,
                'medicalRecords' => $medicalRecords,
                "customeShareFiles" => (!empty($customeShareFiles)) ? compact("customeShareFiles") : null,
                'countries' => $countries,
                'states' => $states,
                'authToken' => $this->shareFileService->getAccessToken()
            ]);
        } else {       
            return redirect()->route('home');
        }
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

    public function download($fileId)
    {        
        try {
            $accessToken = $this->shareFileService->getAccessToken();
            $uri = "https://{$this->subdomain}.sf-api.com/sf/v3/Items($fileId)/Download";
            $response = $this->client->get($uri, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'allow_redirects' => false, // Prevent Guzzle from automatically following redirects
            ]);
    
            $downloadUrl = $response->getHeaderLine('Location');
            
            // Debugging: check if the download URL is retrieved
            if (empty($downloadUrl)) {
                throw new \Exception('Download URL not found.');
            }
    
            // Redirect to the actual download URL
            return redirect()->away($downloadUrl);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function viewFile($id)
    {
        // $accessToken = $this->shareFileService->getAccessToken();
        // $url = "https://{$this->subdomain}.sf-api.com/sf/v3/Items({$id})";
        
        // $response = $this->client->request('GET', $url, [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . $accessToken,
        //         'Accept'        => 'application/json',
        //     ],
        // ]);

        // if ($response->getStatusCode() == 200) {
        //     $contentType = $response->getHeader('Content-Type')[0];
        //     $body = $response->getBody();

        //     return response($body, 200)
        //         ->header('Content-Type', $contentType);
        // }

        // return abort(404);

        $accessToken = $this->shareFileService->getAccessToken();
        $url = "https://{$this->subdomain}.sf-api.com/sf/v3/Items({$id})/Download";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept'        => 'application/octet-stream',
        ])->get($url);

        if ($response->successful()) {
            $contentType = $response->header('Content-Type');
            return Response::make($response->body(), 200, [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'inline; filename="' . $id . '"'
            ]);
        }

        return abort(404, 'File not found');
    }


    public function getAuthorizationHeader($token)
    {
        // Implement your logic to get the authorization header based on the token
        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }

}
?>