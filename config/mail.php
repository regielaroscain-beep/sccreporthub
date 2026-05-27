<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport'  => 'smtp',
            'host'       => env('MAIL_HOST', 'smtp.resend.com'),
            'port'       => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username'   => env('MAIL_USERNAME', 'resend'),
            'password'   => env('MAIL_PASSWORD'),
            'timeout'    => 15,
        ],
        'resend' => [
            'transport' => 'resend',
        ],
        'log' => [
            'transport' => 'log',
            'channel'   => env('MAIL_LOG_CHANNEL'),
        ],
        'array' => [
            'transport' => 'array',
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev'),
        'name'    => env('MAIL_FROM_NAME', 'SCC ReportHub'),
    ],
];
