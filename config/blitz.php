<?php

use craft\helpers\App;

return [
    '*' => [
        'includedUriPatterns' => [
            ['uriPattern' => '.*'],
        ],
    ],
    'dev' => [
        'cachingEnabled' => false,
    ],
    'staging' => [
        'cachingEnabled' => false,
    ],
    'production' => [
        'cachingEnabled' => true,
    ],
];
