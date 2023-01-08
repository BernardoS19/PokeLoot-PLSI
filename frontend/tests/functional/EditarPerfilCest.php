<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class EditarPerfilCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryEditarPerfil(FunctionalTester $I)
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
        $I->click('Perfil');

        //Na Página Perfil
        $I->see('Perfil', 'h2');

        //Editar o Perfil
        $I->seeLink('Editar');
        $I->click('Editar');

        $I->seeInField('Perfil[nome]', 'cliente');

        $I->fillField('Perfil[nome]', 'Cliente Teste');
        $I->fillField('Perfil[morada]', 'Rua nº17');
        $I->fillField('Perfil[cod_postal]', '2400-999');
        $I->fillField('Perfil[telefone]', '987654321');

        $I->click('Guardar Alterações');

        $I->see('Perfil Atualizado!');

    }
}
