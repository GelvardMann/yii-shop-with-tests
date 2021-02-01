<?php namespace backend\tests\functional\modules\shop;
use backend\tests\FunctionalTester;

class AttributeValueCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckAttributeValuePage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/attribute-value');
        $I->see('Attribute values', 'h1');
        $I->seeLink('Create attribute value');
        $I->click('Create attribute value');
        $I->see('Create attribute value', 'h1');
    }
}
