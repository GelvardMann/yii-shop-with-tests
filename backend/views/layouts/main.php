<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\modules\shop\Module;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => Module::t('module', 'SHOP'),
            'items' => [
                ['label' => Module::t('module', 'PRODUCTS'), 'url' => ['/shop/product/index']],
                ['label' => Module::t('module', 'CATEGORIES'), 'url' => ['/shop/category/index']],
                ['label' => Module::t('module', 'TAGS'), 'url' => ['/shop/tag/index']],
                ['label' => Module::t('module', 'PRODUCT_TAG'), 'url' => ['/shop/product-tag/index']],
                ['label' => Module::t('module', 'ATTRIBUTES'), 'url' => ['/shop/attribute/index']],
                ['label' => Module::t('module', 'ATTRIBUTE_VALUES'), 'url' => ['/shop/attribute-value/index']],
                ['label' => Module::t('module', 'IMAGES'), 'url' => ['/shop/image/index']],
                ['label' => Module::t('module', 'STATUSES'), 'url' => ['/shop/status/index']],
            ]],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => \common\modules\user\Module::t('module', 'LOGIN'), 'url' => ['/user/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                \common\modules\user\Module::t('module', 'LOGOUT'). ' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
