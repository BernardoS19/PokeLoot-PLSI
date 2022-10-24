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

        // CRUD USER
        // add "CreateUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Criar um utilizador';
        $auth->add($createUser);

        // add "UpdateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Alterar um utilizador';
        $auth->add($updateUser);

        // add "ReadUser" permission
        $readUser = $auth->createPermission('readUser');
        $readUser->description = 'Ler um utilizador';
        $auth->add($readUser);

        // add "DeleteUser" permission
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Elimina um utilizador';
        $auth->add($deleteUser);

        //add "CreateCarta"
        $createCarta = $auth->createPermission('createCarta');
        $createCarta->description = 'Cria uma Carta';
        $auth->add($createCarta);

        //add "UpdateCarta"
        $updateCarta = $auth->createPermission('updateCarta');
        $updateCarta->description = 'Altera uma Carta';
        $auth->add($updateCarta);

        //add "ReadCarta"
        $readCarta = $auth->createPermission('readCarta');
        $readCarta->description = 'Ler uma Carta';
        $auth->add($readCarta);

        //add "DeleteCarta"
        $deleteCarta = $auth->createPermission('deleteCarta');
        $deleteCarta->description = 'Elimina uma Carta';
        $auth->add($deleteCarta);

        //add "CreateTipo"
        $createTipo = $auth->createPermission('createTipo');
        $createTipo->description = 'Cria um tipo de carta';
        $auth->add($createTipo);

        //add "UpdateTipo"
        $updateTipo = $auth->createPermission('updateTipo');
        $updateTipo->description = 'Altera um tipo de carta';
        $auth->add($updateTipo);

        //add "ReadTipo"
        $readTipo = $auth->createPermission('readTipo');
        $readTipo->description = 'Ler um tipo de carta';
        $auth->add($readTipo);

        //add "DeleteTipo"
        $deleteTipo = $auth->createPermission('deleteCarta');
        $deleteTipo->description = 'Elimina um Tipo de Carta';
        $auth->add($deleteTipo);

        //add "CreateElemento"
        $createElemento = $auth->createPermission('createElemento');
        $createElemento->description = 'Cria um elemento de Carta';
        $auth->add($createElemento);

        //add "UpdateElemento"
        $updateElemento = $auth->createPermission('updateElemento');
        $updateElemento->description = 'Altera um elemento de Carta';
        $auth->add($updateElemento);

        //add "ReadElemento"
        $readElemento = $auth->createPermission('readElemento');
        $readElemento->description = 'Ler um elemento de Carta';
        $auth->add($readElemento);

        //add "DeleteElemento"
        $deleteElemento = $auth->createPermission('deleteElemento');
        $deleteElemento->description = 'Elimina um elemento de Carta';
        $auth->add($deleteElemento);

        //add "CreateEvento"
        $createEvento = $auth->createPermission('deleteElemento');
        $deleteElemento->description = 'Elimina um elemento de Carta';
        $auth->add($deleteElemento);

        //add "UpdateEvento"
        $deleteElemento = $auth->createPermission('deleteElemento');
        $deleteElemento->description = 'Elimina um elemento de Carta';
        $auth->add($deleteElemento);

        //add "ReadEvento"
        $deleteElemento = $auth->createPermission('deleteElemento');
        $deleteElemento->description = 'Elimina um elemento de Carta';
        $auth->add($deleteElemento);

        //add "DeleteEvento"
        $deleteElemento = $auth->createPermission('deleteElemento');
        $deleteElemento->description = 'Elimina um elemento de Carta';
        $auth->add($deleteElemento);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $avaliador = $auth->createRole('avaliador');
        $cliente = $auth->createRole('cliente');
        $auth->add($admin);
        //User
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $readUser);
        $auth->addChild($admin, $deleteUser);
        //Carta
        $auth->addChild($admin, $createCarta);
        $auth->addChild($admin, $updateCarta;
        $auth->addChild($admin, $readCarta);
        $auth->addChild($admin, $deleteCarta);
        //Tipo
        $auth->addChild($admin, $createTipo);
        $auth->addChild($admin, $updateTipo);
        $auth->addChild($admin, $readTipo);
        $auth->addChild($admin, $deleteTipo);
        //Elemento
        $auth->addChild($admin, $createElemento);
        $auth->addChild($admin, $updateElemento);
        $auth->addChild($admin, $readElemento);
        $auth->addChild($admin, $deleteElemento);

        // Assign roles to users. 1  returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
    }
}