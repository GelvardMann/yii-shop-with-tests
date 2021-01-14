<?php

use common\modules\shop\models\backend\Product;
use common\modules\shop\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $relatedData Product all relations data */

$this->title = Module::t('module', 'PRODUCTS');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'CREATE_PRODUCT'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],

            'code',
            'name',
            'description',
            'alias',
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => $relatedData['categories'],
            ],
            [
                'attribute' => 'new',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],
            [
                'attribute' => 'sale',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],
            [
                'attribute' => 'status_id',
                'value' => 'status.status',
                'filter' => $relatedData['statuses'],
            ],
            [
                'attribute' => 'tag_id',
                'value' => function (Product $product) {
                    return implode(',', ArrayHelper::map($product->tags, 'id', 'name'));
                },
                'filter' => $relatedData['tags'],
            ],
            'percent',
            'price',
            //'created_at',
            //'updated_at',

        ],
    ]); ?>


</div>
