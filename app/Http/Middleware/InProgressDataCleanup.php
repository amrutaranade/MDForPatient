<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 
use App\Models\PatientsRegistrationDetail;
use App\Models\PatientMedicalRecords;
use App\Models\PatientExpertOpinionRequest;
use App\Models\ContactParty;
use App\Models\ReferringPhysician;
use App\Models\PatientPrimaryConcern;

class InProgressDataCleanup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('patient_id')) {
            $patientId = Session::get('patient_id');
            $lastActivity = Session::get('last_activity');

            // Debugging logs
            Log::info('Middleware executed.');
            Log::info('Patient ID: ' . $patientId);
            Log::info('Last Activity: ' . $lastActivity);

            // Check if the session has timed out
            if ($lastActivity && now()->diffInMinutes($lastActivity) >= 2) {
                Log::info('Session timed out.');

                // Perform the deletions
                $patient = PatientsRegistrationDetail::find($patientId);
                if ($patient) {
                    PatientMedicalRecords::where('patient_id', $patient->id)->delete();
                    PatientExpertOpinionRequest::where('patient_id', $patient->id)->delete();
                    ContactParty::where('patient_id', $patient->id)->delete();
                    ReferringPhysician::where('patient_id', $patient->id)->delete();
                    PatientPrimaryConcern::where('patient_id', $patient->id)->delete();
                    $patient->delete();
                }

                // Remove patient_id from session
                Session::forget('patient_id');
                Session::forget('last_activity');

                // Set a flash message for session expiration
                Session::flash('message', 'Your session has expired due to inactivity.');

                // Redirect to home page
                return redirect()->route('home');
            }

            // Update last activity timestamp
            Session::put('last_activity', now());
        }

        return $next($request);
    }
}
?>