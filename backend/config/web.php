<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'APCAFS',
    'defaultRoute' => 'site/signin',
    'homeUrl' => ['dashboard/dashboard'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8ciBBAFitjuiRplsyInojAwMDPMWSj1g',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 15 * 60,
            'loginUrl' => ['site/signin'],
        ],
        'session' => [
            // this is the name of the session cookie used
            'class' => 'yii\web\Session',
            'name' => 'basic',
            'timeout' => 15 * 60, //this is for 15 minute
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'dsn' => 'smtps://hassanjemadari@gmail.com:poettelbcfshjarg@smtp.gmail.com:465', // Badilisha na nenosiri la programu kama unatumia 2FA
            ],
            'viewPath' => '@app/mail',
            'useFileTransport' => true, // Badilisha kuwa true kwa majaribio ya ndani bila kutuma barua pepe halisi
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                /**
                 * App url rules
                 */
                'company-setup' => 'site/setup-company',
                'site/verify-activation' => 'site/verify-activation',
                'dashboard' => 'dashboard/dashboard',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
