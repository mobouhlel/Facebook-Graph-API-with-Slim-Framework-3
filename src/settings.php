<?php
return [
    'settings' => [
        'displayErrorDetails'       => true, // set to false in production
        'addContentLengthHeader'    => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name'          => 'slim-app',
            'path'          => __DIR__ . '/../logs/app.log',
            'level'         => \Monolog\Logger::DEBUG,
        ],

        // Facebook Graph API settings
        'facebookGraphAPI' => [
            'appId'             => '238429736619554',
            'secretId'          => '1698e9541f3ebff802beb60d66e18630',
            'APIversion'        => 'v2.8',
            'getUserInfo'       => [
                'userFields'    => 'id,name,about,email,first_name,gender,last_name,middle_name,link,cover,picture'
            ]
        ],
    ],
];
