<?php
/*
|--------------------------------------------------------------------------
| SSO Configuration
|--------------------------------------------------------------------------
| Toggle providers on/off. When enabled, the login page shows SSO buttons.
| Fill in client_id / client_secret / tenant when ready to go live.
|
| Supported providers: microsoft, google
| To add a provider: add an entry below, then implement the OAuth flow
| in sso-callback.php (or use a library like league/oauth2-client).
|
*/

return [
    'providers' => [

        'microsoft' => [
            'enabled'       => true,
            'label'         => 'Microsoft',
            'icon'           => '&#xf17a;',  // placeholder – swap for SVG or icon font
            'client_id'     => getenv('SSO_MICROSOFT_CLIENT_ID')     ?: '',
            'client_secret' => getenv('SSO_MICROSOFT_CLIENT_SECRET') ?: '',
            'tenant'        => getenv('SSO_MICROSOFT_TENANT')        ?: 'common',
            'redirect_uri'  => getenv('SSO_MICROSOFT_REDIRECT')      ?: '/sso/microsoft/callback',
            'authority'     => 'https://login.microsoftonline.com',
            'scopes'        => ['openid', 'profile', 'email'],
        ],

        'google' => [
            'enabled'       => true,
            'label'         => 'Google',
            'icon'           => 'G',
            'client_id'     => getenv('SSO_GOOGLE_CLIENT_ID')     ?: '',
            'client_secret' => getenv('SSO_GOOGLE_CLIENT_SECRET') ?: '',
            'redirect_uri'  => getenv('SSO_GOOGLE_REDIRECT')      ?: '/sso/google/callback',
            'scopes'        => ['openid', 'email', 'profile'],
        ],

    ],
];
