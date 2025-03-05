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
    // Set the default week start day for date pickers (0 = Sunday, 1 = Monday, etc.)
    ->defaultWeekStartDay(1)
    // Prevent generated URLs from including "index.php"
    ->omitScriptNameInUrls()
    // Preload Single entries as Twig variables
    ->preloadSingles()
    // Prevent user enumeration attacks
    ->preventUserEnumeration()
    // Set the @webroot alias so the clear-caches command knows where to find CP resources
    ->limitAutoSlugsToAscii(true)
    ->maxUploadFileSize(App::env('MAX_UPLOAD_FILE_SIZE'))
    ->cpTrigger(App::env('CP_TRIGGER') ?: 'admin')

    ->aliases([
        '@webroot' => dirname(__DIR__) . '/web',
        '@assetBaseUrl' => rtrim(getenv('PRIMARY_SITE_URL') . '/assets'),
        '@assetBasePath' => rtrim(getenv('CRAFT_WEB_ROOT') . '/assets'),
    ])
;
