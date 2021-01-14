<?php

use common\modules\shop\models\backend\Tag;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\ProductTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $relatedData Tag */

$this->title = Module::t('module', 'PRODUCT_TAGS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'CREATE_PRODUCT_TAG'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],

            [
                'attribute' => 'product_id',
                'value' => 'product.name',
            ],
            [
                'attribute' => 'tag_id',
                'value' => 'tag.name',
                'filter' => $relatedData['tags'],
            ],


        ],
    ]); ?>


</div>
