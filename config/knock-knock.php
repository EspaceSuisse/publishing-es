<?php

return [
    '*' => [
        'enabled' => false,
        'enableCpProtection' => false,
        'password' => App::env('STAGING_FRONTEND_PASSWORD')),
        'siteSettings' => [],
        'checkInvalidLogins' => false,
        'invalidLoginWindowDuration' => '3600',
        'maxInvalidLogins' => 10,
    ],
    'staging' => [
        'enabled' => true,
    ],
];