<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientExpertOpinionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'agree_to_terms',
        'cover_letter',
        'patient_agreement',
        'sign_off',
        'ip_address',
        'latitude',
        'longitude',
        'browser_agent',
    ];
}
