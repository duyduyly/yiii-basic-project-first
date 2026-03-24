<?php

$params = require __DIR__ . '/params.php';
$db = require dirname(__DIR__, 3) . '/config/test_db.php';

return [
    'id' => 'web-app-tests',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(__DIR__, 3) . '/vendor',
    'controllerNamespace' => 'app\\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@common' => dirname(__DIR__, 3) . '/common',
        '@modules' => dirname(__DIR__, 3) . '/modules',
    ],
    'components' => [
        'db' => $db,
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
            'messageClass' => 'yii\\symfonymailer\\Message',
        ],
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'app\\models\\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => $params,
];
