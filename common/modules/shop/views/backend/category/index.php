<?php

use common\modules\shop\models\backend\Category;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $relatedData Category relations */

$this->title = Module::t('module', 'CATEGORIES');
$this->params['breadcrumbs'][] = $this->title;
?>
<pre>
    <?php
        $categories = Category::find()->asArray()->all();
        $tree = \common\modules\shop\models\backend\helpers\TreeHelper::makeTree($categories);

    ?>
</pre>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'CREATE_CATEGORY'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],

            'id',
            'name',
            'alias',
            [
                'attribute' => 'parent_id',
                'value' => 'parent.name',
                'filter' => $relatedData,
            ],
        ],
    ]); ?>


</div>
