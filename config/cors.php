<?php
return [
    'paths' => ['/*', 'sanctum/csrf-cookie'], // Allow all routes, not just API routes
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Change this to your frontend domain for security
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Change to true if using cookies or authentication
];
