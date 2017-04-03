<?php
return [
    'name' => 'Wired Noticeboard',
    'timeZone' => 'Asia/Singapore',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=wired_noticeboard',
            'username' => 'root',
            'password' => 'abcd1234',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'eceiot.np@gmail.com',
                'password' => 'Soe7014Ece',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
