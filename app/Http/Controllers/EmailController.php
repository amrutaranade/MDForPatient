<?php

namespace App\Http\Controllers;

use Google\Service\Gmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Google\Client as GoogleClient;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
class EmailController extends Controller
{
    
   
        public function sendEmail($recipientEmail, $details)
        {
            Mail::to($recipientEmail)->send(new OtpEmail($details));
        }
    

}