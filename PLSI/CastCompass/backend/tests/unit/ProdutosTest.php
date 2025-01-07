<?php

namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\Produto;
use common\models\Imagem;

class ProdutoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }
 
    public function testProdutoValidation() {
        $produto = new Produto();

        $produto->nome = '';
        $this->assertFalse($produto->validate(['nome']));

        $produto->nome = 'Nomeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
        $this->assertFalse($produto->validate(['nome']));

        $produto->nome = 'Nome Valido';
        $this->assertTrue($produto->validate(['nome']));

        $produto->marca = '';
        $this->assertFalse($produto->validate(['marca']));

        $produto->marca = 'Marcaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($produto->validate(['marca']));

        $produto->marca = 'Marca Valida';
        $this->assertTrue($produto->validate(['marca']));

        $produto->preco = '';
        $this->assertFalse($produto->validate(['preco']));

        $produto->preco = '100';
        $this->assertTrue($produto->validate(['preco']));

        $produto->stock = '';
        $this->assertFalse($produto->validate(['stock']));

        $produto->stock = '10';
        $this->assertTrue($produto->validate(['stock']));

        $produto->descricao = '';
        $this->assertFalse($produto->validate(['descricao']));

        $produto->descricao = 'Descrição Valida';
        $this->assertTrue($produto->validate(['descricao']));

        $produto->categoriaID = '';
        $this->assertFalse($produto->validate(['categoriaID']));

        $produto->categoriaID = '1';
        $this->assertTrue($produto->validate(['categoriaID']));

        $produto->ivaID = '';
        $this->assertFalse($produto->validate(['ivaID']));

        $produto->ivaID = '1';
        $this->assertTrue($produto->validate(['ivaID']));

        $imagem = new Imagem();

        $imagem->produtoID = '';
        $this->assertFalse($imagem->validate(['produtoID']));

        $imagem->produtoID = '16';
        $this->assertTrue($imagem->validate(['produtoID']));

        $imagem->filename = '';
        $this->assertFalse($imagem->validate(['filename']));

        $imagem->filename = 'imagem.png';
        $this->assertTrue($imagem->validate(['filename']));
    }

    public function testProdutoFailSave() {
        $produto = new Produto();

        $produto->nome = '';
        $produto->marca = '';
        $produto->descricao = '';
        $produto->preco = '';
        $produto->stock = '';
        $produto->categoriaID = '';
        $produto->ivaID = '';
        $this->assertFalse($produto->validate());
        $this->assertFalse($produto->save());
    }

    public function testProdutoSuccessSave() {
        $produto = new Produto();

        $produto->nome = 'Nome Valido';
        $produto->marca = 'Marca Valida';
        $produto->descricao = 'Descrição Valida';
        $produto->preco = '100';
        $produto->stock = '10';
        $produto->categoriaID = '1';
        $produto->ivaID = '1';
        $this->assertTrue($produto->validate());
        $this->assertTrue($produto->save());
    }

}
