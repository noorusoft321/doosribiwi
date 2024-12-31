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
    'keywords' => [
        'islamic-second-marriage',
        '2nd-marriage-in-islam',
        'islam-and-second-marriage',
        'second-wife-islam',
        'muslim-second-wife',
        'muslim-second-marriage',
        'muslim-2nd-marriage',
        'muslim-second-wife-website',
        '2nd-marriage-islam',
        'being-a-second-wife-in-islam',
        'being-a-second-wife-islam',
        'being-second-wife-in-islam',
        'having-a-second-wife-in-islam',
        'islamic-second-marriage-website',
        'looking-for-second-marriage-muslim',
        'marrying-a-second-wife-in-islam',
    ],
    'app_name' => env('APP_NAME'),
    'app_url' => env('APP_URL'),
    'matchmakers' => [
        'Ms. Saba'      => '923491007312',
        'Mrs. Pirzada'  => '923488800021',
        'Mrs. Brohi'    => '923488800889',
        'Ms. Maryum'    => '923458205861',
        'Mrs. Ahmed'    => '923468217988',
        'Mrs. Motiwala' => '923420005556',
        'Ms. Farah'     => '923491007313',
        'Mrs. Farooqui' => '923344444962',
        'Mrs. Shahid'   => '923462141786',
        'Mrs. Arain'    => '923428504242',
        'Mrs. Sophia'   => '+923309976704',
        'Mrs. Salma'    => '+923309976705'
    ],
    'bdos' => [
        'Mrs. Syed'     => '923460025624',
        'Mrs. Siddiqui' => '923362007860',
        'Mrs. Shah'     => '923331362601',
        'Mrs. Ansari'   => '923468218988',
        'Ms. Fiza'      => '923491007317',
        'Ms. Anila'     => '923491007316',
        'Mrs. Khan'     => '923432435092',
        'Mrs. Hashmi'   => '923102658315',
        'Mrs. Jafri'    => '923420005552',
        'Mrs. Saeed'    => '923420005553',
        'Ms. Nida'      => '923491007314',
        'Ms. Shehla'    => '923491007105',
        'Ms. Hina'      => '923491007101',
        'Ms. Fariha'    => '923491007310',
        'Mrs. Lodhi'    => '923420005588',
        'Ms. Fatima'    => '923420005544',
        'Ms. Zoya'      => '923491007104',
        'Mrs. Choudhary (USA 🇺🇸 /Canada 🇨🇦) WhatsApp' => '+13152880174',
        'Mrs. Malik (UK 🇬🇧) WhatsApp' => '+447402449583',
        'Dr. Anum' => '+923301239098',
        'Mrs. Khan (Australia 🇦🇺) WhatsApp' => '+61480009047'
    ],
    'verification_status' => [
        '1' => 'Verified',
        '2' => 'Not Verified',
        '3' => 'Semi Verified'
    ]
];
