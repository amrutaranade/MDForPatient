<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'stripe' => [
		'stripe_key' => env('STRIPE_KEY'),
		'stripe_secret_key' => env('STRIPE_SECRET'),
        'stripe_currency' => 'usd',
        'stripe_amount' => 19900,
        'stripe_display_amount' => '$199.00',
	],
    'shareFile' => [
        'sharefile_client_id' => "FnQaFTXG1JGb2DdjyODW2XTOlMo4LeXJ",
        'sharefile_client_secret' => "m7Q4Nw1komawXbuUIneP7uAn8Se1q3wQGYJUPgknXOI0IjhV",
        'sharefile_username' => "aalex@discoveralpha.com",
        'sharefile_password' => "gbtt q5ty o5dv cz3l",
        'sharefile_subdomain' => "mdforpatients2",
    ]

];
