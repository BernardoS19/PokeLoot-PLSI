<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use Codeception\Util\Locator;

class CrudCartaCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryCriarCarta(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Cartas
        $I->seeLink('Gestão de Cartas');
        $I->click('Gestão de Cartas');
        $I->see('Cartas');

        //Página de Criar uma Carta
        $I->seeLink('Create Carta');
        $I->click('Create Carta');
        $I->see('Create Carta');

        //Preencher formulário
        $I->attachFile('#form-carta input[type=file]', 'carta_teste.png');
        $I->fillField('Carta[nome]', 'Pikachu');
        $I->fillField('Carta[preco]', '3.10');
        $I->fillField('Carta[descricao]', 'Lorem Ipsum ...');
        $I->selectOption('Carta[tipo_id]', 'Pokémon');
        $I->selectOption('Carta[elemento_id]', 'Elétrico');
        $I->selectOption('Carta[colecao_id]', 'POP Series 2');

        $I->click('Save');

        // Redireciona para a Página da Carta
        $I->see('Pikachu');
    }

    public function tryAlterarImagemDaCarta(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Cartas
        $I->seeLink('Gestão de Cartas');
        $I->click('Gestão de Cartas');
        $I->see('Cartas');

        //Procura uma Carta
        $I->see('Squirtle');
        $I->see('', Locator::href('/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1"]']);

        //Na Página view da Carta
        $I->see('Squirtle');

        $I->seeLink('Alterar Imagem');
        $I->click('Alterar Imagem');
        $I->see('Update Carta: Squirtle');

        //Alterar a Imagem pelo Formulário
        $I->attachFile('#form-update-imagem input[type=file]', 'carta_teste.png');
        $I->click('Save');

        // Redireciona para a Página da Carta
        $I->see('Squirtle');
    }

    public function tryEditarCarta(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Cartas
        $I->seeLink('Gestão de Cartas');
        $I->click('Gestão de Cartas');
        $I->see('Cartas');

        //Procura uma Carta
        $I->see('Squirtle');
        $I->see('', Locator::href('/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1"]']);

        //Na Página view da Carta
        $I->see('Squirtle');

        $I->seeLink('Atualizar');
        $I->click('Atualizar');
        $I->see('Update Carta: Squirtle');

        //Verificar os dados atuais no formulário
        $I->seeInField('Carta[nome]', 'Squirtle');
        $I->seeInField('Carta[preco]', '1.45');
        $I->seeInField('Carta[descricao]', 'Suspendisse tincidunt auctor sem, eu commodo augue ullamcorper ut. Curabitur vulputate pharetra dui, quis maximus lacus. Proin vulputate, quam ut commodo vehicula, dolor sapien elementum diam, eu commodo erat ligula nec sapien.');
        $I->seeOptionIsSelected('Carta[tipo_id]', 'Pokémon');
        $I->seeOptionIsSelected('Carta[elemento_id]', 'Água');
        $I->seeOptionIsSelected('Carta[colecao_id]', 'EX Team Magma vs. Team Aqua');

        //Alterar os dados no Formulário
        $I->fillField('Carta[nome]', 'Pikachu');
        $I->fillField('Carta[preco]', '3.10');
        $I->fillField('Carta[descricao]', 'Lorem Ipsum ...');
        $I->selectOption('Carta[tipo_id]', 'Pokémon');
        $I->selectOption('Carta[elemento_id]', 'Elétrico');
        $I->selectOption('Carta[colecao_id]', 'POP Series 2');
        $I->click('Save');

        // Redireciona para a Página da Carta
        $I->see('Pikachu');
    }

    public function tryEliminarCarta(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de gestão de Cartas
        $I->seeLink('Gestão de Cartas');
        $I->click('Gestão de Cartas');
        $I->see('Cartas');

        //Procura uma Carta
        $I->see('Squirtle');
        $I->see('', Locator::href('/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/carta/view?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1"]']);

        //Na Página view da Carta
        $I->see('Squirtle');

        //Clicar para eliminar a Carta
        $I->seeLink('Remover');
        $I->sendAjaxPostRequest('/carta/delete?id=3&imagem_id=3&tipo_id=1&elemento_id=2&colecao_id=1');
    }
}
