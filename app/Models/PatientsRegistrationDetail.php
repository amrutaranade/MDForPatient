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
        'patient_consulatation_number'
    ];

    // Encrypt specific fields before saving
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->fillable) && !is_null($value) && $key !== 'date_of_birth') {
            $this->attributes[$key] = Crypt::encryptString($value);
        } else {
            parent::setAttribute($key, $value);
        }
    }

    // Decrypt specific fields
    public function getAttribute($key)
    {
        if (in_array($key, $this->fillable) && isset($this->attributes[$key]) && $key !== 'date_of_birth') {
            return Crypt::decryptString($this->attributes[$key]);
        } else {
            return parent::getAttribute($key);
        }
    }
}
