<?php

return [
    'name' => 'Admin',
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admins',
            ],
        ],
        'providers' => [
            'admins' => [
                'driver' => 'eloquent',
                'model' => \Modules\Admin\Entities\AdminUser::class,
            ],
        ],
        'passwords' => [
            'admins' => [
                'provider' => 'admins',
                'table' => 'password_resets',
                'expire' => 60,
                'throttle' => 60,
            ],
        ],
    ],
];
