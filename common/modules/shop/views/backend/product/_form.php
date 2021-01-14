<?php

use common\modules\shop\models\backend\Image;
use common\modules\shop\Module;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var common\modules\shop\models\backend\Product $model */
/* @var yii\widgets\ActiveForm $form */
/* @var $relatedData $model->getRelatedData */
/* @var Image $images */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($relatedData['categories']) ?>

    <?= $form->field($model, 'new')->checkbox() ?>

    <?= $form->field($model, 'sale')->checkbox() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'status_id')->dropDownList($relatedData['statuses']) ?>

    <?= $form->field($model, 'percent')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' =>
            [
                'accept' => 'image/*',
                'multiple' => isset($multiple) ? $multiple : true,
            ],
        'pluginOptions' => [
            'initialPreview' => isset($images['url']) ? $images['url'] : false,
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => isset($images['config']) ? $images['config'] : false,
            'overwriteInitial' => false,
            'showRemove' => true,
            'showUpload' => false,
            'deleteUrl' => Url::toRoute([
                '/shop/image/ajax-delete'
            ]),
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('module', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
