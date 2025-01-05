<?php

namespace backend\tests\unit;

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

    // This test makes sure that the user model is working as expected
    public function testUserValidate() {
      $user = new User();

      $user->username = '';
      $this->assertFalse($user->validate(['username']));
      
      $user->username = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
      $this->assertFalse($user->validate(['username']));

      $user->username = 'Rubinho';
      $this->assertTrue($user->validate(['username']));

      $user->email = '';
      $this->assertFalse($user->validate());

      $user->email = 'rubinhogmail.com';
      $this->assertFalse($user->validate());

      $user->email = 'rubinho@rubinho';
      $this->assertFalse($user->validate());

      $user->email = 'rubinho@rubinho.com';
      $this->assertTrue($user->validate());
    
    }
    
    // This test makes sure that the user model is working as expected
    public function testUserFailSave() {
      $user = new User();

      $user->username = 'Rubinhoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo';
      $user->email = 'rubinho.com';
      $user->setPassword('ola');
      $user->generateAuthKey();
      $this->assertFalse($user->validate());

      $this->assertFalse($user->save());
    }

    public function testUserSuccessSave() {
      $user = new User();

      $user->username = 'Rubinho';
      $user->email = 'Rubinho@rubinho.com';
      $user->setPassword('12345678');
      $user->generateAuthKey();
      $this->assertTrue($user->validate());

      $this->assertTrue($user->save());
    }
}
