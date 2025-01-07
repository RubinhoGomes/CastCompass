<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\Categoria;

class CategoriasTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testCategoriaValidation()
    {

        $categoria = new Categoria();

        $categoria->nome = '';
        $this->assertFalse($categoria->validate(['nome']));

        $categoria->nome = 'Nomeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
        $this->assertFalse($categoria->validate(['nome']));

        $categoria->nome = 'Nome Valido';
        $this->assertTrue($categoria->validate(['nome']));

        $categoria->genero = '';
        $this->assertFalse($categoria->validate(['genero']));

        $categoria->genero = 'Generoeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
        $this->assertFalse($categoria->validate(['genero']));

        $categoria->genero = 'Genero Valido';
        $this->assertTrue($categoria->validate(['genero']));
        
    }

    public function testCategoriaFailedSave() {
        $categoria = new Categoria();

        $categoria->nome = '';
        $categoria->genero = '';
        $this->assertFalse($categoria->validate());
        $this->assertFalse($categoria->save()); 
    }

    public function testCategoriaSave() {
        $categoria = new Categoria();

        $categoria->nome = 'Nome Valido';
        $categoria->genero = 'Genero Valido';
        $this->assertTrue($categoria->validate());
        $this->assertTrue($categoria->save());
    }

}
