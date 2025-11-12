<?php

return [

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'pasien',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'pasien',
        ],

        'bidan' => [
            'driver' => 'jwt',
            'provider' => 'bidan',
        ],

        'pasien' => [
            'driver' => 'jwt',
            'provider' => 'pasien',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'bidan' => [
            'driver' => 'eloquent',
            'model' => App\Models\Bidan::class,
        ],

        'pasien' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pasien::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pasien' => [
            'provider' => 'pasien',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
