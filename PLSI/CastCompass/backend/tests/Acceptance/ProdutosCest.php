<?php


namespace backend\tests\Acceptance;

use backend\tests\AcceptanceTester;
use Codeception\Module\WebDriver;

class ProdutosCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // This test is to test the essential functionality of the Cast&Compass application
    public function tryToTest(AcceptanceTester $I)
    {
      $I->amOnPage('site/login');
      $I->wait(3);
      $I->fillField('Username', 'admin');
      $I->fillField('Password', '12345678');
      $I->click('Login');
      $I->wait(3);

      $I->amOnPage('produto/index');
      $I->wait(3);
      $I->click('Criar Produto');
      $I->fillField('Nome', 'Produto Teste');
      $I->fillField('Marca', 'Marca Teste');
      $I->fillField('Descricao', 'Descrição do Produto Teste');
      $I->fillField('Preco', '100');
      $I->fillField('Stock', '10');
      $I->selectOption('Categoria', 'Genero');
      $I->selectOption('Iva', '0.23');
      $I->attachFile('Imagens', 'produto.png');
      $I->click('Save');
      $I->wait(10);
    }
}
