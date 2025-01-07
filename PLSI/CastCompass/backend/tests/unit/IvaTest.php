<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\Iva;

class IvaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testIvaValidation() {

      $iva = new Iva();

      $iva->valor = '';
      $this->assertFalse($iva->validate(['valor']));

      $iva->valor = '30';
      $this->assertFalse($iva->validate(['valor']));

      $iva->valor = '23';
      $this->assertTrue($iva->validate(['valor']));

      $iva->label = '';
      $this->assertFalse($iva->validate(['label']));

      $iva->label = 'Etiquetaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
      $this->assertFalse($iva->validate(['label']));

      $iva->label = 'Etiqueta Valida';
      $this->assertTrue($iva->validate(['label']));

    }

    public function testIvaFailedSave() {
        $iva = new Iva();

        $iva->valor = '';
        $iva->label = '';
        $this->assertFalse($iva->validate());
        $this->assertFalse($iva->save()); 
    }

    public function testIvaSuccessSave() {
      $iva = new Iva();

      $iva->valor = '16';
      $iva->label = 'Teste';
      $this->assertTrue($iva->validate());
      $this->assertTrue($iva->save());      
    }
}
