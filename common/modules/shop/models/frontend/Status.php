<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%status}}".
 *
 * @property int $id
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Product[] $products
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('module', 'ID'),
            'status' => Yii::t('module', 'Status'),
            'created_at' => Yii::t('module', 'Created At'),
            'updated_at' => Yii::t('module', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['status_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\StatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\StatusQuery(get_called_class());
    }
}
