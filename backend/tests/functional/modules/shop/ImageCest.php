<?php namespace backend\tests\functional\modules\shop;

use backend\tests\FunctionalTester;

class ImageCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckImagePage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/image');
        $I->see('Images', 'h1');
    }
}
