<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Example of adding something
        $loginBO = $auth->createPermission('loginBO');
        $loginBO->description = 'Login to the BackOffice';
        $auth->add($loginBO);

        // ----
        // ... CONTINUE THE PERMISSIONS
        //----


        // Add the roles
        // For example Admin
        $admin = $auth->createRole('admin');
        //Employee Role
        $worker = $auth->createRole('worker');
        // Client Role
        $cliente = $auth->createRole('client');

        // Add the roles to the authManager
        $auth->add($admin);

        // Add the permissions to the roles
        $auth->addChild($admin, $loginBO);


    

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 2);

    }
}
