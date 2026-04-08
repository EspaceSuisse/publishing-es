<?php

use craft\helpers\App;

return [
    '*' => [
        'cachingEnabled' => false,
        'warmCacheAutomatically' => true,
        'refreshCacheAutomaticallyForGlobals' => false,
        'debug' => true,
        'queryStringCaching' => \putyourlightson\blitz\models\SettingsModel::QUERY_STRINGS_CACHE_URLS_AS_UNIQUE_PAGES,
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
        'cachingEnabled' => false,
    ],
];
