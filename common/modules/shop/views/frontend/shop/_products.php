<?php

use common\modules\shop\models\frontend\Image;
use common\modules\shop\models\frontend\Product;
use common\modules\shop\Module;
use yii\web\View;

/* @var $this View */
/* @var $product Product */

?>

<div class="col-sm-4">
    <div class="card-deck">
        <div class="card">
            <?php if (!empty($mainImage)): ?>
                <img src="<?= 'uploads/images/shop/' . $product->id . '/' . $mainImage['name'] ?>" class="card-img-top"
                     style="max-width: 100%"
                     alt="...">
            <?php else: ?>
                <img src="<?= Module::getAlias('uploads/images/noImage.png') ?>" class="card-img-top"
                     style="max-width: 100%" alt="...">
            <?php endif; ?>
            <div class="card-body">
                <h4 class="card-title"><?= $product->name ?></h4>
                <p class="card-text"><?= $product->description ?></p>
                <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
            </div>
        </div>
    </div>
</div>