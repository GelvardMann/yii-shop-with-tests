<?php

use common\modules\shop\models\frontend\Product;
use common\modules\shop\Module;
use yii\web\View;

/* @var $this View */
/* @var $product Product */


?>

<div class="col-sm-4">
    <div class="card-deck">
        <div class="card">
            <?php if (!empty($product->images)): ?>
                <a href="/shop/<?= $product->id ?>">
                    <img src="<?= 'uploads/images/shop/' . $product->id . '/thumbnail/' . $product->images[0]['name'] ?>"
                         class="card-img-top"
                         style="max-width: 160px"
                         alt="...">
                </a>
            <?php else: ?>
                <img src="<?= Module::getAlias('uploads/images/shop/card-image.svg') ?>" class="card-img-top"
                     style="width: 160px;
                            opacity: .3;"
                     alt="...">
            <?php endif; ?>
            <div class="card-body">
                <h4 class="card-title"><?= $product->name ?></h4>
                <p class="card-text"><?= $product->description ?></p>
                <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
            </div>
        </div>
    </div>
</div>

<!--<div class="card" style="width: 18rem;">-->
<!--    <img src="..." class="card-img-top" alt="...">-->
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Название карточки</h5>-->
<!--        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--        <a href="#" class="btn btn-primary">Переход куда-нибудь</a>-->
<!--    </div>-->
<!--</div>-->