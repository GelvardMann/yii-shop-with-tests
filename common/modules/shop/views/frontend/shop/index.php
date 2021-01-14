<?php

use common\modules\shop\Module;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $searchModel common\modules\shop\models\frontend\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'PRODUCTS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="container">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                <?= Module::t('module', 'FILTERS') ?>
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="col-md-12">
                category
            </div>
        </div>
        <div class="col-sm-9">
            <div class="row">
                <?php foreach ($dataProvider->getModels() as $product): ?>
                    <?= $this->render('_products', [
                        'product' => $product
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="row align">
        <div class="col-sm-6 text-left">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->getPagination(),
            ]) ?>
        </div>
        <div class="col-sm-6 text-right">Showing <?= $dataProvider->getCount() ?>
            of <?= $dataProvider->getTotalCount() ?>
        </div>
    </div>
</div>
