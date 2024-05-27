<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\ContactParty;
use App\Models\PatientsRegistrationDetail;

class PatientController extends Controller
{
    /**
    * addGame  page
    */
    public function patientFormView()
    {
        $getCountriesData = Country::get()->toArray();
        $getStatesData = State::get()->toArray();

        return view('patient-registration', [
            'countries' => $getCountriesData,
            'states' => $getStatesData]);
    }

    public function getStates($country_name)
    {
        $states = State::where('country_name', $country_name)->get();
        return response()->json($states);
    }


        public function savePatientsDetailsFormSection1(Request $request)
        {
            $requestData = $request->all();

            // Validate the request
            $validatedData = $request->validate([
                'firstName' => 'required|string|max:255',
                'middleName' => 'nullable|string|max:255',
                'lastName' => 'required|string|max:255',
                'dateOfBirth' => 'required|date',
                'gender' => 'nullable|string|in:Male,Female',
                'country' => 'nullable|integer',
                'state' => 'nullable|integer',
                'city' => 'required|string|max:255',
                'postalCode' => 'required|string|max:10',
                'streetAddress' => 'required|string|max:255',
            ]);
            // Save the data to the database or perform any other necessary actions
            $patient =  PatientsRegistrationDetail::create([
                "first_name" => $requestData["firstName"],
                "middle_name" => $requestData["middleName"],
                "last_name" => $requestData["lastName"],
                "date_of_birth" => $requestData["dateOfBirth"],
                "gender" => $requestData["gender"],
                "country" => $requestData["country"],
                "state" => $requestData["state"],
                "city" => $requestData["city"],
                "postal_code" => $requestData["postalCode"],
                "street_address" => $requestData["streetAddress"],
            ]);

            return response()->json(['id' => $patient->id], 201);

    }


    public function saveContactPartyFormSection2(Request $request){
        $requestData = $request->all();

        // Validate the request
        $validatedData = $request->validate([
            'relationship_to_patient' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|integer',
            'preferred_mode_of_communication' => 'required|string',
            'preferred_contact_time' => 'required|string',
            'patientId' => 'required|integer',
        ]);
        // Save the data to the database or perform any other necessary actions
        $contactparty =  ContactParty::create([
            "relationship_to_patient" => $requestData["relationship_to_patient"],
            "email" => $requestData["email"],
            "phone_number" => $requestData["phone_number"],
            "preferred_mode_of_communication" => $requestData["preferred_mode_of_communication"],
            "preferred_contact_time" => $requestData["preferred_contact_time"],
            "patient_id" => $requestData["patientId"],

        ]);

        return response()->json(['id' => $contactparty->id], 201);
    }
}
