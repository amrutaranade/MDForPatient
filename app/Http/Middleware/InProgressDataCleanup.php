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
        $patientId = Session::get('patient_id');
        if (Session::has('patient_id')) {
            $lastActivity = Session::get('last_activity');
            Log::info("Last Activity - ". $lastActivity);
            Log::info("Patient Id - ". $patientId);
            Log::info("time diff - ". now()->diffInMinutes($lastActivity));
            
            if ($lastActivity && now()->diffInMinutes($lastActivity) > 1) {
                $patientId = Session::get('patient_id');
                $patient = PatientsRegistrationDetail::find($patientId);
                if ($patient) {
                    PatientMedicalRecords::where('patient_id', $patient->id)->delete();
                    PatientExpertOpinionRequest::where('patient_id', $patient->id)->delete();
                    ContactParty::where('patient_id', $patient->id)->delete();
                    ReferringPhysician::where('patient_id', $patient->id)->delete();
                    PatientPrimaryConcern::where('patient_id', $patient->id)->delete();
                    $patient->delete();
                    Log::info("Patient data deleted". $patientId);
                }
                session()->flush();
                Session::forget('patient_id');
                Session::forget('last_activity');
                Session::put("session_destroyed", true);
                return redirect()->route('home');//->with('session_expired', 'Your session has expired due to inactivity.');
            }            
        }
        
        Session::put('last_activity', now());
        return $next($request);
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
}
?>