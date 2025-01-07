<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class LoginCest
{
  /**
   * @param FunctionalTester $I
   */
  public function loginUser(FunctionalTester $I) {
    
    $I->amOnPage('/site/login');
    $I->fillField('LoginForm[username]', 'Client');
    $I->fillField('LoginForm[password]', '12345678');
    $I->click('Login');

    $I->fillField('LoginForm[username]', 'admin');
    $I->fillField('LoginForm[password]', '12345678');

    $I->click('form button[type=submit]');


  }
}
