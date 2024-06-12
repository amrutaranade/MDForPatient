<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Add the fillable property
    protected $fillable = [
        'email',
        'patient_id',
        'card_last4',
        'amount',
        'currency',
        'charge_id',
        'status'
    ];
}