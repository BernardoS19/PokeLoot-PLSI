<?php


namespace common\tests\Unit;

use common\models\Carta;
use common\models\Imagem;
use common\tests\UnitTester;

class CartaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testCartaNomeInvalido()
    {
        $carta = new Carta();
        $carta->nome = 39487; // O nome tem de ser do tipo string
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaNomeNuloInvalido()
    {
        $carta = new Carta();
        $carta->nome = null; // O nome tem de ser do tipo string
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaPrecoInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = '4€'; // O preço tem de ser do tipo float
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaPrecoNuloInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = null; // O preço tem de ser do tipo float
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaDescricaoInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 7890; // A descrição tem de ser do tipo string
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaDescricaoNulaInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = null; // A descrição tem de ser do tipo string
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaValorVerificadoInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 5; // O Valor verificado tem de ser do tipo inteiro entre 0 e 1
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaValorVerificadoNuloInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = null; // O Valor verificado tem de ser do tipo inteiro entre 0 e 1
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaImagemInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 99999; // A Imagem tem de existir
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaImagemNulaInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = null; // A Imagem tem de existir
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaTipoInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 9898; // O Tipo tem de existir
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaTipoNuloInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = null; // O Tipo tem de existir
        $carta->elemento_id = 1;
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaElementoInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 8378; // O Elemento tem de existir
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaElementoNuloInvalido()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = null; // O Elemento tem de existir
        $carta->colecao_id = 1;

        $this->assertFalse($carta->validate());
    }

    public function testCartaColecaoInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = 7890; // A Coleção tem de existir

        $this->assertFalse($carta->validate());
    }

    public function testCartaColecaoNulaInvalida()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 2.30;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->imagem_id = 1;
        $carta->tipo_id = 1;
        $carta->elemento_id = 1;
        $carta->colecao_id = null; // A Coleção tem de existir

        $this->assertFalse($carta->validate());
    }

    public function testCartaSave()
    {
        $carta = new Carta();
        $carta->nome = 'Pikachu';
        $carta->preco = 4.24;
        $carta->descricao = 'Lorem Ipsum...';
        $carta->verificado = 0;
        $carta->tipo_id = 1;
        $carta->elemento_id = 4;
        $carta->colecao_id = 1;

        $imagem = new Imagem();
        $imagem->nome = '123456789123.png';
        $imagem->save();

        $carta->imagem_id = $imagem->id;

        $this->assertTrue($carta->save());
    }

    public function testEncontrarCartaCriada()
    {

        $this->tester->seeInDatabase(Carta::tableName(), ['nome' => 'Pikachu']);
    }

    public function testEditarCartaCriada()
    {
        $carta = Carta::find()->where(['nome' => 'Pikachu'])->one();
        $carta->preco = 1.99;

        $this->assertTrue($carta->save());
    }

    public function testEncontrarCartaAtualizada()
    {
        $this->tester->seeInDatabase(Carta::tableName(), ['nome' => 'Pikachu', 'preco' => 1.99]);
    }

    public function testEliminarCarta()
    {
        $carta = Carta::find()->where(['nome' => 'Pikachu', 'preco' => 1.99])->one();

        $this->assertIsNumeric($carta->delete());
    }

    public function testVerificarSeCartaFoiEliminada()
    {
        $this->tester->dontSeeInDatabase(Carta::tableName(), ['nome' => 'Pikachu']);
    }

}
