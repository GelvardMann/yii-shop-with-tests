<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\ProductTag */
/* @var $relatedData common\modules\shop\models\backend\ProductTag */

$this->title = Module::t('module', 'UPDATE_PRODUCT_TAG: {name}', [
    'name' => $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PRODUCT_TAGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'tag_id' => $model->tag_id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="product-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
    ]) ?>

</div>
