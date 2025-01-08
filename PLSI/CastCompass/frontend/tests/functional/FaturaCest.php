<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;
use common\models\User;

class FaturaCest
{
    public function _before(FunctionalTester $I)
    {
        $I->seeRecord(User::className(), ['username' => 'Client']);
        $I->amLoggedInAs(User::findOne(['username' => 'Client']));
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/fatura/index');
       // $I->click('div.class-card');
    }
}
