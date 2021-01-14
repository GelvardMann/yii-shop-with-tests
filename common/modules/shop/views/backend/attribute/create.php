<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Attribute */

$this->title = Module::t('module', 'CREATE_ATTRIBUTE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ATTRIBUTES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
