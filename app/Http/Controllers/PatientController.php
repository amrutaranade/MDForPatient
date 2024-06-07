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

class PatientController extends Controller
{
    /**
    * addGame page
    */
    public function patientFormView()
    {
        

        $getCountriesData = Country::get()->toArray();
        $getStatesData = State::get()->toArray();

        return view('patient-registration', [
            'countries' => $getCountriesData,
            'states' => $getStatesData
        ]);
    }

    // Helper method to delete incomplete form data
    private function deleteIncompleteFormData($formId)
    {
        $patient = PatientsRegistrationDetail::where('form_id', $formId)->first();
        if ($patient) {
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
        ]);

        // Store the patient ID in the session
        session(['patient_id' => $patient->id]);
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
                "phone_number" => $requestData["relationship_phone_number"],
                "preferred_mode_of_communication" => $requestData["relationship_preferred_mode_of_communication"],
                "preferred_contact_time" => $requestData["relationship_preferred_contact_time"],
                "first_name" => $requestData["relationship_first_name"],
                "last_name" => $requestData["relationship_last_name"],
                "NPI" => $requestData["relationship_npi"],
                "street_address" => $requestData["relationship_street_address"],
                "city" => $requestData["relationship_city"],
                "postal_code" => $requestData["relationship_postal_code"],
                "country" => $requestData["relationship_countries"],
                "state" => $requestData["relationship_states"],
                "Instituton" => $requestData["relationship_institution"],
                "fax_number" => $requestData["relationship_fax_no"],
                "relationship_other" => $requestData["relationship_other"],
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
        $exists = PatientsRegistrationDetail::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
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
}
?>