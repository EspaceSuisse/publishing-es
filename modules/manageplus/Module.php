<?php

namespace modules\manageplus;

use Craft;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use modules\manageplus\services\AuthService;
use yii\base\Event;
use yii\base\Module as BaseModule;

/**
 * ManagePlus Authentication Module
 *
 * @property AuthService $auth
 */
class Module extends BaseModule
{
    /**
     * @var string API endpoint for ManagePlus
     */
    public string $apiEndpoint = '';

    /**
     * @var string Email of the shared Craft user to log in
     */
    public string $sharedUserEmail = '';

    /**
     * @var bool Whether to log authentication attempts
     */
    public bool $logUsage = false;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        Craft::setAlias('@modules/manageplus', $this->getBasePath());
        $this->controllerNamespace = 'modules\manageplus\controllers';

        parent::init();

        // Register translation category
        Craft::$app->i18n->translations['manageplus'] = [
            'class' => \craft\i18n\PhpMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => '@modules/manageplus/translations',
            'allowOverrides' => true,
        ];

        // Register services
        $this->setComponents([
            'auth' => AuthService::class,
        ]);

        // Register site URL rules
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['manageplus/login'] = 'manageplus/login/index';
            }
        );

        // Configure logging target for ManagePlus
        if ($this->logUsage) {
            $logger = Craft::getLogger();
            $fileTarget = new \yii\log\FileTarget([
                'logFile' => Craft::getAlias('@storage/logs/manageplus.log'),
                'categories' => ['manageplus'],
                'logVars' => [],
                'exportInterval' => 1,
                'prefix' => function ($message) {
                    return '';
                },
            ]);
            $logger->dispatcher->targets['manageplus'] = $fileTarget;
        }

        // Sync `hasAccess` cookie for cache-safe client-side article unlock.
        // The cookie is a non-httpOnly UI hint, not an auth token — the Craft
        // session remains the authority for actual access control.
        $request = Craft::$app->getRequest();
        if (!$request->getIsConsoleRequest()) {
            $user = Craft::$app->getUser();
            $cookies = Craft::$app->getResponse()->getCookies();

            if ($user->getIdentity()) {
                $authTimeout = $user->authTimeout;
                $expire = $authTimeout ? time() + $authTimeout : 0;

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'hasAccess',
                    'value' => '1',
                    'expire' => $expire,
                    'path' => '/',
                    'httpOnly' => false,
                    'secure' => $request->getIsSecureConnection(),
                    'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
                ]));
            } else {
                $cookies->remove('hasAccess');
            }
        }
    }

    /**
     * Validates module settings
     */
    public function validateSettings(): array
    {
        $errors = [];

        if (empty($this->apiEndpoint)) {
            $errors[] = 'API Endpoint is required.';
        } elseif (!filter_var($this->apiEndpoint, FILTER_VALIDATE_URL)) {
            $errors[] = 'API Endpoint must be a valid URL.';
        }

        if (empty($this->sharedUserEmail)) {
            $errors[] = 'Shared User Email is required.';
        } elseif (!filter_var($this->sharedUserEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Shared User Email must be a valid email address.';
        }

        return $errors;
    }
}
