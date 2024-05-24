<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPrimaryConcern extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'primary_diagnosis',
        'treated_before',
        'request_description'
    ];
}

