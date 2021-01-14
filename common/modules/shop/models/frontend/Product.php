<?php

namespace common\modules\shop\models\frontend;

use common\modules\shop\models\backend\Attribute;
use common\modules\shop\models\backend\AttributeValue;
use common\modules\shop\models\backend\Category;
use common\modules\shop\models\backend\Image;
use common\modules\shop\models\backend\ProductTag;
use common\modules\shop\models\backend\Status;
use common\modules\shop\models\backend\Tag;
use common\modules\shop\models\frontend\query\AttributeQuery;
use common\modules\shop\models\frontend\query\AttributeValueQuery;
use common\modules\shop\models\frontend\query\CategoryQuery;
use common\modules\shop\models\frontend\query\ImageQuery;
use common\modules\shop\models\frontend\query\ProductQuery;
use common\modules\shop\models\frontend\query\ProductTagQuery;
use common\modules\shop\models\frontend\query\StatusQuery;
use common\modules\shop\models\frontend\query\TagQuery;
use common\modules\shop\Module;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int|null $code
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property int $category_id
 * @property int|null $new
 * @property int|null $sale
 * @property int|null $active
 * @property int $status_id
 * @property int|null $percent
 * @property int|null $price
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AttributeValue[] $attributeValues
 * @property Attribute[] $attributes0
 * @property Image[] $images
 * @property Category $category
 * @property Status $status
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'category_id', 'new', 'sale', 'active', 'status_id', 'percent', 'price', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'alias', 'category_id', 'status_id', 'created_at', 'updated_at'], 'required'],
            [['name', 'description', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'code' => Module::t('module', 'Code'),
            'name' => Module::t('module', 'Name'),
            'description' => Module::t('module', 'Description'),
            'alias' => Module::t('module', 'Alias'),
            'category_id' => Module::t('module', 'Category ID'),
            'new' => Module::t('module', 'New'),
            'sale' => Module::t('module', 'Sale'),
            'active' => Module::t('module', 'Active'),
            'status_id' => Module::t('module', 'Status ID'),
            'percent' => Module::t('module', 'Percent'),
            'price' => Module::t('module', 'Price'),
            'created_at' => Module::t('module', 'Created At'),
            'updated_at' => Module::t('module', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[AttributeValues]].
     *
     * @return ActiveQuery|AttributeValueQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Attributes]].
     *
     * @return ActiveQuery|AttributeQuery
     * @throws InvalidConfigException
     */
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::class, ['id' => 'attribute_id'])->viaTable('{{%attribute_value}}', ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return ActiveQuery|ImageQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return ActiveQuery|StatusQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return ActiveQuery|ProductTagQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return ActiveQuery|TagQuery
     * @throws InvalidConfigException
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('{{%product_tag}}', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * Gets list for relations models
     *
     * @return array
     */
    public function getRelatedData()
    {
        $categories = (new Category())->getRelatedData();

        return $relatedData = [
            'tags' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
            'statuses' => Status::find()->select(['status', 'id'])->indexBy('id')->column(),
            'categories' => $categories,
        ];
    }
}
