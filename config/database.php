<?php

return [
    
    'fetch' => PDO::FETCH_CLASS,
    'unix_socket' => '/tmp/mysql.sock',
    'default' => env('DB_CONNECTION', 'api'),
    'connections' => [
        
        'api' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'db'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'api'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', '%(&Mb0,B4v296WN'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        
        'gateway' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'db'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_GATEWAY', 'gateway'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', '%(&Mb0,B4v296WN'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        
        'region' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'db'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_REGION', 'region'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', '%(&Mb0,B4v296WN'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        
        'vehicle' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'db'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_VEHICLE', 'vehicle'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', '%(&Mb0,B4v296WN'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
    ],
];
