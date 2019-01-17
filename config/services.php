<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'facebook' => [
        'client_id' =>'802233120114125',
        'client_secret' =>'d50dbab55c4be751920eac24de7b449a',
        'redirect' =>'http://localhost/authentication/public/login/facebook/callback',
    ],
    'twitter' => [
        'client_id' =>'6JNOCE1Ic2jPXWc6WHwhcuqVb',
        'client_secret' =>'ZFDF7giXxdUrAAGDJoG559n4OEPqSC3HPP1muUXhz7khOxX7KY',
        'redirect' =>'http://localhost/authentication/public/login/twitter/callback',
    ],
    'google' => [
        'client_id' =>'1094668221801-27u0vmi473pmp403rhcd0jk4vnk29gom.apps.googleusercontent.com',
        'client_secret' =>'N-oKykn6qYAm-Qnen0EZj_C1',
        'redirect' =>'http://localhost/authentication/public/login/google/callback',
    ]

];
