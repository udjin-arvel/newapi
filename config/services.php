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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // TODO: Перенести в .env, если буду публиковать проект
    'robokassa' => [
        'togost' => [
            'login'     => env('ROBOKASSA_TOGOST_LOGIN'),
            'password1' => env('ROBOKASSA_TOGOST_PASSWORD1'),
            'password2' => env('ROBOKASSA_TOGOST_PASSWORD2'),
        ],
        'begent' => [
            'login'     => env('ROBOKASSA_BEGENT_LOGIN'),
            'password1' => env('ROBOKASSA_BEGENT_PASSWORD1'),
            'password2' => env('ROBOKASSA_BEGENT_PASSWORD2'),
        ],
    ],

    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'chat_id' => env('TELEGRAM_CHAT_ID'),
    ],

];
