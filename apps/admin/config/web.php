<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'admin-app',
    'name' => 'Admin',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(__DIR__, 3) . '/vendor',
    'controllerNamespace' => 'app\\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@common' => dirname(__DIR__, 3) . '/common',
        '@modules' => dirname(__DIR__, 3) . '/modules',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '1234567',
        ],
        'cache' => [
            'class' => 'yii\\caching\\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'auth/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\\log\\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

if (defined('YII_ENV_DEV') && YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\\debug\\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\\gii\\Module',
    ];
}

return $config;

