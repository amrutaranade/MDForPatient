<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;


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
        'relationship_other'

        
    ];
    protected $encryptable = [
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
        'relationship_other'
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

