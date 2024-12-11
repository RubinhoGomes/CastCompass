<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        // Creating the instance of the Auth Manager
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // ###############
        // Create the Permissions
        // ###############

        // Login to the BackOffice
        $loginBO = $auth->createPermission('loginBO');
        $loginBO->description = 'Login to the BackOffice';
        $auth->add($loginBO);
       
        // ####################
        // Admin Only Permissions
        // ####################
        
        // ---
        // User Permissions
        // ---

        // Index 
        $userIndexBO = $auth->createPermission('userIndexBO');
        $userIndexBO->description = 'List of users, index, in the BackOffice';
        $auth->add($userIndexBO);
        // Create
        $userCreateBO = $auth->createPermission('userCreateBO');
        $userCreateBO->description = 'Create a user in the BackOffice';
        $auth->add($userCreateBO);
        // Update
        $userUpdateBO = $auth->createPermission('userUpdateBO');
        $userUpdateBO->description = 'Update a user in the BackOffice';
        $auth->add($userUpdateBO);
        // Delete
        $userDeleteBO = $auth->createPermission('userDeleteBO');
        $userDeleteBO->description = 'Delete a user in the BackOffice';
        $auth->add($userDeleteBO);
        // View
        $userViewBO = $auth->createPermission('userViewBO');
        $userViewBO->description = 'View a user in the BackOffice';
        $auth->add($userViewBO);
 
        // ----
        // Category Permissions
        // ----
        
        // Index
        $categoriaIndexBO = $auth->createPermission('categoriaIndexBO');
        $categoriaIndexBO->description = 'List of categories, index, in the BackOffice';
        $auth->add($categoriaIndexBO);
        // View
        $categoriaViewBO = $auth->createPermission('categoriaViewBO');
        $categoriaViewBO->description = 'View a category in the BackOffice';
        $auth->add($categoriaViewBO);
        // Create
        $categoriaCreateBO = $auth->createPermission('categoriaCreateBO');
        $categoriaCreateBO->description = 'Create a category in the BackOffice';
        $auth->add($categoriaCreateBO);
        // Update
        $categoriaUpdateBO = $auth->createPermission('categoriaUpdateBO');
        $categoriaUpdateBO->description = 'Update a category in the BackOffice';
        $auth->add($categoriaUpdateBO);
        // Delete
        $categoriaDeleteBO = $auth->createPermission('categoriaDeleteBO');
        $categoriaDeleteBO->description = 'Delete a category in the BackOffice';
        $auth->add($categoriaDeleteBO);

        // ----
        // Product Permissions
        // ----

        // Index
        $produtoIndexBO = $auth->createPermission('produtoIndexBO');
        $produtoIndexBO->description = 'List of products, index, in the BackOffice';
        $auth->add($produtoIndexBO);
        // View
        $produtoViewBO = $auth->createPermission('produtoViewBO');
        $produtoViewBO->description = 'View a product in the BackOffice';
        $auth->add($produtoViewBO);
        // Create
        $produtoCreateBO = $auth->createPermission('produtoCreateBO');
        $produtoCreateBO->description = 'Create a product in the BackOffice';
        $auth->add($produtoCreateBO);
        // Update
        $produtoUpdateBO = $auth->createPermission('produtoUpdateBO');
        $produtoUpdateBO->description = 'Update a product in the BackOffice';
        $auth->add($produtoUpdateBO);
        // Delete
        $produtoDeleteBO = $auth->createPermission('produtoDeleteBO');
        $produtoDeleteBO->description = 'Delete a product in the BackOffice';
        $auth->add($produtoDeleteBO);


        // ----
        // IVA Permissions
        // ----

        $ivaIndexBO = $auth->createPermission('ivaIndexBO');
        $ivaIndexBO->description = 'List of IVA, index, in the BackOffice';
        $auth->add($ivaIndexBO);

        $ivaViewBO = $auth->createPermission('ivaViewBO');
        $ivaViewBO->description = 'View a IVA in the BackOffice';
        $auth->add($ivaViewBO);

        $ivaCreateBO = $auth->createPermission('ivaCreateBO');
        $ivaCreateBO->description = 'Create a IVA in the BackOffice';
        $auth->add($ivaCreateBO);

        $ivaUpdateBO = $auth->createPermission('ivaUpdateBO');
        $ivaUpdateBO->description = 'Update a IVA in the BackOffice';
        $auth->add($ivaUpdateBO);

        $ivaDeleteBO = $auth->createPermission('ivaDeleteBO');
        $ivaDeleteBO->description = 'Delete a IVA in the BackOffice';
        $auth->add($ivaDeleteBO);


        // ----
        // Metodo de Pagamento Permissions
        // ----

        $mpIndexBO = $auth->createPermission('mpIndexBO');
        $mpIndexBO->description = 'List of Payment Methods, index, in the BackOffice';
        $auth->add($mpIndexBO);

        $mpViewBO = $auth->createPermission('mpViewBO');
        $mpViewBO->description = 'View the Payment Methods in the BackOffice';
        $auth->add($mpViewBO);

        $mpCreateBO = $auth->createPermission('mpCreateBO');
        $mpCreateBO->description = 'Create a Payment Method in the BackOffice';
        $auth->add($mpCreateBO);

        $mpUpdateBO = $auth->createPermission('mpUpdateBO');
        $mpUpdateBO->description = 'Update a Payment Method in the BackOffice';
        $auth->add($mpUpdateBO);

        $mpDeleteBO = $auth->createPermission('mpDeleteBO');
        $mpDeleteBO->description = 'Delete a Payment Method in the BackOffice';
        $auth->add($mpDeleteBO);

        // ----
        // Encomenda Permissions
        // ----
        
        $encomendaIndexBO = $auth->createPermission('encomendaIndexBO');
        $encomendaIndexBO->description = 'List of all orders, index, in the BackOffice';
        $auth->add($encomendaIndexBO);

        $encomendaViewBO = $auth->createPermission('encomendaViewBO');
        $encomendaViewBO->description = 'View a order in the BackOffice';
        $auth->add($encomendaViewBO);

        $encomendaCreateBO = $auth->createPermission('encomendaCreateBO');
        $encomendaCreateBO->description = 'Create a order in the BackOffice';
        $auth->add($encomendaCreateBO);

        $encomendaUpdateBO = $auth->createPermission('encomendaUpdateBO');
        $encomendaUpdateBO->description = 'Update a order in the BackOffice';
        $auth->add($encomendaUpdateBO);

        $encomendaDeleteBO = $auth->createPermission('encomendaDeleteBO');
        $encomendaDeleteBO->description = 'Delete a order in the BackOffice';
        $auth->add($encomendaDeleteBO);


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
        // Product Permissions
        $auth->addChild($admin, $produtoIndexBO);
        $auth->addChild($admin, $produtoViewBO);
        $auth->addChild($admin, $produtoCreateBO);
        $auth->addChild($admin, $produtoUpdateBO);
        $auth->addChild($admin, $produtoDeleteBO);
        // IVA Permissions
        $auth->addChild($admin, $ivaIndexBO);
        $auth->addChild($admin, $ivaViewBO);
        $auth->addChild($admin, $ivaCreateBO);
        $auth->addChild($admin, $ivaUpdateBO);
        $auth->addChild($admin, $ivaDeleteBO);
        // Metodo de Pagamento Permissions
        $auth->addChild($admin, $mpIndexBO);
        $auth->addChild($admin, $mpViewBO);
        $auth->addChild($admin, $mpCreateBO);
        $auth->addChild($admin, $mpUpdateBO);
        $auth->addChild($admin, $mpDeleteBO);
        // Encomenda Permissions
        $auth->addChild($admin, $encomendaIndexBO);
        $auth->addChild($admin, $encomendaViewBO);
        $auth->addChild($admin, $encomendaCreateBO);
        $auth->addChild($admin, $encomendaUpdateBO);
        $auth->addChild($admin, $encomendaDeleteBO);


        // ##############
        // Add the permissions for the Worker
        // ##############


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
