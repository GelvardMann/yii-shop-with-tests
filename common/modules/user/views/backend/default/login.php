<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model LoginForm */

use common\modules\user\forms\LoginForm;
use common\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Module::t('module', 'LOGIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <p><?= Module::t('module', 'LOGIN_MESSAGE') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton(Module::t('module', 'LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
