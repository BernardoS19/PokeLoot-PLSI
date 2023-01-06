<?php


namespace common\tests\Unit;

use common\models\Pedido_avaliacao;
use common\tests\UnitTester;

class PedidoAvaliacaoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testPedidoAvaliacaoUserInexistenteInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 98998; // O Utilizador precisa de existir para ser associado a um novo Pedido de Avaliação
        $pedido->carta_id = 5;
        $pedido->estado = 'Por Autorizar';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoUserNuloInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = null; // O Utilizador precisa de existir para ser associado a um novo Pedido de Avaliação
        $pedido->carta_id = 5;
        $pedido->estado = 'Por Autorizar';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoUserQueNaoEAvaliadorInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 5; // O Utilizador precisa de ter a role de Avaliador para ser associado a um novo Pedido de Avaliação
        $pedido->carta_id = 5;
        $pedido->estado = 'Por Autorizar';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoCartaInexistenteInvalida()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 9376; // A Carta precisa de existir para ser associada a um novo Pedido de Avaliação
        $pedido->estado = 'Por Autorizar';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoCartaNulaInvalida()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = null; // A Carta precisa de existir para ser associada a um novo Pedido de Avaliação
        $pedido->estado = 'Por Autorizar';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoEstadoInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'teste'; // O estado precisa de ter um dos valores predefinidos para criar um novo Pedido de Avaliação
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoEstadoNuloInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = null; // O estado tem de estar obrigatoriamente preenchido para criar um novo Pedido de Avaliação
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoValorAvaliadoInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'Autorizado';
        $pedido->valor_avaliado = '2€'; // O valor para avaliação tem de ser do tipo float
        $pedido->data_avaliacao = null;

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoDataAvaliacaoInvalida()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'Autorizado';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = 'data'; // A data de avaliação tem de estar no formato certo

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoDataAvaliacaoFormatoInvalido()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'Autorizado';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = date('d/m/Y', strtotime('14/08/2023')); // A data de avaliação tem de estar no formato certo

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoDataAvaliacaoErradaInvalida()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'Autorizado';
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = date('Y-m-d', strtotime('2022-03-16')); // Ao criar um Pedido de Avaliação o campo da data tem de ser preenchido com a data da criação

        $this->assertFalse($pedido->validate());
    }

    public function testPedidoAvaliacaoSave()
    {
        $pedido = new Pedido_avaliacao();

        $pedido->user_id = 4;
        $pedido->carta_id = 5;
        $pedido->estado = 'Autorizado';
        $pedido->valor_avaliado = 5.00;
        $pedido->data_avaliacao = date('Y-m-d H:i:s');

        $this->assertTrue($pedido->save());
    }

    public function testEncontrarPedidoAvaliacaoCriado()
    {
        $this->tester->seeInDatabase(Pedido_avaliacao::tableName(), ['user_id' => 4, 'carta_id' => 5]);
    }

    public function testEditarPedidoAvaliacaoCriado()
    {
        $pedido = Pedido_avaliacao::find()->where(['user_id' => 4, 'carta_id' => 5])->one();
        $pedido->valor_avaliado = 6.50;

        $this->assertTrue($pedido->save());
    }

    public function testEncontrarPedidoAvaliacaoAtualizado()
    {
        $this->tester->seeInDatabase(Pedido_avaliacao::tableName(), ['user_id' => 4, 'carta_id' => 5, 'valor_avaliado' => 6.50]);
    }

    public function testEliminarPedidoAvaliacao()
    {
        $pedido = Pedido_avaliacao::find()->where(['user_id' => 4, 'carta_id' => 5, 'valor_avaliado' => 6.50])->one();

        $this->assertIsNumeric($pedido->delete());
    }

    public function testVerificarSePedidoAvaliacaoFoiEliminado()
    {
        $this->tester->dontSeeInDatabase(Pedido_avaliacao::tableName(), ['user_id' => 4, 'carta_id' => 5, 'valor_avaliado' => 6.50]);
    }
}
