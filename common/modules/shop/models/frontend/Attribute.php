<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property AttributeValue[] $attributeValues
 * @property Product[] $products
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute}}';
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
     * Gets query for [[AttributeValues]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\AttributeValueQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['attribute_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%attribute_value}}', ['attribute_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\AttributeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\AttributeQuery(get_called_class());
    }
}
