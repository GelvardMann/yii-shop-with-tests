<?php

use common\modules\shop\models\backend\Category;
use common\modules\shop\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Category */
/* @var $relatedData Category relations */

$this->title = Module::t('module', 'CREATE_CATEGORY');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'relatedData' => $relatedData,
    ]) ?>

</div>
