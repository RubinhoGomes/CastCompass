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
    $I->selectOption('metodoExpedicao', 'CTT');
    $I->selectOption('metodoPagamento', 'MBWay');
    $I->click('button#comprar');

  }
}
