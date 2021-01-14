<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Product */
/* @var $relatedData common\modules\shop\models\backend\Product all relations data  */

$this->title = Module::t('module', 'CREATE_PRODUCT');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PRODUCTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
    ]) ?>

</div>
