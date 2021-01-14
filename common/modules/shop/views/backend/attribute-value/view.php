<?php

use common\modules\shop\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\AttributeValue */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ATTRIBUTE_VALUES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="attribute-value-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'UPDATE'), ['update', 'product_id' => $model->product_id, 'attribute_id' => $model->attribute_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('module', 'DELETE'), ['delete', 'product_id' => $model->product_id, 'attribute_id' => $model->attribute_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'DELETE_THIS'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'product_id',
                'value' => ArrayHelper::getValue($model, 'product.name'),
            ],
            [
                'attribute' => 'attribute_id',
                'value' => ArrayHelper::getValue($model, 'productAttributes.name'),
            ],
            'value',
        ],
    ]) ?>

</div>
