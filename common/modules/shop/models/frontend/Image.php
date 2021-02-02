<?php

namespace common\modules\shop\models\frontend;

use common\modules\shop\models\frontend\query\ImageQuery;
use common\modules\shop\models\frontend\query\ProductQuery;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 *
 * @property Product $product
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['product_id', 'name'], 'required'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('module', 'ID'),
            'product_id' => Yii::t('module', 'Product ID'),
            'name' => Yii::t('module', 'Name'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImageQuery the active query used by this AR class.
     */
    public static function find(): ImageQuery
    {
        return new ImageQuery(get_called_class());
    }

    public function getMainImage(array $images): array
    {
        $mainImage = array();

        if (!empty($images)) {
            foreach($images as $image) {
                $mainImage['name'] = $image->name;
                $mainImage['pid'] = $image->product_id;
            }
        }

        return $mainImage;
    }
}
