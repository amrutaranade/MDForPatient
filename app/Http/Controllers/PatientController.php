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
use App\Models\PatientMedicalRecords;
use App\Models\PatientExpertOpinionRequest;
use App\Http\Controllers\EmailController;
use App\Rules\UniqueEmail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use PDF;


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
            // Decrypt the email before passing it to the view
            if ($patientDetails && !empty($patientDetails->email)) {
                $patientDetails->email = Crypt::decryptString($patientDetails->email);
            }
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

        Session::put("session_destroyed", false);
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
        'firstName' => 'required|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
        'middleName' => 'nullable|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
        'lastName' => 'required|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
        'email' => 'required|string|email|max:255',
        'dateOfBirth' => 'required',
        'country' => 'nullable|integer',
        'state' => 'nullable|integer',
        'city' => 'required|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
        'postalCode' => 'required|string|min:5|max:6|regex:/^[0-9-]*$/',
        'streetAddress' => 'required|string|max:255',
    ]);

    // Generate a unique ID for the form if not already present
    if (!$formId) {
        $formId = Str::uuid();
        session(['form_id' => $formId]);
    }    

    if($requestData["email"] !== $requestData["confirm_email"]) {
        return response()->json(['error' => 'Email and Confirm Email do not match.'], 422);
    }

    // Check if a patient already exists with the provided email and ID
    $existingPatient = $patientId ? PatientsRegistrationDetail::where(['id' => $patientId])->first() : null;

    $dateString = $requestData["dateOfBirth"];
    $dob = DateTime::createFromFormat('m-d-Y', $dateString);      
    $dateOfBirth = $dob->format('Ymd'); 
    $dob = $dob->format('Y-m-d');
    
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
            "date_of_birth" => $dob,
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

        $encryptedEmail = Crypt::encryptString($requestData["email"]);
        $emailHash = hash('sha256', $requestData["email"]);
        // Insert new patient data
        $patient = PatientsRegistrationDetail::create([
            "first_name" => $requestData["firstName"],
            "middle_name" => $requestData["middleName"],
            "last_name" => $requestData["lastName"],
            "email" => $encryptedEmail,
            "date_of_birth" => $dob,
            "country" => $requestData["country"],
            "state" => $requestData["state"],
            "city" => $requestData["city"],
            "postal_code" => $requestData["postalCode"],
            "street_address" => $requestData["streetAddress"],
            "patient_consulatation_number" => $patientConsulatationNumber,
            "email_hash" => $emailHash,
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
            'relationship_phone_number' => 'required|string|min:9|max:15|regex:/^[0-9-]*$/',
            'relationship_preferred_mode_of_communication' => 'required|string',
            'patientId' => 'required|integer'
        ]);

        // Check the form ID in the session
        $formId = session('form_id');
        if (!$formId) {
            return response()->json(['error' => 'Session expired or invalid form ID.'], 400);
        }

        if($requestData["relationship_email"] !== $requestData["relationship_confirm_email"]) {
            return response()->json(['error' => 'Email and Confirm Email do not match.'], 422);
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
            'firstName' => 'nullable|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
            'lastName' => 'nullable|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
            'institution' => 'nullable|string',
            'country' => 'nullable|integer',
            'state' => 'nullable|integer',
            'city' => 'nullable|string|max:255|regex:/^[a-zA-Z-\'\s]*$/',
            'postalCode' => 'nullable|string|min:5|max:6|regex:/^[0-9-]*$/',
            'streetAddress' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|min:9|max:15|regex:/^[0-9-]*$/',
            'patientId' => 'required|integer',
        ]);

        if( $requestData["email"] !== $requestData["confirm_email"]) {
            return response()->json(['error' => 'Email and Confirm Email do not match.'], 422);
        }

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

        $validatedData = $request->validate([
            'primary_diagnosis' => 'nullable|string|max:255',
            'treated_before' => 'nullable|string|max:255',
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

        return response()->json(['id' => $data->id], 201);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $emailHash = hash('sha256', $email);
        if ($email) {
            $emailExists = PatientsRegistrationDetail::where('email_hash', $emailHash)->exists();
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

    public function upload(Request $request) {     
        $folderName = session("patient_consulatation_number");
        $file = $request->files->get('qqfile');

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
       
        //Generate PDF file from here
        $pdfFilePath = $this->generatePDF($patientId);

        // Upload the generated PDF
        $this->shareFileService->uploadGeneratedPDF($pdfFilePath, session("patient_consulatation_number"));
        
        //Delete generated PDF from local storage
        unlink($pdfFilePath);
        
        if($patientId){
            // Get patient email
            $patient = PatientsRegistrationDetail::find($patientId);
            $patientDetailsEmail = $patient->email;
            $recipientEmail = $patientDetailsEmail;
            $details = [
                'title' => 'Welcome to MD For Patients',
                'body' => $patientConsulatationNumber
            ];

            $ccEmail = 'aalex@discoveralpha.com';
            $ccName = 'Anija Alex';

            // Send email to patient
            $this->emailController->sendWelcomEmail($recipientEmail, $details, $ccName, $ccEmail);

            // Get patient email
            $patient = PatientsRegistrationDetail::find($patientId);
            $recipientEmail = "aalex@discoveralpha.com";
            $details = [
                'title' => 'New Patient Registration - '. $patient->first_name . ' ' . $patient->last_name. ' - ' . $patient->patient_consulatation_number,
                'body' => $patientConsulatationNumber,
                'patientName' => $patient->first_name . ' ' . $patient->last_name,
            ];

            // Send email to admin
            $this->emailController->sendAdminMail($recipientEmail, $details, null, null);
            
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
        return redirect()->route('/');
    }

    public function thankYou() {
        session()->flush();
        return view('final-thank-you');
    }

    public function redirectToHome() {
        session()->flush();
        
        return redirect()->route('home');
    }

    public function checkSession(Request $request)
    {
        if(Session::get("session_destroyed") == true) {
            Session::put("session_destroyed", false);
            return response()->json(['session_expired' => true, 'message' => 'Your session has expired due to inactivity.']);
        } else {
            return response()->json(['session_expired' => false, 'message' => '']);
        }
    }

    private function cleanupInProgressData($patientId)
    {
        $patient = PatientsRegistrationDetail::find($patientId);
        if ($patient) {
            PatientMedicalRecords::where('patient_id', $patient->id)->delete();
            PatientExpertOpinionRequest::where('patient_id', $patient->id)->delete();
            ContactParty::where('patient_id', $patient->id)->delete();
            ReferringPhysician::where('patient_id', $patient->id)->delete();
            PatientPrimaryConcern::where('patient_id', $patient->id)->delete();
            $patient->delete();
        }
    }

    public function generatePDF($patientId) {
        // Get patient details
        $patientDetails = PatientsRegistrationDetail::Where("id", $patientId)->first();
        // Decrypt the email before passing it to the view
        // if ($patientDetails && !empty($patientDetails->email)) {
        //     $patientDetails->email = Crypt::decryptString($patientDetails->email);
        // }
        $contactParty = ContactParty::Where('patient_id', $patientId)->first();
        $referringPhysician = ReferringPhysician::Where('patient_id', $patientId)->first();
        $patientPrimaryConcern = PatientPrimaryConcern::Where('patient_id', $patientId)->first();
        $expertOpinionRequests = PatientExpertOpinionRequest::Where('patient_id', $patientId)->first();
        $medicalRecords = PatientMedicalRecords::Where('patient_id', $patientId)->first();
        $paymentDetails = Transaction::Where('patient_id', $patientId)->first();
        $countries = Country::get()->toArray();
        $states = State::get()->toArray();

        if (!$referringPhysician) {
            return response()->json(['error' => 'Referring physician details not found.'], 404);
        }

        
        // Create PDF
        $pdf = PDF::loadView('patient_details_pdf', compact('patientDetails', 'contactParty', 'referringPhysician', 'expertOpinionRequests','patientPrimaryConcern','paymentDetails', 'countries', 'states'));

        // Generate file name
        $fileName = $patientDetails->patient_consulatation_number . '.pdf';

        // Save PDF file
        $pdf->save(public_path('pdf/' . $fileName));
        $pdfFilePath = public_path('pdf/' . $fileName);
        
        return $pdfFilePath;
    }

    public function logout(Request $request) {
        session()->flush();
        return redirect()->route('home');
    }
    
}
?>