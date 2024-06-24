<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class PatientMedicalRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'document_name',
        'folder_id'
    ];
}

