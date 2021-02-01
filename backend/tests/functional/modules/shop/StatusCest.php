<?php namespace backend\tests\functional\modules\shop;
use backend\tests\FunctionalTester;

class StatusCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CheckStatusPage(FunctionalTester $I)
    {
        $I->amOnRoute('shop/status');
        $I->see('Statuses', 'h1');
        $I->seeLink('Create status');
        $I->click('Create status');
        $I->see('Create status', 'h1');
    }
}
