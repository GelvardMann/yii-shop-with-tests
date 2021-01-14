<?php

namespace common\modules\shop\models\backend\helpers;

use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\FileHelper;

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
            if (file_exists($file)) {
                $this->unlink($file);
            }
        }
    }
//
//    /**
//     * @param $path
//     */
//    private function makeDir($path)
//    {
//        if (!file_exists($path)) {
//            mkdir($path);
//        }
//    }
//
//    /**
//     * @param int $path
//     */
//    private function removeDir($path)
//    {
//        $files = glob($path . "*");
//        if (empty($files)) {
//            rmdir($path);
//        }
//    }
}