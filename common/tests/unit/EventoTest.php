<?php


namespace common\tests\Unit;

use common\models\Evento;
use common\tests\UnitTester;

class EventoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testEventoDescricaoInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 3135; // A descrição tem de ser to tipo string
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoDescricaoNulaInvalida()
    {
        $evento = new Evento();

        $evento->descricao = null; // A descrição tem de ser to tipo string e é de preenchimento obrigatório
        $evento->data = date('Y-m-d', strtotime('2023-04-20'));;
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoDataInferiorADataAtualInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2009-02-10'));; // A data de um evento tem de ser superior à data de quando é criado
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoDataFormatoInvalido()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('d/m/Y', strtotime('23/11/2023')); // O formato da data na insersão tem de ser no formato php:Y-m-d
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoDataNulaInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = null; // A Data é um campo obrigatório para o registo de um Evento
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoLongitudeNulaInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = null; // A Longitude é obrigatória para o registo de um Evento
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoLatitudeNulaInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = '-8.80000001';
        $evento->latitude = null; // A Latitude é obrigatória para o registo de um Evento
        $evento->carta_id = 4;

        $this->assertFalse($evento->validate());
    }

    public function testEventoCartaInexistenteInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 98989; // A Carta tem de existir para ser associada ao Evento

        $this->assertFalse($evento->validate());
    }

    public function testEventoCartaNulaInvalida()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = null; // A Carta tem de existir para ser associada ao Evento

        $this->assertFalse($evento->validate());
    }

    public function testEventoSave()
    {
        $evento = new Evento();

        $evento->descricao = 'Lorem Ipsum...';
        $evento->data = date('Y-m-d', strtotime('2023-07-04'));
        $evento->longitude = '-8.80000001';
        $evento->latitude = '39.72001948';
        $evento->carta_id = 4;

        $this->assertTrue($evento->save());
    }

    public function testEncontrarEventoCriado()
    {
        $this->tester->seeInDatabase(Evento::tableName(), ['data' => date('Y-m-d', strtotime('2023-07-04'))]);
    }

    public function testEditarEventoCriado()
    {
        $evento = Evento::find()->where(['data' => date('Y-m-d', strtotime('2023-07-04'))])->one();
        $evento->longitude = '-8.98374516';

        $this->assertTrue($evento->save());
    }

    public function testEncontrarEventoAtualizado()
    {
        $this->tester->seeInDatabase(Evento::tableName(), ['data' => date('Y-m-d', strtotime('2023-07-04')), 'longitude' => '-8.98374516']);
    }

    public function testEliminarEvento()
    {
        $evento = Evento::find()->where(['data' => date('Y-m-d', strtotime('2023-07-04')), 'longitude' => '-8.98374516'])->one();

        $this->assertIsNumeric($evento->delete());
    }

    public function testVerificarSeEventoFoiEliminado()
    {
        $this->tester->dontSeeInDatabase(Evento::tableName(), ['data' => date('Y-m-d', strtotime('2023-07-04'))]);
    }

}
