<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CarrinhoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'Client');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('Login');

        $I->amOnPage('/site/shop');
        $I->click('Adicionar ao Carrinho');
        $I->amOnPage('/carrinho/index');
        $I->click('Finalizar Compra');
        $I->see('Pagamento');
    }
}
