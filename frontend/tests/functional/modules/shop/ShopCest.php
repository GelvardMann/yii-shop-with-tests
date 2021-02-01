<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class ShopCest
{
    public function checkAbout(FunctionalTester $I)
    {
        $I->amOnRoute('/shop');
        $I->see('Products', 'li');
    }
}
