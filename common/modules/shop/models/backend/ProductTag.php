<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\Module;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_tag}}".
 *
 * @property int $product_id
 * @property int $tag_id
 *
 * @property Product $product
 * @property Tag $tag
 */
class ProductTag extends ActiveRecord
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
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Module::t('module', 'PRODUCT_ID'),
            'tag_id' => Module::t('module', 'TAG_ID'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }

    /**
     * Gets all related data.
     *
     * @return array
     */
    public function getRelatedData()
    {
        return $relatedData =
            [
                'tags' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
            ];
    }
}
