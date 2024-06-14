<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\PatientsRegistrationDetail;

class UniqueEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email already exists
        return !PatientsRegistrationDetail::where('email', $value)->exists();
    }

    public function message()
    {
        return 'The :attribute is already registered.';
    }
}
