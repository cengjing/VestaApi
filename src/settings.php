<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Doctrine ORM
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    //'src/_build'
                    'src/Entity/OAuth'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'vesta',
                'user'     => 'vesta',
                'password' => 'swxE1vN8teXTXTgj',
            ]
        ]
    ],
];