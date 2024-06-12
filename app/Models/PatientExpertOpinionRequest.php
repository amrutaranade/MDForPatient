<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientExpertOpinionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'cover_letter',
        'agreement',
        'patient_agreement',
        'appendix_1',
        'appendix_2',
        'appendix_3',
        'appendix_4',
        're_type_name'


    ];
}
