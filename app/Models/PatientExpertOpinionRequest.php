<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
    protected $encryptable = [
        'cover_letter',
        'agreement',
        'patient_agreement',
        'appendix_1',
        'appendix_2',
        'appendix_3',
        'appendix_4',
        're_type_name'
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

