<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsRegistrationDetail extends Model
{
    use HasFactory;


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $table = 'patients_registration_details';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'ip_address',
        'latitude',
        'longitude',
        'browser_agent',
        
    ];
}
