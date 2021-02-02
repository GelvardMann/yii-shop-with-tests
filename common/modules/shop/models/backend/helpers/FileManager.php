<?php

namespace common\modules\shop\models\backend\helpers;

use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\imagine\Image;

/**
 * Class FileManager
 * @package common\modules\shop\models\backend\helpers
 */
class FileManager extends FileHelper
{

    /**
     * @param array $images
     * @param string $path
     * @return array
     * @throws Exception
     */
    public function uploadFiles(array $images, string $path): array
    {
        $names = array();
        $uploadPath = $this->normalizePath($path);

        if ($this->createDirectory($uploadPath)) {
            foreach ($images as $image) {
                $name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $image->extension;
                $image->saveAs($uploadPath . '/' . $name);
                $names[] = $name;
                $this->createDirectory($uploadPath . '/thumbnail/');
                Image::thumbnail($uploadPath . '/' . $name, 150, 150)
                    ->save($uploadPath . '/thumbnail/' . $name);

            }
        }

        return $names;
    }


    /**
     * @param $path
     * @param $name
     * @throws ErrorException
     */
    public function deleteFile($name, $path)
    {
        if (!is_array($name)) {
            $name = array($name);
        }

        foreach ($name as $item) {
            $file = $path . $item;
            $thumbnailFile = $path . '/thumbnail/' . $item;
            if (file_exists($thumbnailFile)) {
                $this->unlink($thumbnailFile);
                if (empty($dir = glob($path . '/thumbnail/*.*'))) {
                    $this->removeDirectory($path);
                }
            }
            if (file_exists($file)) {
                $this->unlink($file);
                if (empty($dir = glob($path . '/*.*'))) {
                    $this->removeDirectory($path);
                }
            }
        }

    }
}