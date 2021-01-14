<?php

namespace common\modules\user;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {

        $this->registerTranslations($app);
        $this->registerUrlManager($app);

    }

    public function registerTranslations(Application $app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@common/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php',
            ],
        ];
    }

    public function registerUrlManager(Application $app)
    {
        $app->getUrlManager()->addRules(
            [
                '<module:user>/<action:login|logout|signup|request-password-reset|reset-password|verify-email|resend-verification-email>' => '<module>/default/<action>',
                '<module:user>/<action:index|create>' => '<module>/profiles/<action>',
            ]
        );
    }
}
