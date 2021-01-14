<?php

use common\modules\shop\models\backend\Attribute;
use common\modules\shop\models\backend\AttributeValue;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\AttributeValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $relatedData Attribute relations */

$this->title = Module::t('module', 'ATTRIBUTE_VALUES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-value-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'CREATE_ATTRIBUTE_VALUE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],

            [
                'attribute' => 'product_id',
                'value' => 'product.name'
            ],
            [
                'attribute' => 'attribute_id',
                'value' => 'productAttributes.name',
                'filter' => $relatedData['attributes'],
            ],
            'value',

        ],
    ]); ?>


</div>
