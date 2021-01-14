<?php

namespace common\modules\shop;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Application;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {

        $this->registerTranslations($app);
        $this->registerUrlManager($app);
        $this->registerFormatter($app);
        Yii::setAlias('@uploads', dirname(dirname(dirname(__DIR__))) . '/frontend/web/uploads');

    }

    public function registerTranslations(Application $app)
    {
        $app->i18n->translations['modules/shop/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@common/modules/shop/messages',
            'fileMap' => [
                'modules/shop/module' => 'module.php',
            ],
        ];
    }

    public function registerUrlManager(Application $app)
    {
        $app->getUrlManager()->addRules(
            [
                '<_m:shop>/<controller:category>/<action:view|update|delete>/<id:\d+>' => '<_m>/category/<action>',
                '<_m:shop>/<controller:category>/<action:create>/' => '<_m>/category/<action>',

                'shop/category/<category:[\w_\/-]+>/<id:[\d]+>' => 'shop/default/show',
                'shop/category/<category:[\w_\/-]+>' => 'shop/default/category',

                'shop' => 'shop/shop/index',
                'shop/<controller:(product|category|status|image|attribute-value|attribute|product-tag|tag)>' => 'shop/<controller>/index',
                'shop/<controller:(product|category|options)>/<action:create|view|update|delete>/<id:\d+>' => 'shop/<controller>/<action>',

            ]
        );
    }

    public function registerFormatter(Application $app)
    {

        $app->getFormatter()->booleanFormat = [
            '<span class="label label-danger">&cross;</span>',
            '<span class="label label-success">&check;</span>',
        ];
    }

}
