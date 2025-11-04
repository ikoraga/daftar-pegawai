<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel 12 CORS Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'login', 'register', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:3000'],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
