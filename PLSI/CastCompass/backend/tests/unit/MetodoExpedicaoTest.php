<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\MetodoExpedicao;

class MetodoExpedicaoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testMetodoExVaidation() {
      
      $metodoExpedicao = new MetodoExpedicao();

      $metodoExpedicao->nome = '';
      $this->assertFalse($metodoExpedicao->validate(['nome']));

      $metodoExpedicao->nome = 'Nomeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
      $this->assertFalse($metodoExpedicao->validate(['nome']));
    }

    public function testMetodoExFailedSave() {
      $metodoExpedicao = new MetodoExpedicao();

      $metodoExpedicao->nome = '';
      $this->assertFalse($metodoExpedicao->validate());
      $this->assertFalse($metodoExpedicao->save());
    }

    public function testMetodoExSave() {
      $metodoExpedicao = new MetodoExpedicao();

      $metodoExpedicao->nome = 'Nome Valido';
      $this->assertTrue($metodoExpedicao->validate());
      $this->assertTrue($metodoExpedicao->save());
    }
}
