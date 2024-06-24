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
    protected $encryptable = [
        'document_name',
        'folder_id'
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

