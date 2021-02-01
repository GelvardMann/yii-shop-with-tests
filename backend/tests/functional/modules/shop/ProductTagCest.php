<?php namespace backend\tests\functional\modules\shop;
use backend\tests\FunctionalTester;

class ProductTagCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckCategoryPage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/product-tag');
        $I->see('Products tags', 'h1');
        $I->seeLink('Create product tag');
        $I->click('Create product tag');
        $I->see('Create product tag', 'h1');
    }
}
