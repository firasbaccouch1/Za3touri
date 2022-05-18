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
    'facebook' => [
        'client_id' => '382714467048833', //Facebook API
        'client_secret' => 'd4836819821a3192fd5b30ddfde2b882', //Facebook Secret
        'redirect' => 'https://za3touri.com/Login/facebook/callback',
     ],
     'google' => [
        'client_id' => '851795083204-krnb4qq97f3t852qtbv6qa2o41hm7cbi.apps.googleusercontent.com', //Facebook API
        'client_secret' => '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', //Facebook Secret
        'redirect' => 'https://za3touri.com/Login/google/callback',
     ],
     


];
