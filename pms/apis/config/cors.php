<?php

return [

    'paths' => ['api/*', 'users', 'login', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // For testing only

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];