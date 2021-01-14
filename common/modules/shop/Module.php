<?php

namespace common\modules\shop;

use Yii;

/**
 * shop module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\shop\controllers';

    /**
     * @var int
     */
    public $countUploadFiles = 7;

    /**
     * {}
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/shop/' . $category, $message, $params, $language);
    }

    /**
     * {}
     * @param $alias
     * @return string
     */
    public static function getAlias($alias)
    {
        return Yii::getAlias($alias);
    }
}
