<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\Module;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
     * @var mixed|null
     * */
    public $file;
    /**
     * @var integer
     */
    private int $countUploadFiles = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code', 'category_id', 'new', 'sale', 'active', 'status_id', 'percent', 'price', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'alias', 'category_id', 'status_id'], 'required'],
            [['name', 'description', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => $this->countUploadFiles],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Module::t('module', 'ID'),
            'code' => Module::t('module', 'CODE'),
            'name' => Module::t('module', 'NAME'),
            'description' => Module::t('module', 'DESCRIPTION'),
            'alias' => Module::t('module', 'ALIAS'),
            'category_id' => Module::t('module', 'CATEGORY_ID'),
            'new' => Module::t('module', 'NEW'),
            'sale' => Module::t('module', 'SALE'),
            'active' => Module::t('module', 'ACTIVE'),
            'status_id' => Module::t('module', 'STATUS_ID'),
            'percent' => Module::t('module', 'PERCENT'),
            'price' => Module::t('module', 'PRICE'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'file' => Module::t('module', 'IMAGES'),
        ];
    }

    /**
     * Gets query for [[AttributeValues]].
     *
     * @return ActiveQuery
     */
    public function getAttributeValues(): ActiveQuery
    {
        return $this->hasMany(AttributeValue::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Attributes]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getProductAttributes(): ActiveQuery
    {
        return $this->hasMany(Attribute::class, ['id' => 'attribute_id'])->viaTable('{{%attribute_value}}', ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return ActiveQuery
     */
    public function getImages(): ActiveQuery
    {
        return $this->hasMany(Image::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return ActiveQuery
     */
    public function getProductTags(): ActiveQuery
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('{{%product_tag}}', ['product_id' => 'id']);
    }

    /**
     *
     * @param array $images
     * @return array
     */
    public function getPathImages(array $images): array
    {
        $path = array();
        foreach ($images as $image) {
            $path['url'][] = Yii::$app->urlManager->createUrl('/uploads/images/shop/' . $image->product_id . '/' . $image->name);
            $path['config'][] = [
                'caption' => $image->name,
                'key' => $image->id,
            ];
        }

        return $path;
    }

    /**
     * Gets list for relations models
     *
     * @return array
     */
    public function getRelatedData(): array
    {
        $categories = (new Category())->getRelatedData();

        return $relatedData = [
            'tags' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
            'statuses' => Status::find()->select(['status', 'id'])->indexBy('id')->column(),
            'categories' => $categories,
        ];
    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//        $image = new Image();
//        if ($files = UploadedFile::getInstances($this, 'file') and $this->validate('files')) {
//            if ($oldImages = $this->getImages()) {
//                $image = new Image();
//                $image->uploadImages($files, $this->id, $oldImages);
//            }
//
//            $image->uploadImages($files, $this->id);
//        }
//    }
}
