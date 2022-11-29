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
        $deleteTipo = $auth->createPermission('deleteTipo');
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
        $createEvento = $auth->createPermission('createEvento');
        $createEvento->description = 'Cria um evento';
        $auth->add($createEvento);

        //add "UpdateEvento"
        $updateEvento = $auth->createPermission('updateEvento');
        $updateEvento->description = 'Altera um evento';
        $auth->add($updateEvento);

        //add "ReadEvento"
        $readEvento = $auth->createPermission('readEvento');
        $readEvento->description = 'Ler um evento';
        $auth->add($readEvento);

        //add "DeleteEvento"
        $deleteEvento = $auth->createPermission('deleteEvento');
        $deleteEvento->description = 'Elimina um Evento';
        $auth->add($deleteEvento);

        //add "CreateColecao"
        $createColecao = $auth->createPermission('createColecao');
        $createColecao->description = 'Cria uma Colecao';
        $auth->add($createColecao);

        //add "UpdateColecao"
        $updateColecao = $auth->createPermission('updateColecao');
        $updateColecao->description = 'Altera uma colecao';
        $auth->add($updateColecao);

        //add "ReadColecao"
        $readColecao = $auth->createPermission('readColecao');
        $readColecao->description = 'Ler uma Colecao';
        $auth->add($readColecao);

        //add "DeleteColecao"
        $deleteColecao = $auth->createPermission('deleteColecao');
        $deleteColecao->description = 'Elimina uma Colecao';
        $auth->add($deleteColecao);

        //add "CreatePedido"
        $createPedido = $auth->createPermission('createPedido');
        $createPedido->description = 'Cria um Pedido';
        $auth->add($createPedido);

        //add "UpdatePedido"
        $updatePedido = $auth->createPermission('updatePedido');
        $updatePedido->description = 'Altera um Pedido';
        $auth->add($updatePedido);

        //add "ReadPedido"
        $readPedido = $auth->createPermission('readPedido');
        $readPedido->description = 'ler um Pedido';
        $auth->add($readPedido);

        //add "DeletePedido"
        $deletePedido = $auth->createPermission('deletePedido');
        $deletePedido->description = 'Elimina um Pedido';
        $auth->add($deletePedido);

        //add "CreatePerfil"
        $createPerfil = $auth->createPermission('createPerfil');
        $createPerfil->description = 'Cria um perfil';
        $auth->add($createPerfil);

        //add "UpdatePerfil"
        $updatePerfil = $auth->createPermission('updatePerfil');
        $updatePerfil->description = 'Altera um perfil';
        $auth->add($updatePerfil);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role

        // Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        // permissões User
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $readUser);
        $auth->addChild($admin, $deleteUser);
        // permissões Carta
        $auth->addChild($admin, $createCarta);
        $auth->addChild($admin, $updateCarta);
        $auth->addChild($admin, $readCarta);
        $auth->addChild($admin, $deleteCarta);
        // permissões Tipo
        $auth->addChild($admin, $createTipo);
        $auth->addChild($admin, $updateTipo);
        $auth->addChild($admin, $readTipo);
        $auth->addChild($admin, $deleteTipo);
        // permissões Elemento
        $auth->addChild($admin, $createElemento);
        $auth->addChild($admin, $updateElemento);
        $auth->addChild($admin, $readElemento);
        $auth->addChild($admin, $deleteElemento);
        // permissões Evento
        $auth->addChild($admin, $createEvento);
        $auth->addChild($admin, $updateEvento);
        $auth->addChild($admin, $readEvento);
        $auth->addChild($admin, $deleteEvento);
        // permissões Colecao
        $auth->addChild($admin, $createColecao);
        $auth->addChild($admin, $updateColecao);
        $auth->addChild($admin, $readColecao);
        $auth->addChild($admin, $deleteColecao);
        // permissões Pedidos
        $auth->addChild($admin, $createPedido);
        $auth->addChild($admin, $updatePedido);
        $auth->addChild($admin, $readPedido);
        $auth->addChild($admin, $deletePedido);

        // Avaliador
        $avaliador = $auth->createRole('avaliador');
        $auth->add($avaliador);
        // permissões Cartas
        $auth->addChild($avaliador, $updateCarta);
        $auth->addChild($avaliador, $readCarta);
        // permissões Tipos
        $auth->addChild($avaliador, $readTipo);
        // permissões Elementos
        $auth->addChild($avaliador, $readElemento);
        // permissões Pedidos
        $auth->addChild($avaliador, $createPedido);
        $auth->addChild($avaliador, $updatePedido);
        $auth->addChild($avaliador, $readPedido);
        $auth->addChild($avaliador, $deletePedido);

        // Cliente
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        // permissões Cartas
        $auth->addChild($cliente, $readCarta);
        // permissões Tipos
        $auth->addChild($cliente, $readTipo);
        // permissões Elementos
        $auth->addChild($cliente, $readElemento);
        // permissões Perfil
        $auth->addChild($cliente, $updatePerfil);

        // Assign roles to users. 1  returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
    }
}