<?php namespace backend\tests\functional\modules\shop;

use backend\tests\FunctionalTester;

class CategoryCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckCategoryPage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/category');
        $I->see('categories', 'h1');
        $I->seeLink('Create category');
        $I->click('Create category');
        $I->see('Create category', 'h1');
    }
}
