<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'otp',
        'expires_at',
    ];

    public $timestamps = false;

    protected $dates = [
        'expires_at',
    ];
}

?>
