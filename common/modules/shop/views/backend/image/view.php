<?php

use common\modules\shop\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Image */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'IMAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'UPDATE'), ['update', 'id' => $model->id, 'product_id'=>$model->product_id], ['class' => 'btn btn-primary']) ?>
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
            'product_id',
            [
                'label' => Module::t('module', 'IMAGE'),
                'format' => 'raw',
                'value' => function ($data) {
                    $path = '/uploads/images/shop/' . $data->product_id . '/' . $data->name;
                    return Html::img($path, [
                        'alt' => $data->name,
                        'style' => 'max-width:150px;'
                    ]);
                },
            ],
        ],
    ]) ?>

</div>
