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
            'login'     => 'arvelov_togost',
            'password1' => 'tQd4jyvg36I2v4LRaZFP',
            'password2' => 'IA4pPyx3x1j3lJtVUgQ6',
        ],
        'begent' => [
            'login'     => 'arvelov_begent',
            'password1' => 'NEhZBVH3C0hoi7PsN18E',
            'password2' => 'R8lzfrmO4ZD614HanVWy',
        ],
    ],

    'telegram' => [
        'bot_token' => '8083650333:AAFi-Wq3DjS9MGfmXgjC8pM09cbsoSOZjxs',
        'chat_id' => '237982888',
    ],

];
