<?php

return [
    'urls' => [
        'oauth2' => [
            'url' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'token' => 'https://accounts.google.com/o/oauth2/token',
        ],
        'data' => [
            'userinfo' => 'https://www.googleapis.com/oauth2/v2/userinfo'
        ]
    ],
    'params' => [
        'response_type' => 'code',
        'grant_type' => 'authorization_code',
        'client_id' => env('GOOGLE_CLIENT_ID', '56264048517-i23hvgbsctoknp42sbmcb33ls1220pbq.apps.googleusercontent.com'),
        'secret' => env('GOOGLE_CLIENT_SECRET', '4on8EA3NZELFi6zkx6ArOMkL'),
        //TODO will be changed when front will be ready (we will pass front handled url)
        'redirect_uri' => env('OAUTH_REDIRECT_URL', 'http://localhost:8081/api/oauth2/token'),
        'scope' => 'openid%20profile%20email',
        "state" => ':state'
    ]
];
