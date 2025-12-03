<?php

use craft\helpers\App;

return [
    '*' => [
        'cachingEnabled' => false,
        'warmCacheAutomatically' => true,
        'refreshCacheAutomaticallyForGlobals' => false,
        'debug' => true,
        'includedUriPatterns' => [
            ['uriPattern' => '.*'],
        ],
        'excludedUriPatterns' => [
            ['uriPattern' => '^/knock-knock/who-is-there'],
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
