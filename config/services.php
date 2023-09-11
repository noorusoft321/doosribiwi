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

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('APP_URL').'/google/callback'
    ],

    'facebook' => [
        'client_id'     => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect'      => env('APP_URL').'/facebook/callback'
    ],
    'authy' => [
        'key' => env('AUTHY_KEY'),
        'id'  => env('AUTHY_ID')
    ],
    'matchmakers' => [
        'Ms. Saba'      => '923491007312',
        'Mrs. Pirzada'  => '923488800021',
        'Ms. Asma'      => '923462141786',
        'Mrs. Brohi'    => '923488800889',
        'Ms. Maryum'    => '923458205861',
        'Mrs. Ahmed'    => '923468217988',
        'Mrs. Motiwala' => '923420005556',
        'Ms. Farah'     => '923491007313',
        'Mrs. Farooqui' => '923344444962',
    ]

];
