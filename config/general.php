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
use mikehaertl\shellcommand\Command as ShellCommand;


return GeneralConfig::create()
    ->defaultWeekStartDay(1)
    ->omitScriptNameInUrls()
    ->preloadSingles()
    ->preventUserEnumeration()
    ->limitAutoSlugsToAscii(true)
    ->cpTrigger(App::env('CP_TRIGGER') ?: 'admin')
    ->timezone(App::env('TIMEZONE') ?: 'Europe/Zurich')
    ->securityKey(App::env('CRAFT_SECURITY_KEY'))
    ->generateTransformsBeforePageLoad(true)
    ->allowAdminChanges(App::env('CRAFT_ALLOW_ADMIN_CHANGES') === 'false')
    ->convertFilenamesToAscii(true)
    ->transformGifs(false) 
    ->enableTemplateCaching(false)
    ->backupCommand(fn(ShellCommand $command) => $command->addArg('--set-gtid-purged=OFF')) 
    ->aliases([
        '@webroot' => dirname(__DIR__) . '/web',
        '@assetBaseUrl' => rtrim(getenv('PRIMARY_SITE_URL') . '/assets'),
        '@assetBasePath' => rtrim(getenv('CRAFT_WEB_ROOT') . '/assets'),
        '@web' => getenv('PRIMARY_SITE_URL'),
    ])
;
