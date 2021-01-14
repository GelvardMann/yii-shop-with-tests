<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                '<action:index|about|contact>' => 'site/<action>',
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'common\modules\user\Module',
            'controllerNamespace' => 'common\modules\user\controllers\frontend',
            'viewPath' => '@common/modules/user/views/frontend',
            'passwordResetTokenExpire' => 3600,
        ],
        'shop' => [
            'class' => 'common\modules\shop\Module',
            'controllerNamespace' => 'common\modules\shop\controllers\frontend',
            'viewPath' => '@common/modules/shop/views/frontend',
        ],
    ],
    'params' => $params,
];
