<?php namespace backend\tests\functional\modules\shop;
use backend\tests\FunctionalTester;

class TagsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckTagsPage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/tag');
        $I->see('Tags', 'h1');
        $I->seeLink('Create tag');
        $I->click('Create tag');
        $I->see('Create tag', 'h1');
    }
}
