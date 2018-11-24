<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'bytom' => [
        'proto' => env('BYTOM_PROTO', 'http'),
        'host' => env('BYTOM_HOST', 'localhost'),
        'port' => env('BYTOM_PORT', '9888'),
        'token' => env('BYTOM_TOKEN', null),
    ],

    'label' => [
        'router' => [
            \App\Models\User::TYPE_VERIFIER => [
                [
                    'rule' => sprintf('write other'),
                    'labels' => [
                        \App\Constants\Labels::PERSONAL_ID_LABEL,
                        \App\Constants\Labels::FULLNAME_LABEL,
                        \App\Constants\Labels::PERSONAL_PHOTO_LABEL,
                    ],
                ],
            ],
            \App\Models\User::TYPE_GOVERNMENT => [
                [
                    'rule' => sprintf('write other verify %d', \App\Models\User::TYPE_VERIFIER),
                    'labels' => [
                        \App\Constants\Labels::TAXES_LABEL,
                        \App\Constants\Labels::OFFENCES_LABEL,
                        \App\Constants\Labels::CONVICTION_LABEL,
                        \App\Constants\Labels::TRAVEL_LABEL
                    ],
                ],
            ],
            \App\Models\User::TYPE_MEDICINE => [
                [
                    'rule' => sprintf('write other verify %d', \App\Models\User::TYPE_VERIFIER),
                    'labels' => [
                        \App\Constants\Labels::MEDICINE_LABEL,
                    ]
                ]
            ],
            \App\Models\User::TYPE_BUSINESS => [
                [
                    'rule' => sprintf('write other verify %d', \App\Models\User::TYPE_GOVERNMENT),
                    'labels' => [
                        \App\Constants\Labels::TAXES_LABEL,
                        \App\Constants\Labels::EMPLOYING_LABEL,
                        \App\Constants\Labels::TRAVEL_LABEL,
                    ],
                ],
            ],
            \App\Models\User::TYPE_DEFAULT => [
                [
                    'rule' => sprintf('write self verify %d', \App\Models\User::TYPE_GOVERNMENT),
                    'labels' => [
                        \App\Constants\Labels::FULLNAME_LABEL,
                        \App\Constants\Labels::PERSONAL_PHOTO_LABEL,
                    ],
                ],
            ],

        ]
    ]

];
