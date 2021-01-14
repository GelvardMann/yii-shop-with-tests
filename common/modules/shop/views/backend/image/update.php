<?php

use common\modules\shop\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Image */
/* @var $multiple * if the form should only load one image  * */

$this->title = Module::t('module', 'UPDATE_IMAGE: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'IMAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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

    <?= $this->render('_form', [
        'model' => $model,
        'multiple' => $multiple,
    ]) ?>

</div>
