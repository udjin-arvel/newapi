<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'paths' => ['api/*'],
    'supportsCredentials' => false,
    'allowedOrigins' => ['http://localhost:8080', 'https://thebook.arvelov.com'],
    'allowedOriginsPatterns' => ['*'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
