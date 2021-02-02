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
    public function active(): ProductQuery
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {}
     * @param $id
     * @return ProductQuery
     */
    public function forCategory($id): ProductQuery|self
    {
        return $this->andWhere(['category' => $id]);
    }

    /**
     * {@inheritdoc}
     * @return Product[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Product|array|null
     */
    public function one($db = null): Product|array|null
    {
        return parent::one($db);
    }
}
