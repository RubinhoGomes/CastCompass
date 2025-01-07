<?php

namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CarrinhoCest
{
    public function _before(FunctionalTester $I) {

    }

    public function tryToTest(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'Client');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('Login');

        $I->amOnPage('/site/shop');
        $I->click('.fa-shopping-cart');
        $I->amOnPage('/carrinho/index');
        $I->click('Finalizar compra', '.btn';
        $I->see('Pagamento');
    }
}
