<?php

namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;
use common\models\User;

class CarrinhoCest
{
  public function _before(FunctionalTester $I)
  {
    $I->seeRecord(User::className(), ['username' => 'Client']);
    $I->amLoggedInAs(User::findOne(['username' => 'Client']));
  }

  public function tryToTest(FunctionalTester $I) {
    $I->amOnPage('/site/shop');
    $I->click('.fa-shopping-cart');
    $I->amOnPage('/carrinho/index');
    // Clicar no botão para finalizar a compra
    $I->click('a#comprar');
    $I->see('Método de Expedição:');
    $I->selectOption('metodoExpedicaoID', '1');
    $I->selectOption('metodoPagamento', 'MBWay');
    $I->click('.btn.btn-success');

  }
}
