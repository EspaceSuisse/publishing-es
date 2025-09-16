<?php

use craft\helpers\App;

return [
    '*' => [
        'cachingEnabled' => true,
        'warmCacheAutomatically' => true,
        'refreshCacheAutomaticallyForGlobals' => false,
        'debug' => true,
        'includedUriPatterns' => [
            ['uriPattern' => '.*'],
        ],
        'excludedUriPatterns' => [
            ['uriPattern' => '^/knock-knock/who-is-there'],
            // ['uriPattern' => '\.(json|xml|rss)$'],
        ],
    ],
    'dev' => [
        'cachingEnabled' => false,
    ],
    'staging' => [
        'cachingEnabled' => false,
    ],
];
