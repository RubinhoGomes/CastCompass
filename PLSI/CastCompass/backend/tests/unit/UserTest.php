<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\User;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function userFalse() {
      $user = new User();
      $user->username = '';
      $user->password = '';
      $this->assertFalse($user->validate());
    }


}
