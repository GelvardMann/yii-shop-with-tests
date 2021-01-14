<?php

namespace common\modules\shop\models\frontend\query;

/**
 * This is the ActiveQuery class for [[\common\modules\shop\models\frontend\AttributeValue]].
 *
 * @see \common\modules\shop\models\frontend\AttributeValue
 */
class AttributeValueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\AttributeValue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\AttributeValue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
