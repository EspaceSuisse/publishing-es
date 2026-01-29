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
            ['uriPattern' => '^actions/knock-knock'],
            ['uriPattern' => '^knock-knock'],
            ['uriPattern' => '^mitglieder-login'],
            ['uriPattern' => '^connexion-des-membres'],
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
