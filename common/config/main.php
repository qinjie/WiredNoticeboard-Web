<?php
return [
    'name' => 'Wired Noticeboard',
    'timeZone' => 'Asia/Singapore',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

    ],
];
