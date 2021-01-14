<?php

use common\modules\shop\models\backend\Tag;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\backend\search\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $relatedData Tag relations */

$this->title = Module::t('module', 'TAGS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'CREATE_TAG'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],

            'id',
            [
                'attribute' => 'name',
                'filter' => $relatedData['tags'],
            ],
        ],
    ]); ?>


</div>
