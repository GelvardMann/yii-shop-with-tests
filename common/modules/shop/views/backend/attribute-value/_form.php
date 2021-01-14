<?php

use common\modules\shop\models\backend\Attribute;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\AttributeValue */
/* @var $form yii\widgets\ActiveForm */
/* @var $relatedData Attribute relations */
?>

<div class="attribute-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'attribute_id')->dropDownList($relatedData['attributes']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('module', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
