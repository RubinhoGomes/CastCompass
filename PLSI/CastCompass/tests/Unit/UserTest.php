<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
use common\models\User;
use Yii;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }
    
    public function testUserCanBeCreated()
    {
        $user = new User();
        $user->name = 'John Doe';
        $user->email = '';
        $user->password = Yii::$app->security->generatePasswordHash('password');
        $user->save();
        assertFalse($user->hasErrors());

}
