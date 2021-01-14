<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model PasswordResetRequestForm */

use common\modules\user\forms\PasswordResetRequestForm;
use common\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Module::t('module','REQUEST_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">

    <p><?= Module::t('module', 'REQUEST_PASS_TOKEN_MESSAGE')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'REQUEST_PASSWORD_RESET_FORM']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>