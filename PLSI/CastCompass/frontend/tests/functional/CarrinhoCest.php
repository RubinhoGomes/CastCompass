<?php

namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CarrinhoCest
{
    public function _before(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'Client');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('Login');
    }

    public function tryToTest(FunctionalTester $I) {
        $I->amOnPage('/site/shop');
        $I->click('.fa-shopping-cart');
        $I->amOnPage('/carrinho/index');
        // Clicar no botão para finalizar a compra
        $I->click('a.btn.btn-primary');
        $I->selectOption('metodoExpedicao', 'CTT');
        $I->selectOption('metodoPagamento', 'MBWay');
    }
}
