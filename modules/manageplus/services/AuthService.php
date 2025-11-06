<?php

namespace modules\manageplus\services;

use Craft;
use craft\base\Component;
use GuzzleHttp\Exception\GuzzleException;
use modules\manageplus\Module;

/**
 * ManagePlus Authentication Service
 */
class AuthService extends Component
{
    /**
     * Authenticate user with ManagePlus API
     *
     * @param string $username
     * @param string $password
     * @return bool True if authentication successful, false otherwise
     */
    public function authenticateWithManagePlus(string $username, string $password): bool
    {
        /** @var Module $module */
        $module = Craft::$app->getModule('manageplus');

        if (!$module) {
            $this->log($username, false, 'Module not loaded');
            return false;
        }

        $apiEndpoint = $module->apiEndpoint;

        if (empty($apiEndpoint)) {
            $this->log($username, false, 'API endpoint not configured');
            return false;
        }

        try {
            // Create Guzzle client
            $client = Craft::createGuzzleClient([
                'timeout' => 10,
                'verify' => true,
            ]);

            // Make request with Basic Auth
            $response = $client->request('GET', $apiEndpoint, [
                'auth' => [$username, $password],
                'http_errors' => false, // Don't throw exceptions on 4xx/5xx
            ]);

            $statusCode = $response->getStatusCode();
            $success = $statusCode >= 200 && $statusCode < 300;

            // Log the attempt
            $this->log($username, $success, "HTTP {$statusCode}");

            return $success;
        } catch (GuzzleException $e) {
            $this->log($username, false, 'API error: ' . $e->getMessage());
            Craft::error('ManagePlus API error: ' . $e->getMessage(), 'manageplus');
            return false;
        }
    }

    /**
     * Log authentication attempt
     *
     * @param string $username
     * @param bool $success
     * @param string $details
     */
    private function log(string $username, bool $success, string $details = ''): void
    {
        /** @var Module $module */
        $module = Craft::$app->getModule('manageplus');

        if (!$module || !$module->logUsage) {
            return;
        }

        $ip = Craft::$app->getRequest()->getUserIP();
        $result = $success ? 'SUCCESS' : 'FAILURE';

        $logMessage = sprintf(
            'IP: %s | Username: %s | Result: %s | Details: %s',
            $ip,
            $username,
            $result,
            $details
        );

        Craft::info($logMessage, 'manageplus');
    }
}
