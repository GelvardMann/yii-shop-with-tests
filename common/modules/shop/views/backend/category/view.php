<?php

use common\modules\shop\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'DELETE_THIS'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'alias',
            'parent_id',
            [
                'attribute' => 'parent_id',
                'label' => Module::t('module', 'CATEGORY_NAME'),
                'value' => ArrayHelper::getValue($model, 'parent.name'),
            ],
        ],
    ]) ?>

</div>
