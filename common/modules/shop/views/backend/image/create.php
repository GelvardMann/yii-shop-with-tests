<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Image */

$this->title = Module::t('module', 'CREATE_IMAGE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'IMAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
