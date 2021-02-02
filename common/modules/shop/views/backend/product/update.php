<?php

use common\modules\shop\models\backend\Image;
use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Product */
/* @var $relatedData common\modules\shop\models\backend\Product all relations data */
/* @var $images Image */

$this->title = Module::t('module', 'UPDATE_PRODUCT: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PRODUCTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>

<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
        'images' => $images,
        'multiple' => false,
    ]) ?>

</div>
