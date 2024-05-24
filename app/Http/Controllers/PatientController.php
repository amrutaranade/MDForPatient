<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
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

        return view('patient-registration',[
            'countries' => $getCountriesData,
            'states' => $getStatesData,
         ]);
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
            'first-name' => 'required|string|max:255',
            'middle-name' => 'nullable|string|max:255',
            'last-name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Male,Female',
            'countries' => 'required|integer',
            'states' => 'required|integer',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'street_address' => 'required|string|max:255',
        ]);
        // Save the data to the database or perform any other necessary actions
        $data =  PatientsRegistrationDetail::create([
            "first_name" => $requestData["first-name"],
            "middle_name" => $requestData["middle-name"],
            "last_name" => $requestData["last-name"],
            "date_of_birth" => $requestData["date_of_birth"],
            "gender" => $requestData["gender"],
            "country" => $requestData["countries"],
            "state" => $requestData["states"],
            "city" => $requestData["city"],
            "postal_code" => $requestData["postal_code"],
            "street_address" => $requestData["street_address"],
        ]);
 // Redirect to another tab or section
 return redirect()->route('home')->with('success', 'Patient details saved successfully!');
    }
}
