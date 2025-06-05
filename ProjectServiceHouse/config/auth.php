<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [       // هون انا بحط كلشي حراس بدي ياهن 
        'web' => [      // هون عندي هاد الافتراضي بيجي من لارفيل 
            'driver' => 'session',     // هون طريقة يلي بدي ياها عن الجلسة (تسجيل جلسة )
            'provider' => 'users',     // هون عملت تزويد هي بأسم اليوسر 
        ],

        // حارس مخصص للأدمن
        'admin' => [        // هون ساويت حارس ادمن
            'driver' => 'session',   // كمان نفس يلي فوق طريقة التحقق الجلسة 
            'provider' => 'admins',    // سميتو اسم الادمنز
        ],

        // حارس مخصص للعميل
        'Client' => [
            'driver' => 'session',
            'provider' => 'Clients',
        ],

        // حارس مخصص مقدم
        'Supplier' => [
            'driver' => 'session',
            'provider' => 'Suppliers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // مزود مخصص للأدمن
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // مزود مخصص للعميل
        'Clients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Client::class,
        ],

        // مزود مخصص مقدم 
        'Suppliers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Supplier::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];