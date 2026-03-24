<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'web-app',
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
        'user' => [
            'identityClass' => 'app\\models\\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'auth/auth/index',
                'auth' => 'auth/auth/index',
                'auth/index' => 'auth/auth/index',
                'auth/login' => 'auth/auth/login',
                'auth/logout' => 'auth/auth/logout',
                'student' => 'student/student/index',
                'student/index' => 'student/student/index',
            ],
        ],
    ],
    'modules' => [
        'auth' => [
            'class' => 'modules\\auth\\Module',
        ],
        'student' => [
            'class' => 'modules\\student\\Module',
        ],
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

