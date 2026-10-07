<?php

use craft\helpers\App;
use putyourlightson\blitz\models\SettingsModel;

return [
    '*' => [
        'cachingEnabled' => false,
        'refreshCacheAutomaticallyForGlobals' => false,
        'debug' => true,
        
        // Tell Blitz to cache unique query strings as unique pages
        'queryStringCaching' => SettingsModel::QUERY_STRINGS_CACHE_URLS_AS_UNIQUE_PAGES,
        
        // Tell Blitz WHICH query strings it is allowed to look at
        'includedQueryStringParams' => [
            [
                'siteId' => '', // Applies to all sites
                'queryStringParam' => 'section', // Whitelist your 'section' query string
            ],
        ],

        'refreshMode' => SettingsModel::REFRESH_MODE_CLEAR_AND_GENERATE,
        'includedUriPatterns' => [
            ['uriPattern' => '.*'],
        ],
        'excludedUriPatterns' => [
            ['uriPattern' => '^actions/knock-knock'],
            ['uriPattern' => '^knock-knock'],
            ['uriPattern' => '^mitglieder-login'],
            ['uriPattern' => '^connexion-des-membres'],
            ['uriPattern' => '^suche'],
            ['uriPattern' => '^chercher'],
            ['uriPattern' => '\.(json|xml|rss)$'],
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