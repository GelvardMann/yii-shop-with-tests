<?php


namespace common\modules\shop\controllers\backend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex(): string
    {
         return $this->render('index', [
        ]);
    }
}