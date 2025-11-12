<?php

namespace modules\manageplus\controllers;

use Craft;
use craft\elements\User;
use craft\web\Controller;
use modules\manageplus\Module;
use yii\web\Response;

/**
 * ManagePlus Login Controller
 */
class LoginController extends Controller
{
    /**
     * @inheritdoc
     */
    protected array|bool|int $allowAnonymous = ['index'];

    /**
     * Handle login form submission
     *
     * @return Response
     */
    public function actionIndex(): Response
    {
        $this->requirePostRequest();

        $username = Craft::$app->getRequest()->getBodyParam('username');
        $password = Craft::$app->getRequest()->getBodyParam('password');
        $rememberMe = (bool)Craft::$app->getRequest()->getBodyParam('rememberMe');
        $language = Craft::$app->getRequest()->getBodyParam('language') ?? Craft::$app->language;

        // Validate input
        if (empty($username) || empty($password)) {
            return $this->handleFailure(Craft::t('manageplus', 'Username and password are required.', [], $language));
        }

        /** @var Module $module */
        $module = Craft::$app->getModule('manageplus');

        if (!$module) {
            return $this->handleFailure(Craft::t('manageplus', 'Authentication module not configured.', [], $language));
        }

        // Validate module settings
        $settingsErrors = $module->validateSettings();
        if (!empty($settingsErrors)) {
            Craft::error('ManagePlus module configuration errors: ' . implode(', ', $settingsErrors), 'manageplus');
            return $this->handleFailure(Craft::t('manageplus', 'The authentication system is not properly configured. Please contact the administrator.', [], $language));
        }

        // Authenticate with ManagePlus API
        if (!$module->auth->authenticateWithManagePlus($username, $password)) {
            return $this->handleFailure(Craft::t('manageplus', 'Invalid username or password.', [], $language));
        }

        // Get the shared Craft user
        $user = User::find()->email($module->sharedUserEmail)->one();

        if (!$user) {
            Craft::error('Shared user not found: ' . $module->sharedUserEmail, 'manageplus');
            return $this->handleFailure(Craft::t('manageplus', 'Authentication configuration error. Please contact the administrator.', [], $language));
        }

        // Determine session duration based on rememberMe
        $duration = $rememberMe
            ? Craft::$app->getConfig()->getGeneral()->rememberedUserSessionDuration
            : Craft::$app->getConfig()->getGeneral()->userSessionDuration;

        // Log the user in
        if (!Craft::$app->getUser()->login($user, $duration)) {
            return $this->handleFailure(Craft::t('manageplus', 'Login failed. Please try again.', [], $language));
        }

        // Success! Redirect to home or return URL
        $returnUrl = Craft::$app->getRequest()->getBodyParam('redirect') ?: Craft::$app->getConfig()->getGeneral()->getPostLoginRedirect();

        return $this->redirect($returnUrl);
    }

    /**
     * Handle login failure
     *
     * @param string $message
     * @return Response
     */
    private function handleFailure(string $message): Response
    {
        Craft::$app->getSession()->setError($message);

        // Return to the referrer (login page) to maintain language context
        $referrer = Craft::$app->getRequest()->getReferrer();
        if ($referrer) {
            return $this->redirect($referrer);
        }

        // Fallback: redirect to member-login in current site
        return $this->redirect('member-login');
    }
}
