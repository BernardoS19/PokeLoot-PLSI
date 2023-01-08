<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class ComprarCartaCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryComprarCarta(FunctionalTester $I)
    {
        //Na Página Inicial
        $I->amOnPage(Url::to('site/index'));
        $I->see('Recentemente Adicionadas', 'h2');

        //Fazer Login
        $I->seeLink('Login');
        $I->click('Login');

        $I->see('Login', 'h3');
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'cliente123');
        $I->click('Login', '#login-btn');

        //Volta à Página Inicial
        $I->see('Recentemente Adicionadas', 'h2');
        //Verifica se está autenticado
        $I->seeLink('Perfil');

        //Ir à Página do Catálogo
        $I->seeLink('Catálogo');
        $I->click('Catálogo');

        $I->see('Pesquisar por Coleção:', '.head');

        //Filtrar por Tipo
        $I->selectOption('tipo', 'Pokémon');
        $I->click('Filtrar');

        //Ver os Detalhes da Carta
        $I->see('Ivysaur', 'h6');
        $I->seeLink('', '/carta/detalhes?cartaId=4');
        $I->click(['xpath'=>'//a[@href="/index-test.php/carta/detalhes?cartaId=4"]']);

        //Na Página de detalhes da Carta
        $I->see('Ivysaur', 'h3');
        //Adicionar a Carta ao Carrinho
        $I->seeLink('Adicionar ao Carrinho');
        $I->click('Adicionar ao Carrinho');

        $I->see('Carta adicionada ao Carrinho de compras');

        //Para a Página do Carrinho de Compras
        $I->seeLink('', '/carrinho/index');
        $I->click(['xpath'=>'//a[@href="/index-test.php/carrinho/index"]']);

        $I->see('Carrinho de Compras', 'h2');
        $I->see('Ivysaur', 'h4');

        //Para a Página de Compra
        $I->seeLink('Comprar');
        $I->click('Comprar');

        $I->see('Lista de Itens a comprar', 'h2');
        $I->see('Ivysaur | POP Series 2 ');
        $I->see('Pagamento', 'h4');

        //Preencher o formulário do Pagamento e finalizar a compra
        $I->fillField('PagamentoForm[nome]', 'Cliente teste');
        $I->fillField('PagamentoForm[numero]', '4123785790873647');
        $I->fillField('PagamentoForm[data_validade]', '03/24');
        $I->fillField('PagamentoForm[ccv]', '498');

        $I->click('Finalizar Compra');

        //Redireciona para a Página Inicial
        $I->see('Compra efetuada com sucesso!');

        $I->see('Recentemente Adicionadas', 'h2');

        //Ir ao Perfil
        $I->seeLink('Perfil');
        $I->click('Perfil');

        $I->see('Perfil', 'h2');

        //Ver o Histórico de Aquisições
        $I->seeLink('Ver Histórico de Aquisições');
        $I->click('Ver Histórico de Aquisições');

        //Na Página de Histórico de Aquisições
        $I->see('Histórico de Aquisições', 'h2');
        //Verifica a Carta Comprada
        $I->see('Ivysaur');
    }
}
