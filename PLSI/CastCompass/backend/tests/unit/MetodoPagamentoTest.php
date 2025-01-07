<?php


namespace backend\tests\Unit;

use backend\tests\UnitTester;
use common\models\MetodoPagamento;

class MetodoPagamentoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testMetodoPagamentoValidation() {

        $metodoPagamento = new MetodoPagamento();

        $metodoPagamento->nome = '';
        $this->assertFalse($metodoPagamento->validate(['nome']));

        $metodoPagamento->nome = 'Nomeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
        $this->assertFalse($metodoPagamento->validate(['nome']));

        $metodoPagamento->nome = 'Nome Valido';
        $this->assertTrue($metodoPagamento->validate(['nome']));
    }

    public function testMetodoPagamentoFailedSave() {
        $metodoPagamento = new MetodoPagamento();

        $metodoPagamento->nome = '';
        $this->assertFalse($metodoPagamento->validate());
        $this->assertFalse($metodoPagamento->save());
    }

    public function testMetodoPagamentoSave() {
        $metodoPagamento = new MetodoPagamento();

        $metodoPagamento->nome = 'Nome Valido';
        $this->assertTrue($metodoPagamento->validate());
        $this->assertTrue($metodoPagamento->save());
    }
}
