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
        'card_last4',
        'card_brand',
        'card_exp_month',
        'card_exp_year',
        'amount',
        'currency',
        'charge_id',
        'status'
    ];
}