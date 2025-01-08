<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;
use common\models\User;

class favoritosCest
{
    public function _before(FunctionalTester $I)
    {
        $I->seeRecord(User::className(), ['username' => 'Client']);
        $I->amLoggedInAs(User::findOne(['username' => 'Client']));
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/site/shop');
        $I->click('.fa-heart');
        $I->amOnPage('/favoritos/index');
        $I->see('Produto1');
    }
}
