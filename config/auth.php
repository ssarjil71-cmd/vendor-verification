<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    // 🔐 Authentication Guards
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'company' => [
            'driver' => 'session',
            'provider' => 'companies',
        ],

        'vendor' => [
            'driver' => 'session',
            'provider' => 'vendors',
        ],
    ],

    // 👤 User Providers
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'companies' => [
            'driver' => 'eloquent',
            'model' => App\Models\Company::class,
        ],

        'vendors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendor::class,
        ],
    ],

    // 🔁 Password Reset Settings
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'companies' => [
            'provider' => 'companies',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'vendors' => [
            'provider' => 'vendors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
