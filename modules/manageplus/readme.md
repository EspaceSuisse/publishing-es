# ManagePlus Authentication Module

This Craft CMS module provides external authentication through the ManagePlus API. Users authenticate with their ManagePlus credentials, and upon successful authentication, they are logged into a shared Craft CMS user account.

## Features

- External authentication via ManagePlus API
- Shared user login (all ManagePlus users log in as one Craft user)
- Optional logging of authentication attempts
- Remember Me functionality
- Configurable via environment variables
- Multilingual error messages (German and French)

## Installation

### Step 1: Install Module Files

The module files are already in place at `modules/manageplus/`.

### Step 2: Configure Composer Autoload

Add the following autoload configuration to your `composer.json` file (if not already present):

```json
"autoload": {
  "psr-4": {
    "modules\\": "modules/"
  }
}
```

This tells Composer/PHP where to find your custom module classes. Without this, the module won't load.

### Step 3: Regenerate Autoload Files

Run the following command to regenerate the Composer autoload files:

```bash
composer dump-autoload
```

### Step 4: Bootstrap Module in app.php

Add the following configuration to your `config/app.php` file (if not already present):

```php
use craft\helpers\App;

return [
    'modules' => [
        'manageplus' => [
            'class' => \modules\manageplus\Module::class,
            'apiEndpoint' => App::env('MANAGEPLUS_API_ENDPOINT') ?: '',
            'sharedUserEmail' => App::env('MANAGEPLUS_SHARED_USER_EMAIL') ?: '',
            'logUsage' => App::env('MANAGEPLUS_LOG_USAGE') ?: false,
        ],
    ],
    'bootstrap' => ['manageplus'],
];
```

This configuration:
- Registers the module with Craft CMS
- Ensures the module loads on every request (via `bootstrap`)
- Pulls configuration from environment variables

### Step 5: Create the Shared User

In the Craft CMS Control Panel:

1. Navigate to **Settings** → **Users**
2. Create a new user account (or use an existing one)
3. Set appropriate permissions for this shared account
4. Note the email address - you'll need it for configuration

> **Important**: All ManagePlus users will log in as this single Craft user, so set permissions accordingly.

### Step 6: Configure Environment Variables

Add the following variables to your `.env` file:

```bash
# ManagePlus API endpoint
MANAGEPLUS_API_ENDPOINT="https://mabernvlp.zetcom.app/ria-ws/application/module/definition"

# Email of the shared Craft user (created in Step 5)
MANAGEPLUS_SHARED_USER_EMAIL="member@example.com"

# Optional: Enable logging of authentication attempts
MANAGEPLUS_LOG_USAGE=true
```

### Step 7: Clear Caches

Clear Craft's caches to ensure the module is loaded:

```bash
php craft clear-caches/all
```

## Configuration

### Environment Variables

| Variable                       | Required | Description                                        |
| ------------------------------ | -------- | -------------------------------------------------- |
| `MANAGEPLUS_API_ENDPOINT`      | Yes      | Full URL to the ManagePlus API endpoint            |
| `MANAGEPLUS_SHARED_USER_EMAIL` | Yes      | Email address of the Craft user to log in          |
| `MANAGEPLUS_LOG_USAGE`         | No       | Set to `true` to enable logging (default: `false`) |

### Logging

When `MANAGEPLUS_LOG_USAGE` is enabled, authentication attempts are logged to:

- **File**: `storage/logs/manageplus.log`

## Usage

Users can log in at: `/member-login` or `/fr/member-login`

The login form requires:

- **Username**: ManagePlus username
- **Password**: ManagePlus password
- **Remember Me** (optional): Extends session duration

## Security Features

### Password Security

- Passwords are transmitted securely to the ManagePlus API
- Passwords are **never logged** or stored
- Only authentication results are recorded

## Testing

### Test the Configuration

1. Ensure the module is loaded:

   ```bash
   php craft
   ```

   No errors should appear related to ManagePlus.

2. Check the configuration:
   - API endpoint is reachable
   - Shared user exists in Craft
   - `.env` variables are set correctly

### Test Authentication

1. Navigate to `/member-login`
2. Enter valid ManagePlus credentials
3. Verify successful login and redirect
4. Check logs (if enabled) at `storage/logs/manageplus.log`

## Troubleshooting

### "Authentication module not configured"

**Cause**: Module failed to load or bootstrap.

**Solution**:

1. Run `composer dump-autoload`
2. Clear caches: `php craft clear-caches/all`
3. Check `config/app.php` includes the module configuration

### "Authentication system is not properly configured"

**Cause**: Missing or invalid environment variables.

**Solution**:

1. Check `.env` file contains all required variables
2. Verify `MANAGEPLUS_API_ENDPOINT` is a valid URL
3. Verify `MANAGEPLUS_SHARED_USER_EMAIL` is a valid email

### "Authentication configuration error"

**Cause**: Shared user doesn't exist in Craft.

**Solution**:

1. Log into Craft Control Panel
2. Navigate to Users
3. Create user with email matching `MANAGEPLUS_SHARED_USER_EMAIL`

### "Invalid username or password"

**Causes**:

- Incorrect ManagePlus credentials
- ManagePlus API is unreachable
- API endpoint URL is incorrect

**Solution**:

1. Verify credentials work on ManagePlus directly
2. Test API endpoint with curl:
   ```bash
   curl -u "username:password" "https://your-api-endpoint"
   ```
3. Check logs for detailed error messages

## Technical Details

### Authentication Flow

1. User submits login form
2. ManagePlus API authentication via HTTP Basic Auth
3. On success: Fetch shared Craft user by email
4. Log user into Craft with appropriate session duration
5. Redirect to home or return URL

### Translations

Error messages are automatically displayed in the site's language:

- **German (de-CH)**: `modules/manageplus/translations/de-CH/manageplus.php`
- **French (fr-CH)**: `modules/manageplus/translations/fr-CH/manageplus.php`

To add more languages, create a new translation file in the appropriate language folder.

### API Communication

- Uses Guzzle HTTP client (included in Craft CMS)
- HTTP Basic Authentication
- 10 second timeout
- Graceful error handling

### Session Duration

- **Without "Remember Me"**: Uses Craft's `userSessionDuration` setting
- **With "Remember Me"**: Uses Craft's `rememberedUserSessionDuration` setting

### Client-Side Cache Unlock (`hasAccess` cookie)

Blitz serves the same HTML to every visitor, so `Module::init()` sets a JS-readable `hasAccess=1` cookie while the user is logged in (refreshed every request, removed when the session ends). It's a UI hint only — Craft's session remains the authority.

A head-loaded script (`templates/_dynamic/unlockScript.twig`, included from `templates/_components/siteMeta.twig`) reads the cookie and strips `articleIsSunset` from `#protected-article` before first paint.

## Support

For issues or questions:

1. Check logs: `storage/logs/manageplus.log` (if logging enabled)
2. Check Craft logs: `storage/logs/web.log`
3. Enable logging temporarily to diagnose issues

## License

This module is custom-built for this Craft CMS installation.
