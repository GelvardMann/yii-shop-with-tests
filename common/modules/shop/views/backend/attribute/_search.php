<?php

use common\modules\shop\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\search\AttributeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('module', 'SEARCH'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Module::t('module', 'RESET'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
