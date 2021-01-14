<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%attribute_value}}".
 *
 * @property int $product_id
 * @property int $attribute_id
 * @property string $value
 *
 * @property Attribute $attribute0
 * @property Product $product
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'value'], 'required'],
            [['product_id', 'attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['product_id', 'attribute_id'], 'unique', 'targetAttribute' => ['product_id', 'attribute_id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('module', 'Product ID'),
            'attribute_id' => Yii::t('module', 'Attribute ID'),
            'value' => Yii::t('module', 'Value'),
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\AttributeQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
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
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\AttributeValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\AttributeValueQuery(get_called_class());
    }
}
