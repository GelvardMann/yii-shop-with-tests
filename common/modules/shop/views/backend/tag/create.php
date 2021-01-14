<?php

use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Tag */

$this->title = Module::t('module', 'CREATE_TAG');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'TAGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
