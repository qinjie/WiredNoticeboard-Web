<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'name' => 'Wired Noticeboard',
    'timeZone' => 'Asia/Singapore',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'   // v1 module
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'common\components\PhpManager',
            'defaultRoles' => ['user', 'admin'],
        ],
        'request' => [
            // Enable JSON Input
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'MXtBcX_ZOCJVA4g9MOz6JoHtUvNFgkv8',
        ],
        'response' => [
            'format' => 'json',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@app/runtime/logs/api-error.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@app/runtime/logs/api-warning.log'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            // Add URL Rules for API
            'rules' => [
                # API for ActiveRecords
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false,
                    'controller' => 'v1/device',
                    'tokens' => [
                        # Keep 'id' for default CRUD action
                        '{id}' => '<id:\\w+>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false,
                    'controller' => 'v1/device-media',
                ],
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false,
                    'controller' => 'v1/media-file',
                ],
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false,
                    'controller' => 'v1/node',
                    'extraPatterns' => [
                        'POST enroll' => 'enroll',
                        'POST playlist' => 'playlist',
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

    ],
    'params' => $params,
];