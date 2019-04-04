<?php

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
final class CompraServiceTest extends TestCase {

	public function testObjectType() {
		$all = \services\CompraService::getAll();
		for ($i = 0; $i < min(10,sizeof($all)); $i++) {
			$one = $all[$i];
			$this->assertInstanceOf(\entities\Compra::class,$one);
			$id = $one->getId();
			$this->assertInstanceOf(\entities\Compra::class, \services\CompraService::getById($id));
		}
	}

	public function testChangeProperty() {
		$compraId = \services\CompraService::getAll()[0]->getId();
		$propNames = [ 'despesaRecorrente', 'despesaRecorrente', 'codProjeto', 'codProjeto', 'codProjeto', 'justificativa', 'justificativa', 'obs', 'obs', 'descricao', 'descricao', 'quantidade', 'quantidade', 'modelo', 'modelo', 'tipoDespesa', 'tipoDespesa', 'tipoDespesa', 'tipoDespesa', 'tipoDespesa', 'tipoDespesa', 'tipoSolicitacao', 'tipoSolicitacao' , 'arquivo', 'dthrCriacao'];
		$validValues = [0, 1, '123', null, '', '', 'Asdsad  asd asd a', '', 'blablabal  a a a a', 'blablabal  a a a a', '', 12, 1, 'asdasd  asda  a aAAd   FF', '', '1', '2', '3', '4', '5', '5', '1', '2', '172', new DateTime()];
		for ($i=0; $i < sizeof($propNames); $i++) {
			$k = $propNames[$i];
			$v = $validValues[$i];
			\services\CompraService::changeProperty($compraId,$k,$v);
			$compra = \services\CompraService::getById($compraId);
			$getter = 'get' . strtoupper(substr($k,0,1)) . substr($k,1);
			$persistedValue = $compra->$getter();
			if (in_array(strtolower($k),['arquivo','estado','tipodespesa','tiposolicitacao'])) {
					$persistedValue = $persistedValue->getId();
			}
			$this->assertEquals($v,$persistedValue);
		}
	}

	public function testChangePropertiesInvalidValues() {
		$compraId = \services\CompraService::getAll()[0]->getId();
		$propNames = ['codProjeto', 'quantidade', 'tipoDespesa', 'tipoDespesa', 'tipoDespesa',  'tipoSolicitacao', 'tipoSolicitacao','tipoSolicitacao','arquivo','dthrCriacao'];
		$invalidValues = ['1234567890123', null, '6', '-1', null, '3', '-1', null, '789798789', new DateTime()];
		for ($i=0; $i < sizeof($propNames); $i++) {
			$k = $propNames[$i];
			$v = $invalidValues[$i];
			$pass = true;
			try {
				\services\CompraService::changeProperty($compraId,$k,$v);
			} catch (Throwable $t) {
				$pass = false;
			}
			$this->assertEquals($pass,false);
		}

	}

}