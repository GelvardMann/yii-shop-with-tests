<?php

namespace common\modules\shop\models\frontend\query;

/**
 * This is the ActiveQuery class for [[\common\modules\shop\models\frontend\Image]].
 *
 * @see \common\modules\shop\models\frontend\Image
 */
class ImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\Image[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\Image|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
