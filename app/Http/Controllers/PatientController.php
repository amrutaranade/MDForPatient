<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\ContactParty;
use App\Models\PatientsRegistrationDetail;
use App\Models\ReferringPhysician;
use App\Models\PatientPrimaryConcern;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Otp;
use App\Services\ShareFileService;
use DateTime;
use Google\Service\AdExchangeBuyerII\Date;
use Google\Service\AdMob\Date as AdMobDate;
use Illuminate\Support\Facades\Crypt;
use App\Models\PatientMedicalRecords;
use App\Models\PatientExpertOpinionRequest;
use App\Http\Controllers\EmailController;
use App\Rules\UniqueEmail;
use App\Models\Transaction;


class PatientController extends Controller
{
    protected $shareFileService;
    protected $emailController;

    
    public function __construct(ShareFileService $shareFileService,EmailController $emailController)
    {
        $this->shareFileService = $shareFileService;
        $this->emailController = $emailController;

    }

    public function patientFormView()
    {     
        $getCountriesData = Country::get()->toArray();
        $getStatesData = State::get()->toArray();
        
        //Check if patient_id is present in session, if yes fetch all the data 
        if(!empty(session("patient_id"))) {
            $patientId = session("patient_id");
            $patientDetails = PatientsRegistrationDetail::find($patientId);
            $contactParty = ContactParty::where('patient_id', $patientId)->first();
            $referringPhysician = ReferringPhysician::where('patient_id', $patientId)->first();
            $patientPrimaryConcern = PatientPrimaryConcern::where('patient_id', $patientId)->first();
            $expertOpinionRequests = PatientExpertOpinionRequest::where('patient_id', $patientId)->first();
            $medicalRecords = PatientMedicalRecords::where('patient_id', $patientId)->first();
            $paymentDetails = Transaction::where('patient_id', $patientId)->first();
            $countries = Country::get()->toArray();
            $states = State::get()->toArray();
            if($medicalRecords) {
                $customeShareFiles = $this->getShareFilesByFolderId($medicalRecords->folder_id);
            } else {
                $customeShareFiles = [];
            }
            
            return view('patient-registration', [
                'patientDetails' => $patientDetails,
                'contactParty' => $contactParty,
                'referringPhysician' => $referringPhysician,
                'patientPrimaryConcern' => $patientPrimaryConcern,
                'expertOpinionRequests' => $expertOpinionRequests,
                'paymentDetails' => $paymentDetails,
                'medicalRecords' => $medicalRecords,
                'countries' => $countries,
                'states' => $states,
                'customeShareFiles' => $customeShareFiles
            ]);
        }

        return view('patient-registration', [
            'countries' => $getCountriesData,
            'states' => $getStatesData
        ]);
    }

    // Helper method to delete incomplete form data
    private function deleteIncompleteFormData($patientId)
    {
        $patient = PatientsRegistrationDetail::where('id', $patientId)->first();
        if ($patient) {
            PatientMedicalRecords::where('patient_id', $patient->id)->delete();
            PatientExpertOpinionRequest::where('patient_id', $patient->id)->delete();
            ContactParty::where('patient_id', $patient->id)->delete();
            ReferringPhysician::where('patient_id', $patient->id)->delete();
            PatientPrimaryConcern::where('patient_id', $patient->id)->delete();
            $patient->delete();
        }
    }


    public function getStates($country_name)
    {
        $states = State::where('country_name', $country_name)->get();
        return response()->json($states);
    }

