<?php
return [
    'id' => 'app-common-tests',
    'language' => 'en-En',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\modules\user\models\User',
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'rules' => [
                '/' => 'site/index',
                '<action:index|about|contact|signup|login|logout>' => 'site/<action>',
            ],
        ],
    ],
];
