<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\Module;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class AttributeValue extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    public function attributeLabels(): array
    {
        return [
            'product_id' => Module::t('module', 'PRODUCT_ID'),
            'attribute_id' => Module::t('module', 'ATTRIBUTE_ID'),
            'value' => Module::t('module', 'VALUE'),
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return ActiveQuery
     */
    public function getProductAttributes(): ActiveQuery
    {
        return $this->hasOne(Attribute::class, ['id' => 'attribute_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }


    /**
     * Gets list for relations models
     *
     * @return array
     */
    public function getRelatedData(): array
    {
        return $relatedData = [
            'attributes' => Attribute::find()->select(['name', 'id'])->indexBy('id')->column(),
        ];
    }
}