    public function savePatientsDetailsFormSection1(Request $request)
{
    $requestData = $request->all();

    // Check if a form ID is present in the session
    $formId = session('form_id');
    $patientId = session('patient_id');

    // Validate the request
    $validatedData = $request->validate([
        'firstName' => 'required|string|max:255',
        'middleName' => 'nullable|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'dateOfBirth' => 'required|date',
        'country' => 'nullable|integer',
        'state' => 'nullable|integer',
        'city' => 'required|string|max:255',
        'postalCode' => 'required|string|max:10',
        'streetAddress' => 'required|string|max:255',
    ]);

    // Generate a unique ID for the form if not already present
    if (!$formId) {
        $formId = Str::uuid();
        session(['form_id' => $formId]);
    }    

    // Check if a patient already exists with the provided email and ID
    $existingPatient = $patientId ? PatientsRegistrationDetail::where('id', $patientId)->first() : null;

    if ($existingPatient) {
        // If the email is different from the existing one, validate for uniqueness
        if ($existingPatient->email !== $requestData['email']) {
            $emailValidation = $request->validate([
                'email' => 'unique:patients_registration_details,email',
            ]);
        }

        // Update the existing patient data
        $existingPatient->update([
            "first_name" => $requestData["firstName"],
            "middle_name" => $requestData["middleName"],
            "last_name" => $requestData["lastName"],
            "email" => $requestData["email"],
            "date_of_birth" => $requestData["dateOfBirth"],
            "country" => $requestData["country"],
            "state" => $requestData["state"],
            "city" => $requestData["city"],
            "postal_code" => $requestData["postalCode"],
            "street_address" => $requestData["streetAddress"],
        ]);
        $patient = $existingPatient;
    } else {
        

        // Generate the string
        $randomNum = rand(10000, 99999);
        $patientName = $requestData["firstName"].$requestData["middleName"].$requestData["lastName"];
        $dateOfBirth = new DateTime($requestData["dateOfBirth"]);
        $dateOfBirth = $dateOfBirth->format('Ymd');
        $currentDate = new DateTime();
        $currentDate = $currentDate->format('Ymd');
        $patientConsulatationNumber = "{$randomNum}_{$patientName}_{$dateOfBirth}_{$currentDate}";

        // Check if the patient consultation number already exists
        $existingPatient = PatientsRegistrationDetail::where('patient_consulatation_number', $patientConsulatationNumber)->first();
        if ($existingPatient) {
            // Generate a new patient consultation number
            $randomNum = rand(10000, 99999);
            $patientConsulatationNumber = "{$randomNum}_{$patientName}_{$dateOfBirth}_{$currentDate}";
        }


        // Insert new patient data
        $patient = PatientsRegistrationDetail::create([
            "first_name" => $requestData["firstName"],
            "middle_name" => $requestData["middleName"],
            "last_name" => $requestData["lastName"],
            "email" => $requestData["email"],
            "date_of_birth" => $requestData["dateOfBirth"],
            "country" => $requestData["country"],
            "state" => $requestData["state"],
            "city" => $requestData["city"],
            "postal_code" => $requestData["postalCode"],
            "street_address" => $requestData["streetAddress"],
            "patient_consulatation_number" => $patientConsulatationNumber,
        ]);

        // Store the patient ID in the session
        session(['patient_id' => $patient->id]);

        // Store the data string in the session
        session(['patient_consulatation_number' => $patientConsulatationNumber]);
        
    }    
    

    return response()->json(['id' => $patient->id, 'form_id' => $formId], 201);
}

    public function saveContactPartyFormSection2(Request $request)
    {
        $requestData = $request->all();

        // Validate the request
        $validatedData = $request->validate([
            'relationship_to_patient' => 'nullable|string|max:255',
            'relationship_email' => 'required|string|max:255',
            'relationship_phone_number' => 'required|integer',
            'relationship_preferred_mode_of_communication' => 'required|string',
            'patientId' => 'required|integer',
        ]);

        // Check the form ID in the session
        $formId = session('form_id');
        if (!$formId) {
            return response()->json(['error' => 'Session expired or invalid form ID.'], 400);
        }
        
        // Save or update the data to the database
        $contactParty = ContactParty::updateOrCreate(
            ['patient_id' => $requestData['patientId']], // Find by patient_id
            [
                "relationship_to_patient" => $requestData["relationship_to_patient"],
                "email" => $requestData["relationship_email"],
                "phone_number" => isset($requestData["relationship_phone_number"]) ? $requestData["relationship_phone_number"] : null,
                "preferred_mode_of_communication" => isset($requestData["relationship_preferred_mode_of_communication"]) ? $requestData["relationship_preferred_mode_of_communication"] : '', 
                "preferred_contact_time" => isset($requestData["relationship_preferred_contact_time"]) ? $requestData["relationship_preferred_contact_time"] : '',
                "first_name" => isset($requestData["relationship_first_name"]) ? $requestData["relationship_first_name"]: null,
                "last_name" => isset($requestData["relationship_last_name"]) ? $requestData["relationship_last_name"] : null,
                "NPI" => isset($requestData["relationship_npi"]) ? $requestData["relationship_npi"] : null,
                "street_address" => isset($requestData["relationship_street_address"]) ?$requestData["relationship_street_address"] : null,
                "city" => isset($requestData["relationship_city"]) ? $requestData["relationship_city"] : null,
                "postal_code" => isset($requestData["relationship_postal_code"]) ? $requestData["relationship_postal_code"] :  null,
                "country" => isset($requestData["relationship_countries"]) ? $requestData["relationship_countries"] : null,
                "state" => isset($requestData["relationship_states"]) ? $requestData["relationship_states"]: null,
                "Instituton" => isset($requestData["relationship_institution"]) ? $requestData["relationship_institution"] : null,
                "fax_number" => isset($requestData["relationship_fax_no"]) ? $requestData["relationship_fax_no"] : null,
                "relationship_other" => isset($requestData["relationship_other"]) ? $requestData["relationship_other"] : null,
            ]
        );

        return response()->json(['id' => $contactParty->id], 201);
    }

