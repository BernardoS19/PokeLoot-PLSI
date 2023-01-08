<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use Codeception\Util\Locator;

class CrudEventoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryCriarEvento(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Eventos
        $I->seeLink('Eventos');
        $I->click('Eventos');
        $I->see('Eventos');

        //Criar um Evento
        $I->seeLink('Criar Evento');
        $I->click('Criar Evento');

        //Escolher a Carta para o Evento
        $I->see('Escolher uma Carta', 'h3');

        $I->see('Escolher', Locator::href('/index-test.php/evento/create?id=2&imagem_id=2&tipo_id=1&elemento_id=5&colecao_id=1'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/evento/create?id=2&imagem_id=2&tipo_id=1&elemento_id=5&colecao_id=1"]']);

        //Página de Criar Evento
        $I->see('Create Evento', 'h1');

        $I->fillField('Evento[data]', '2023-08-14');
        $I->fillField('Evento[descricao]', 'Lorem Ipsum ...');
        $I->fillField('Evento[latitude]', '39.734498702238305');
        $I->fillField('Evento[longitude]', '-8.82128624212004');

        $I->click('Save');
        // Redireciona para a Página da vista do Evento
        $I->see('14/08/2023');

    }

    public function tryEditarEvento(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Eventos
        $I->seeLink('Eventos');
        $I->click('Eventos');
        $I->see('Eventos');

        //Escolher o Evento para Editar
        $I->see('', Locator::href('/index-test.php/evento/escolher_carta_update?id=1&carta_id=6'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/evento/escolher_carta_update?id=1&carta_id=6"]']);

        //Escolher uma nova Carta
        $I->see('Escolher uma Carta para alterar o evento', 'h3');

        $I->see('Escolher', Locator::href('/index-test.php/evento/update?id=1&carta_id=6&carta_nova=1'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/evento/update?id=1&carta_id=6&carta_nova=1"]']);

        //Editar Evento
        $I->seeInField('Evento[descricao]', 'Este evento decorrerá no Jardim Luís de Camões em Leiria, sendo também o local onde se encontra a carta secreta. Boa sorte para a busca do QR Code que permite resgatar a carta.');

        $I->fillField('Evento[data]', '2023-11-11');
        $I->fillField('Evento[descricao]', 'Lorem Ipsum dolor sit amet');
        $I->fillField('Evento[latitude]', '39.734498702238305');
        $I->fillField('Evento[longitude]', '-8.82128624212004');

        $I->click('Save');
        // Redireciona para a Página da vista do Evento
        $I->see('11/11/2023');
        $I->see('Lorem Ipsum dolor sit amet');

    }

    public function tryEliminarEvento(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Eventos
        $I->seeLink('Eventos');
        $I->click('Eventos');
        $I->see('Eventos');

        //Vista do Evento
        $I->see('', Locator::href('/index-test.php/evento/view?id=1&carta_id=6'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/evento/view?id=1&carta_id=6"]']);

        $I->see('22/03/2024');

        //Elimina o Evento
        $I->seeLink('Delete');
        $I->sendAjaxPostRequest('/index-test.php/evento/delete?id=1&carta_id=6');
    }
}
