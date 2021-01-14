<?php

use common\modules\shop\Module;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Image */
/* @var $form yii\widgets\ActiveForm */
/* @var $multiple * if the form should only load one image  * */

?>

<div class="image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' =>
            [
                'accept' => 'image/*',
                'multiple' => isset($multiple) ? $multiple : true,
            ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('module', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