    public function savePatientsPhysicianFormSection3(Request $request)
    {
        $requestData = $request->all();

        // Validate the request
        $validatedData = $request->validate([
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'institution' => 'nullable|string',
            'country' => 'nullable|integer',
            'state' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'postalCode' => 'nullable|string|max:10',
            'streetAddress' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_number' => 'nullable|integer',
            'patientId' => 'required|integer',
        ]);

        // Check the form ID in the session
        $formId = session('form_id');
        if (!$formId) {
            return response()->json(['error' => 'Session expired or invalid form ID.'], 400);
        }

        // Save or update the data to the database
        $data = ReferringPhysician::updateOrCreate(
            ['patient_id' => $requestData['patientId']], // Find by patient_id
            [
                "first_name" => $requestData["firstName"],
                "last_name" => $requestData["lastName"],
                "institution" => $requestData["institution"],
                "country" => $requestData["country"],
                "state" => $requestData["state"],
                "city" => $requestData["city"],
                "postal_code" => $requestData["postalCode"],
                "street_address" => $requestData["streetAddress"],
                "email" => $requestData["email"],
                "phone_number" => $requestData["phone_number"],
            ]
        );

        return response()->json(['id' => $data->id], 201);
    }

    public function savePrimaryConcernsFormSection4(Request $request)
    {
        $requestData = $request->all();

        // Validate the request
        $validatedData = $request->validate([
            'primary_diagnosis' => 'nullable|string|max:255',
            'treated_before' => 'nullable|string|max:255',
            'surgery_description' => 'nullable|string',
            'request_description' => 'nullable|string',
            'patientId' => 'required|integer',
        ]);

        // Check the form ID in the session
        $formId = session('form_id');
        if (!$formId) {
            return response()->json(['error' => 'Session expired or invalid form ID.'], 400);
        }

        // Save or update the data to the database
        $data = PatientPrimaryConcern::updateOrCreate(
            ['patient_id' => $requestData['patientId']], // Find by patient_id
            [
                "primary_diagnosis" => $requestData["primary_diagnosis"],
                "treated_before" => $requestData["treated_before"],
                "surgery_description" => $requestData["surgery_description"],
                "request_description" => $requestData["request_description"],
            ]
        );

        // Check if the form is completed and clear the session
        $this->checkFormCompletion($requestData["patientId"]);

        return response()->json(['id' => $data->id], 201);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        if ($email) {
            $emailExists = PatientsRegistrationDetail::where('email', $email)->exists();
            return response()->json(['exists' => $emailExists]);
        }
        return response()->json(['exists' => false]);
    }
    

    // Helper method to check form completion and clear session if complete
    private function checkFormCompletion($patientId)
    {
        // Check if all sections are filled for the given patientId
        $patientDetails = PatientsRegistrationDetail::find($patientId);
        $contactParty = ContactParty::where('patient_id', $patientId)->exists();
        $physician = ReferringPhysician::where('patient_id', $patientId)->exists();
        $primaryConcern = PatientPrimaryConcern::where('patient_id', $patientId)->exists();

        if ($patientDetails && $contactParty && $physician && $primaryConcern) {
            // Clear the session data
            session()->forget(['form_id', 'form_start_time']);
        }
    }

    public function generateOtp($patientId) {        
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

    public function verifyOtp(Request $request) {
        //$user = auth()->user();
        $otp = $request->input('otp');

        // Retrieve the latest OTP for the user
        $otpEntry = Otp::where('otp', $otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->orderBy('created_at', 'desc')
                        ->first();

        if ($otpEntry) {
            return redirect("patientConsultationView");
        }

        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

    public function upload(Request $request)
    {        
        $folderName = session("patient_consulatation_number") ?? $request->input('patient_consulatation_number');
        $file = $request->files->get('file');

        try {
            $result = $this->shareFileService->ensureFolderExistsAndUploadFile($request, $folderName, $file);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finalSubmission() {
        $patientConsulatationNumber = session("patient_consulatation_number");
       
        $patientId = session('patient_id');
        if($patientId){

        // Get patient email
        $patient = PatientsRegistrationDetail::find($patientId);
        $recipientEmail = $patient->email;
        $details = [
            'title' => 'Welcome to MD For Patients',
            'body' => $patientConsulatationNumber
        ];

        // Send email
        $this->emailController->sendWelcomEmail($recipientEmail, $details);

         }
        session()->flush();

        return view('thank-you', [
            'patient_consulatation_number' => $patientConsulatationNumber
        ]);
    }

    public function getShareFilesByFolderId($folderId){
        try {
            $result = $this->shareFileService->getShareFilesByFolderId($folderId);
            return $result;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function discardApplication() {
        $patientId = session('patient_id');


        $this->deleteIncompleteFormData($patientId);
        session()->flush();
        return redirect()->route('home');
    }
    
}
?>