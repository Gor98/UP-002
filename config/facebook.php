<?php

return [
    'urls' => [
        'oauth2' => [
            'url' => 'https://www.facebook.com/v11.0/dialog/oauth',
            'token' => 'https://graph.facebook.com/v11.0/oauth/access_token',
        ],
        'data' => [
            'userinfo' => 'https://graph.facebook.com/me?fields=email,first_name,last_name,id&access_token=:access_token'
        ]
    ],
    'params' => [
        'response_type' => 'code',
        'client_id' => env('FACEBOOK_CLIENT_ID', '802018260499384'),
        'secret' => env('FACEBOOK_CLIENT_SECRET', 'a7b958d55f7b8529ebf9650d6f9f95bc'),
        'redirect_uri' => env('OAUTH_REDIRECT_URL', 'https://localhost:8081/api/oauth2/token'),
        'scope' => 'email',
        "state" => ':state'
    ]
];
