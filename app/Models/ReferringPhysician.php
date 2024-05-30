<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferringPhysician extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'patient_id',
        'last_name',
        'institution',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'email',
        'phone_number',
        'fax_number',

    ];
}
