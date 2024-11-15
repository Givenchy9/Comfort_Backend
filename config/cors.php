<?php

return [
    'paths' => ['*'], // Pas aan naar jouw routes
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Of specificeer hier jouw domeinen
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
