<?php

namespace common\modules\shop\models\frontend\query;

use common\modules\shop\models\frontend\Product;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\modules\shop\models\frontend\Product]].
 *
 * @see \common\modules\shop\models\frontend\Product
 */
class ProductQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
