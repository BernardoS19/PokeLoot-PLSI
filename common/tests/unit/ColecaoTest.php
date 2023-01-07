<?php


namespace common\tests\Unit;

use common\models\Colecao;
use common\tests\UnitTester;

class ColecaoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testColecaoNomeInvalido()
    {
        $colecao = new Colecao();
        $colecao->nome = 93731; // O nome da Coleção tem de ser do tipo string

        $this->assertFalse($colecao->validate());
    }

    public function testColecaoNomeNuloInvalido()
    {
        $colecao = new Colecao();
        $colecao->nome = null; // O nome é um campo obrigatório para o registo de uma Coleção

        $this->assertFalse($colecao->validate());
    }

    public function testColecaoNomeMaximoCaracteresExcedidoInvalido()
    {
        $colecao = new Colecao();
        $colecao->nome = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        // O nome da Coleção não pode conter mais de 255 caracteres
        $this->assertFalse($colecao->validate());
    }

    public function testColecaoSave()
    {
        $colecao = new Colecao();
        $colecao->nome = 'Coleção Teste';

        $this->assertTrue($colecao->save());
    }

    public function testEncontrarColecaoCriada()
    {
        $this->tester->seeInDatabase(Colecao::tableName(), ['nome' => 'Coleção Teste']);
    }

    public function testEditarColecaoCriada()
    {
        $colecao = Colecao::find()->where(['nome' => 'Coleção Teste'])->one();

        $colecao->nome = 'Coleção Editada';

        $this->assertTrue($colecao->save());
    }

    public function testEncontrarColecaoAtualizada()
    {
        $this->tester->seeInDatabase(Colecao::tableName(), ['nome' => 'Coleção Editada']);
    }

    public function testEliminarColecao()
    {
        $colecao = Colecao::find()->where(['nome' => 'Coleção Editada'])->one();

        $this->assertIsNumeric($colecao->delete());
    }

    public function testVerificarSeColecaoFoiEliminada()
    {
        $this->tester->dontSeeInDatabase(Colecao::tableName(), ['nome' => 'Coleção Editada']);
    }
}
