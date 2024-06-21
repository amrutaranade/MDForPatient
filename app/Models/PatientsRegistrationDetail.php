<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class PatientsRegistrationDetail extends Model
{
    use HasFactory;

    public $timestamps = true;

    public $table = 'patients_registration_details';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'date_of_birth',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'patient_consulatation_number',
        'email_hash'
    ];

    protected $encryptable = [
        'first_name',
        'middle_name',
        'last_name',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'patient_consulatation_number',

    ];
 
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            // Ensure the value is encrypted before saving
            $value = Crypt::encryptString($value);
        }
 
        return parent::setAttribute($key, $value);
    }
 
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
 
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                // Ensure the value is decrypted if it was encrypted
                $value = Crypt::decryptString($value);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Handle the case where the decryption fails
                $value = null;
            }
        }
 
        return $value;
    }
}