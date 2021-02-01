<?php

namespace common\modules\shop\models\backend;

use common\modules\shop\models\backend\helpers\FileManager;
use common\modules\shop\Module;
use JetBrains\PhpStorm\ArrayShape;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;


/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $sort_id
 * @property string $name
 *
 * @property Product $product
 */
class Image extends ActiveRecord
{
    /**
     * @var mixed
     * */
    public $file;

    private int $countUploadFiles;

    public function __construct($config = [])
    {
        $this->countUploadFiles = Module::getInstance()->countUploadFiles;

        parent::__construct($config);
    }

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
            [['product_id', 'sort_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => $this->countUploadFiles],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Module::t('module', 'ID'),
            'product_id' => Module::t('module', 'PRODUCT_ID'),
            'name' => Module::t('module', 'NAME'),
            'file' => Module::t('module', 'IMAGES'),
        ];
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
     * @param array $files
     * @param integer $product_id
     * @return bool
     * @throws Exception
     */
    public function uploadImages(array $files, int $product_id): bool
    {
        $path = Module::getAlias('@uploads/images/shop/' . $product_id . '/');
        $fileManager = new FileManager();
        $namesImages = $fileManager->uploadFiles($files, $path);
        $sort_id = 0;
        if ($namesImages) {
            foreach ($namesImages as $name) {
                $model = new Image();
                $model->product_id = $product_id;
                $model->name = $name;
                $model->sort_id = $sort_id;
                $sort_id++;
                $model->save();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $images
     * @param $product_id
     * @throws
     */
    public
    function deleteImages($images, $product_id)
    {
        if ($images) {
            $names = array();
            foreach ($images as $image) {
                $names[] = $image->name;
            }
            $model = Image::find()->where(['product_id' => $product_id])->all();
            $fileManager = new FileManager();
            $path = Module::getAlias('@uploads/images/shop/' . $product_id . '/');
            $fileManager->deleteFile($names, $path);
            foreach ($model as $item) {
                $item->delete();
            }
        } else {
            throw new NotFoundHttpException(Module::t('module', 'SOMETHING_WRONG'));
        }
    }
}
