<?php namespace backend\tests\functional\modules\shop;
use backend\tests\FunctionalTester;

class AttributeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function CheckAttributePage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/attribute');
        $I->see('Attributes', 'h1');
        $I->seeLink('Create attribute');
        $I->click('Create attribute');
        $I->see('Create attribute', 'h1');
    }
}
