<?php

use common\modules\shop\models\backend\AttributeValue;
use common\modules\shop\models\backend\Image;
use common\modules\shop\models\backend\ProductTag;
use common\modules\shop\Module;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\shop\models\backend\Product */
/* @var $attributeValue AttributeValue */
/* @var $productTags ProductTag */
/* @var $images Image */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PRODUCTS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
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
            'id',
            'code',
            'name',
            'description:ntext',
            'alias',
            [
                'attribute' => 'category_id',
                'value' => ArrayHelper::getValue($model, 'category.name'),
            ],
            'new:boolean',
            'sale:boolean',
            'active:boolean',
            [
                'attribute' => 'status_id',
                'value' => ArrayHelper::getValue($model, 'status.status'),
            ],
            'percent',
            'price',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <h2>
        <?= Module::t('module', 'ATTRIBUTES'); ?>
    </h2>
    <p>
        <?= Html::a(Module::t('module', 'ADD_ATTRIBUTE'), ['/shop/attribute-value/create', 'product_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $attributeValue,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'attribute-value'
            ],

            [
                'attribute' => 'attribute_id',
                'value' => 'productAttributes.name',
            ],
            'value',

        ],
    ]); ?>

    <h2>
        <?= Module::t('module', 'TAGS'); ?>
    </h2>
    <p>
        <?= Html::a(Module::t('module', 'ADD_TAG'), ['/shop/product-tag/create', 'product_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $productTags,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'product-tag'
            ],

            [
                'attribute' => 'tag_id',
                'value' => 'tag.name',
            ],
        ],
    ]); ?>

    <h2>
        <?= Module::t('module', 'IMAGES'); ?>
    </h2>
    <p>
        <?php
        if (count($model->images) < Module::getInstance()->countUploadFiles) {
            echo Html::a(Module::t('module', 'ADD_IMAGES'),
                [
                    '/shop/image/create', 'product_id' => $model->id
                ],
                [
                    'class' => 'btn btn-primary'
                ]);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $images,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'images',
                'urlCreator' => function ($action, $model) {
                    return Url::to(['/shop/image/' . $action,
                        'id' => $model->id,
                        'product_id' => $model->product_id

                    ]);
                }
            ],

            [
                'label' => Module::t('module', 'IMAGE'),
                'format' => 'raw',
                'value' => function ($data) {
                    $path = '/uploads/images/shop/' . $data->product_id . '/' . $data->name;
                    return Html::img($path, [
                        'alt' => $data->name,
                        'style' => 'max-width:200px;'
                    ]);
                },
            ],
        ],
    ]); ?>

</div>
