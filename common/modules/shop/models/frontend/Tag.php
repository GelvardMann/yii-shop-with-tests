<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductTag[] $productTags
 * @property Product[] $products
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('module', 'ID'),
            'name' => Yii::t('module', 'Name'),
        ];
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductTagQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_tag}}', ['tag_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\TagQuery(get_called_class());
    }
}
