<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\Module;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property AttributeValue[] $attributeValues
 * @property Product[] $products
 */
class Attribute extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Module::t('module', 'ID'),
            'name' => Module::t('module', 'Name'),
        ];
    }

    /**
     * Gets query for [[AttributeValues]].
     *
     * @return ActiveQuery
     */
    public function getAttributeValues(): ActiveQuery
    {
        return $this->hasMany(AttributeValue::class, ['attribute_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('{{%attribute_value}}', ['attribute_id' => 'id']);
    }
}
