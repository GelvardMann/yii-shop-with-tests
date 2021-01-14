<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\Module;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductTag[] $productTags
 * @property Product[] $products
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%tag}}';
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
            'name' => Module::t('module', 'NAME'),
        ];
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return ActiveQuery
     */
    public function getProductTags(): ActiveQuery
    {
        return $this->hasMany(ProductTag::class, ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('{{%product_tag}}', ['tag_id' => 'id']);
    }

    /**
     * Gets all related data.
     *
     * @return array
     */
    public function getRelatedData(): array
    {
        return $relatedData =
            [
                'tags' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
            ];
    }
}
