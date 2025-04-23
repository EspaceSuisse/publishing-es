<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

return GeneralConfig::create()
    ->defaultWeekStartDay(1)
    ->omitScriptNameInUrls()
    ->preloadSingles()
    ->preventUserEnumeration()
    ->limitAutoSlugsToAscii(true)
    ->maxUploadFileSize(App::env('MAX_UPLOAD_FILE_SIZE' ?: '5M'))
    ->cpTrigger(App::env('CP_TRIGGER') ?: 'admin')
    ->timezone(App::env('TIMEZONE') ?: 'Europe/Zurich')
    ->securityKey(App::env('CRAFT_SECURITY_KEY'))
    ->generateTransformsBeforePageLoad(true)
    ->convertFilenamesToAscii(true)
    ->transformGifs(false) 
    ->aliases([
        '@webroot' => dirname(__DIR__) . '/web',
        '@assetBaseUrl' => rtrim(getenv('PRIMARY_SITE_URL') . '/assets'),
        '@assetBasePath' => rtrim(getenv('CRAFT_WEB_ROOT') . '/assets'),
    ])
;
