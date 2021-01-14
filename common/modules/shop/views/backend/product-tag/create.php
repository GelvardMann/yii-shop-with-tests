<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\ProductTag */
/* @var $relatedData common\modules\shop\models\backend\ProductTag */

$this->title = Module::t('module', 'CREATE_PRODUCT_TAG');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PRODUCT_TAGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
    ]) ?>

</div>
