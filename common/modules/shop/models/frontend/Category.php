<?php

namespace common\modules\shop\models\frontend;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property int|null $parent_id
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'alias' => Yii::t('module', 'Alias'),
            'parent_id' => Yii::t('module', 'Parent ID'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\CategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\CategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\shop\models\frontend\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\shop\models\frontend\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\shop\models\frontend\query\CategoryQuery(get_called_class());
    }
}
