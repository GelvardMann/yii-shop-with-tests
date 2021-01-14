<?php

namespace common\modules\shop\models\backend\helpers;

use yii\helpers\ArrayHelper;

/**
 * Class TreeHelper
 * @package common\modules\shop\models\backend\helpers
 */
class TreeHelper
{

    /**
     * @param array $array
     * @return array
     */
    private static function prepareData(array $array)
    {

        ArrayHelper::multisort($array, 'parent_id');

        return $data = ArrayHelper::index($array, 'id');
    }

    /**
     * @param array $array
     * @return array
     */

    public static function makeTree(array $array)
    {
        $data = self::prepareData($array);

        return self::buildTree($data);
    }

    /**
     * @param array $array
     * @return array
     */

    public static function makeList(array $array)
    {
        $data = self::buildTree(self::prepareData($array));

        return self::buildList($data);
    }


    /**
     * @param array $array
     * @param null $parentId
     * @return array
     */
    private static function buildTree(array $array, $parentId = null)
    {
        $tree = array();

        foreach ($array as $item) {
            if ($item['parent_id'] == $parentId) {
                $tree[$item['id']] = $item;
                $tree[$item['id']]['node'] = self::buildTree($array, $item['id']);
            }
        }

        return $tree;
    }


    /**
     * @param array $array
     * @param string $level
     * @return array
     */
    private static function buildList(array $array, $level = '-')
    {
        $list = array();
        foreach ($array as $item) {
            $list[$item['id']] = $level . $item['name'];

            if ($item['node']) {
                $level .= '-';
                $sub = self::buildList($item['node'], $level);
//                $list = array_merge($list, $sub);
                $list += $sub;
                $level = mb_substr($level, 1);
            }
        }

        return $list;
    }
}

