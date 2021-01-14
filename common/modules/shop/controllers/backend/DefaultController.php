<?php


namespace common\modules\shop\controllers\backend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $testVar = $this->module->countUploadFiles;
         return $this->render('index', [
            'testVar' => $testVar,
        ]);
    }
}