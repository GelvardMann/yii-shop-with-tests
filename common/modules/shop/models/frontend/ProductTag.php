<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%product_tag}}".
 *
 * @property int $product_id
 * @property int $tag_id
 *
 * @property Product $product
 * @property Tag $tag
 */
class ProductTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'tag_id'], 'required'],
            [['product_id', 'tag_id'], 'integer'],
            [['product_id', 'tag_id'], 'unique', 'targetAttribute' => ['product_id', 'tag_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('module', 'Product ID'),
            'tag_id' => Yii::t('module', 'Tag ID'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\TagQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\ProductTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\ProductTagQuery(get_called_class());
    }
}
