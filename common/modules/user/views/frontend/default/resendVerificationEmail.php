<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model ResetPasswordForm */

use common\modules\user\forms\ResetPasswordForm;
use common\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Module::t('module','RESEND_VERIFICATION_EMAIL');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-resend-verification-email">

    <p><?= Module::t('module','RESEND_VERIFICATION_EMAIL_MESSAGE')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>