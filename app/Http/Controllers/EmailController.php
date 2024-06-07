<?php

namespace App\Http\Controllers;

use Google\Service\Gmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Google\Client as GoogleClient;
use Google\Service\Gmail\Message;

class EmailController extends Controller
{
    
    public function redirectToGoogle()
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope('https://www.googleapis.com/auth/gmail.send');

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->authenticate($request->code);

        $token = $client->getAccessToken();
        $request->session()->put('google_token', $token);

        return redirect()->route('send-email');
    }

    public function sendEmail(Request $request)
    {
        $token = $request->session()->get('google_token');
        if (!$token) {
            return redirect()->route('auth/google');
        }

        $client = new GoogleClient();
        $client->setAccessToken($token);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $request->session()->put('google_token', $client->getAccessToken());
        }

        $service = new Gmail($client);

        $message = new Message();
        $rawMessageString = "From: intake@mdforpatients.com\r\n";
        $rawMessageString .= "To: yogeshwari.amrutaphadke@gmail.com\r\n";
        $rawMessageString .= "Subject: Test Email\r\n\r\n";
        $rawMessageString .= "This is a test email from your Laravel application 123545645747.";
        $encodedMessage = base64_encode($rawMessageString);
        $encodedMessage = str_replace(['+', '/', '='], ['-', '_', ''], $encodedMessage);
        $message->setRaw($encodedMessage);

        $service->users_messages->send('me', $message);

        return 'Email sent successfully';
    }

    

}