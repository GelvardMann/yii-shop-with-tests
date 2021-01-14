<?php

use common\modules\shop\models\backend\Attribute;
use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\AttributeValue */
/* @var $relatedData Attribute relations */

$this->title = Module::t('module', 'UPDATE_ATTRIBUTE_VALUE: {name}', [
    'name' => $model->product_id,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ATTRIBUTE_VALUES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'attribute_id' => $model->attribute_id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE');
?>
<div class="attribute-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
    ]) ?>

</div>
