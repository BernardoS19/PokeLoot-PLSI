<?php


namespace common\tests\Unit;

use common\models\Carta;
use common\models\Fatura;
use common\models\LinhaFatura;
use common\tests\UnitTester;

class FaturaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testFaturaDataInvalida()
    {
        $fatura = new Fatura();

        $fatura->data = 'data teste'; // A data tem de estar no formato certo
        $fatura->pago = 0;
        $fatura->user_id = 5;

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaDataFormatoInvalido()
    {
        $fatura = new Fatura();

        $fatura->data = date('d/m/Y H:i:s', strtotime('01/12/2024 12:00:00')); // A data tem de estar no formato certo
        $fatura->pago = 0;
        $fatura->user_id = 5;

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaDataErradaInvalida()
    {
        $fatura = new Fatura();

        $fatura->data = date('Y-m-d H:i:s', strtotime('2023/03/17 12:33:00')); // Ao atribuir um valor ao campo da Data na Fatura, tem de ser preenchido com a data e hora da atribuição
        $fatura->pago = 0;
        $fatura->user_id = 5;

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaEstadoPagoInvalido()
    {
        $fatura = new Fatura();

        $fatura->data = null;
        $fatura->pago = 10; // O estado Pago só pode ser 0 (Não) ou 1 (Sim)
        $fatura->user_id = 5;

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaEstadoPagoNuloInvalido()
    {
        $fatura = new Fatura();

        $fatura->data = null;
        $fatura->pago = null; // É obrigatório o preenchimento do estado Pago quando uma fatura é criada
        $fatura->user_id = 5;

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaUserInexistenteInvalido()
    {
        $fatura = new Fatura();

        $fatura->data = null;
        $fatura->pago = 0;
        $fatura->user_id = 9898; // O Utilizador tem de existir para ser associado a uma fatura

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaUserNuloInvalido()
    {
        $fatura = new Fatura();

        $fatura->data = null;
        $fatura->pago = 0;
        $fatura->user_id = null; // O Utilizador tem de existir para ser associado a uma fatura

        $this->assertFalse($fatura->validate());
    }

    public function testFaturaSave()
    {
        $fatura = new Fatura();

        $fatura->data = null;
        $fatura->pago = 0;
        $fatura->user_id = 5;

        $this->assertTrue($fatura->save());
    }

    public function testEncontrarFaturaCriada()
    {
        $this->tester->seeInDatabase(Fatura::tableName(), ['user_id' => 5, 'pago' => 0]);
    }

    public function testLinhaFaturaIdDaFaturaInexistenteInvalido()
    {
        $linha = new LinhaFatura();

        $linha->fatura_id = 989898; // O Id da Fatura tem de existir para ser criada uma nova linha fatura
        $linha->carta_id = 4;
        $linha->preco = null;
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaIdDaFaturaNuloInvalido()
    {
        $linha = new LinhaFatura();

        $linha->fatura_id = null; // O Id da Fatura tem de existir para ser criada uma nova linha fatura
        $linha->carta_id = 4;
        $linha->preco = null;
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaIdDaCartaInexistenteInvalido()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = 6748;  // O Id da Carta tem de existir para ser criada uma nova linha fatura
        $linha->preco = null;
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaIdDaCartaNuloInvalido()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = null;  // O Id da Carta tem de existir para ser criada uma nova linha fatura
        $linha->preco = null;
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaPrecoInvalido()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = 4;
        $linha->preco = 'preço'; // O preço tem de ser do tipo float
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaPrecoNegativoInvalido()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = 4;
        $linha->preco = -5.10; // O preço tem de estar acima de 0.1
        $linha->verificado = null;

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaEstadoVerificadoInvalido()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = 4;
        $linha->preco = null;
        $linha->verificado = 10; // O estado Verificado só pode ser 0 (Não) ou 1 (Sim)

        $this->assertFalse($linha->validate());
    }

    public function testLinhaFaturaSave()
    {
        $linha = new LinhaFatura();

        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha->fatura_id = $fatura->id;
        $linha->carta_id = 4;
        $linha->preco = null;
        $linha->verificado = null;

        $this->assertTrue($linha->save());
    }

    public function testEncontrarLinhaFaturaCriada()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $this->tester->seeInDatabase(LinhaFatura::tableName(), ['fatura_id' => $fatura->id, 'carta_id' => 4]);
    }

    public function testEditarLinhaFaturaCriada()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();

        $linha = LinhaFatura::find()->where(['fatura_id' => $fatura->id, 'carta_id' => 4])->one();
        $linha->preco = $linha->carta->preco;
        $linha->verificado = $linha->carta->verificado;

        $this->assertTrue($linha->save());
    }

    public function testEncontrarLinhaFaturaAtualizada()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();
        $carta = Carta::findOne(['id' => 4]);

        $this->tester->seeInDatabase(LinhaFatura::tableName(), ['fatura_id' => $fatura->id, 'carta_id' => 4, 'preco' => $carta->preco, 'verificado' => $carta->verificado]);
    }

    public function testEditarFaturaCriada()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 0])->one();
        $fatura->data = date('Y-m-d H:i:s');
        $fatura->pago = 1;

        $this->assertTrue($fatura->save());
    }

    public function testEncontrarFaturaAtualizada()
    {
        $this->tester->seeInDatabase(Fatura::tableName(), ['user_id' => 5, 'pago' => 1]);
    }

    public function testEliminarLinhaFatura()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 1])->one();

        $linha = LinhaFatura::find()->where(['fatura_id' => $fatura->id, 'carta_id' => 4])->one();

        $this->assertIsNumeric($linha->delete());
    }

    public function testVerificarSeLinhaFaturaFoiEliminada()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 1])->one();

        $this->tester->dontSeeInDatabase(LinhaFatura::tableName(), ['fatura_id' => $fatura->id, 'carta_id' => 4]);
    }

    public function testEliminarFatura()
    {
        $fatura = Fatura::find()->where(['user_id' => 5, 'pago' => 1])->one();

        $this->assertIsNumeric($fatura->delete());
    }

    public function testVerificarSeFaturaFoiEliminada()
    {
        $this->tester->dontSeeInDatabase(Fatura::tableName(), ['user_id' => 5, 'pago' => 1]);
    }

}
