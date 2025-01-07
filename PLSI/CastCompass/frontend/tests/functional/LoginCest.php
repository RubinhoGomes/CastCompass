<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }
    
    public function checkLogin(FunctionalTester $I) {
        $I->amOnRoute('site/login');

        $I->fillField('LoginForm[username]', 'Client');
        $I->fillField('LoginForm[password]', '12345678');
        
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('login-button');
        $I->see('Logout (admin)');
    }

}
