<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;

class ProdutoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryCreateAnProduto(FunctionalTester $I) {

        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', '12345678');
        $I->click('Login');

        $I->amOnPage('/produto/index');
        $I->click('Criar Produto');

        $I->fillField('Produto[nome]', 'Produto Teste');
        $I->fillField('Produto[descricao]', 'Descricao Teste');
        $I->fillField('Produto[preco]', '10');
        $I->fillField('Produto[stock]', '10');
        $I->selectOption('Produto[categoriaID]', 'Genero');
        $I->selectOption('Produto[ivaID]', '0.23');
        $I->attachFile('input[type="file"][name="ImagemForm[imagens][]"]', 'produto.png');
        $I->click('form button[type=submit]');
    }
}
