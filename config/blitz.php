<?php

use craft\helpers\App;
use putyourlightson\blitz\models\SettingsModel;


return [
    '*' => [
        'cachingEnabled' => false,
        'refreshCacheAutomaticallyForGlobals' => false,
        'debug' => true,
        'queryStringCaching' => SettingsModel::QUERY_STRINGS_CACHE_URLS_AS_UNIQUE_PAGES,
        'refreshMode' => SettingsModel::REFRESH_MODE_CLEAR,
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
        'cachingEnabled' => true,
    ],
    'staging' => [
        'cachingEnabled' => false,
    ],
    'production' => [
        'cachingEnabled' => true,
    ],
];
