<?php

use common\modules\shop\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'IMAGES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model) {
                    return Url::to(['/shop/image/' . $action,
                        'id' => $model->id,
                        'product_id' => $model->product_id

                    ]);
                }

            ],

            'id',
            'product_id',
            'name',
            'sort_id',

        ],
    ]); ?>


</div>
