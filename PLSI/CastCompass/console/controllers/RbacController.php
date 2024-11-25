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

        $loginBO = $auth->createPermission('loginBO');
        $loginBO->description = 'Login to the BackOffice';
        $auth->add($loginBO);

        $userIndexBO = $auth->createPermission('userIndexBO');
        $userIndexBO->description = 'List of users, index, in the BackOffice';
        $auth->add($userIndexBO);

        $userCreateBO = $auth->createPermission('userCreateBO');
        $userCreateBO->description = 'Create a user in the BackOffice';
        $auth->add($userCreateBO);

        $userUpdateBO = $auth->createPermission('userUpdateBO');
        $userUpdateBO->description = 'Update a user in the BackOffice';
        $auth->add($userUpdateBO);

        $userDeleteBO = $auth->createPermission('userDeleteBO');
        $userDeleteBO->description = 'Delete a user in the BackOffice';
        $auth->add($userDeleteBO);


        $userViewBO = $auth->createPermission('userViewBO');
        $userViewBO->description = 'View a user in the BackOffice';
        $auth->add($userViewBO);

        // ####################
        // Admin Only Permissions
        // ####################

        // ----
        // Category Permissions
        // ----
        $categoriaIndexBO = $auth->createPermission('categoriaIndexBO');
        $categoriaIndexBO->description = 'List of categories, index, in the BackOffice';
        $auth->add($categoriaIndexBO);

        $categoriaViewBO = $auth->createPermission('categoriaViewBO');
        $categoriaViewBO->description = 'View a category in the BackOffice';
        $auth->add($categoriaViewBO);

        $categoriaCreateBO = $auth->createPermission('categoriaCreateBO');
        $categoriaCreateBO->description = 'Create a category in the BackOffice';
        $auth->add($categoriaCreateBO);

        $categoriaUpdateBO = $auth->createPermission('categoriaUpdateBO');
        $categoriaUpdateBO->description = 'Update a category in the BackOffice';
        $auth->add($categoriaUpdateBO);

        $categoriaDeleteBO = $auth->createPermission('categoriaDeleteBO');
        $categoriaDeleteBO->description = 'Delete a category in the BackOffice';
        $auth->add($categoriaDeleteBO);

        // ----
        // ... CONTINUE THE PERMISSIONS
        //----


        // Add the roles
        // For example Admin
        $admin = $auth->createRole('admin');
        //Employee Role
        $worker = $auth->createRole('worker');
        // Client Role
        $client = $auth->createRole('client');

        // Add the roles to the authManager
        $auth->add($admin);
        $auth->add($worker);
        $auth->add($client);

        // ##############
        // Add the permissions for the Admin
        // ##############

        // Login to the BackOffice
        $auth->addChild($admin, $loginBO);
        // User Permissions
        $auth->addChild($admin, $userIndexBO);
        $auth->addChild($admin, $userViewBO);
        $auth->addChild($admin, $userCreateBO);
        $auth->addChild($admin, $userUpdateBO);
        $auth->addChild($admin, $userDeleteBO);
        // Category Permissions
        $auth->addChild($admin, $categoriaIndexBO);
        $auth->addChild($admin, $categoriaViewBO);
        $auth->addChild($admin, $categoriaCreateBO);
        $auth->addChild($admin, $categoriaUpdateBO);
        $auth->addChild($admin, $categoriaDeleteBO);

        // ##############
        // Add the permissions for the Worker
        // ##############

        // Login to the BackOffice
        $auth->addChild($worker, $loginBO);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 2);

    }
}
