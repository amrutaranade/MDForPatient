<?php

namespace App\Http\Controllers;

use Google\Service\Gmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Google\Client as GoogleClient;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use App\Mail\WelcomeEmail;
use App\Mail\AdminEmail;
use App\Mail\AlertEmail;

class EmailController extends Controller
{    public function sendEmail($recipientEmail, $details)
    {
        Mail::to($recipientEmail)->send(new OtpEmail($details));
    }

    public function sendWelcomEmail($recipientEmail, $details, $ccName, $ccEmail)
    {
        Mail::to($recipientEmail)->cc($ccEmail, $ccName)->send(new WelcomeEmail($details));
    } 

    public function sendAdminMail($recipientEmail, $details)
    {
        Mail::to($recipientEmail)->send(new AdminEmail($details));
    }

    public function sendAlertMail($recipientEmail, $details)
    {
        Mail::to($recipientEmail)->send(new AlertEmail($details));
    }

}