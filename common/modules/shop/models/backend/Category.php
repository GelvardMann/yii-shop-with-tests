<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\models\backend\helpers\TreeHelper;
use common\modules\shop\Module;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property-read array $relatedData
 * @property Product[] $products
 */
class Category extends ActiveRecord
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
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'name' => Module::t('module', 'NAME'),
            'alias' => Module::t('module', 'ALIAS'),
            'parent_id' => Module::t('module', 'PARENT_ID'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    /**
     * Gets all categories.
     *
     * @return array
     */
    public function getRelatedData()
    {

        $categories = self::find()->asArray()->all();

        return $relatedData = TreeHelper::makeList($categories);
    }
}
