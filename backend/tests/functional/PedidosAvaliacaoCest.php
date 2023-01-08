<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use Codeception\Util\Locator;
use common\models\Pedido_avaliacao;

class PedidosAvaliacaoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryAvaliadorCriaUmPedidoAvaliacao(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'avaliador2');
        $I->fillField('LoginForm[password]', 'avaliador123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de Pedidos de Avaliação
        $I->seeLink('Pedidos de Avaliação');
        $I->click('Pedidos de Avaliação');
        $I->see('Pedidos de Avaliação', 'h1');

        //Criar um Pedido de Avaliação
        $I->seeLink('Criar Pedido Avaliação');
        $I->click('Criar Pedido Avaliação');
        $I->see('Criar Pedido de Avaliação', 'h1');

        //Escolher uma Carta para Avaliar
        $I->see('Escolher', Locator::href('/index-test.php/pedido_avaliacao/create?id=4&imagem_id=4&tipo_id=1&elemento_id=1&colecao_id=2&user_id=4'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/pedido_avaliacao/create?id=4&imagem_id=4&tipo_id=1&elemento_id=1&colecao_id=2&user_id=4"]']);

        //É redirecionado para a Página Inicial
        $I->see('Página Inicial');

        //Página de Pedidos de Avaliação para verificar o Pedido Criado
        $I->seeLink('Pedidos de Avaliação');
        $I->click('Pedidos de Avaliação');
        $I->see('Pedidos de Avaliação', 'h1');

        $I->seeLink('Consultar Todos os meus Pedidos');
        $I->click('Consultar Todos os meus Pedidos');
        $I->see('Todos os Meus Pedidos', 'h3');

        $I->see('Ivysaur');
        $I->see('Por Autorizar');

    }

    public function tryAdminAutorizaUmPedidoAvaliacao(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de Pedidos de Avaliação
        $I->seeLink('Pedidos de Avaliação');
        $I->click('Pedidos de Avaliação');
        $I->see('Pedidos de Avaliação', 'h1');

        //Admin vê o Pedido
        $I->see('avaliador2 | avaliador2@pokeloot.pt');
        $I->see('Mr. Briney’s Compassion');

        //Autoriza o Pedido de Avaliação
        $I->sendAjaxPostRequest('/index-test.php/pedido_avaliacao/autorizar?user_id=4&carta_id=5');

        $I->see('Pedidos de Avaliação', 'h1');

        //Verificar Pedido que aguarda Avaliação
        $I->seeLink('Pedidos que aguardam avaliação');
        $I->click('Pedidos que aguardam avaliação');

        $I->see('Pedidos autorizados a aguardar avaliação', 'h3');

        $I->see('avaliador2 | avaliador2@pokeloot.pt');
        $I->see('Mr. Briney’s Compassion');
    }

    public function tryAvaliadorAvaliaUmaCartaPeloPedidoAvaliacao(FunctionalTester $I)
    {
        //Login
        $I->amOnPage('site/login');
        $I->see('Acesso reservado a administradores');
        $I->fillField('LoginForm[username]', 'avaliador2');
        $I->fillField('LoginForm[password]', 'avaliador123');
        $I->click('Entrar');

        //Na Página Inicial
        $I->see('Página Inicial');

        //Página de Pedidos de Avaliação
        $I->seeLink('Pedidos de Avaliação');
        $I->click('Pedidos de Avaliação');
        $I->see('Pedidos autorizados por avaliar', 'h3');

        $I->see('Cubone');

        $I->seeLink('', Locator::href('/index-test.php/pedido_avaliacao/update?user_id=4&carta_id=2'));
        $I->click(['xpath'=>'//a[@href="/index-test.php/pedido_avaliacao/update?user_id=4&carta_id=2"]']);

        //Altera o Preço da Carta
        $I->see('Alterar preço da carta: Cubone', 'h1');

        $I->fillField('Pedido_avaliacao[valor_avaliado]', '2.50');
        $I->click('Alterar');

        $I->see('Pedidos autorizados por avaliar', 'h3');


    }
}
