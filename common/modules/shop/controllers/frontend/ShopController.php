<?php

namespace common\modules\shop\controllers\frontend;

use common\modules\shop\models\frontend\Product;
use common\modules\shop\models\frontend\search\ProductSearch;
use Yii;
use yii\web\Controller;

class ShopController extends Controller
{
    public function actionIndex()
    {
        $model = new Product();

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $relatedData = $model->getRelatedData();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'relatedData' => $relatedData,
        ]);
    }

}
