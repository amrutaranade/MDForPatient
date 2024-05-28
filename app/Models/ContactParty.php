<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'relationship_to_patient',
        'email',
        'phone_number',
        'preferred_mode_of_communication',
        'preferred_contact_time',
        'first_name',
        'last_name',
        'NPI',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'Instituton',
        'fax_number',
        'patient_id',
        'ip_address',
        'latitude',
        'longitude',
        'browser_agent',
        
    ];
}


