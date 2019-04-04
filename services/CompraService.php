<?php


namespace services;


class CompraService {

	public static function getById($id) {
		require __DIR__ . "/../bootstrap.php";
		if (!isset($id)) {
			return null;
		}
		$compra = \Utils::getEntityManager()->find('\entities\Compra',$id);
		return $compra;
	}

	public static function getAll() {
		require __DIR__ . "/../bootstrap.php";
		$compras = \Utils::getEntityManager()->getRepository('\entities\Compra')
			->findAll();
		return $compras;
	}

	public static function addOrcamento($compraId,$vlOrcamento,$arqLocation,$arqName) {
		require  __DIR__ . '/../bootstrap.php';
		$em = \Utils::getEntityManager();
		$compra = self::getById($compraId);
		$em->persist($compra);
		try {
				$orcamento = new \entities\Orcamento();
				$arquivo = \services\ArquivoService::create($arqLocation, $arqName);
				$orcamento->setCompra($compra);
				$orcamento->setValor($vlOrcamento);
				$orcamento->setArquivo($arquivo);
				$compra->addOrcamento($orcamento);
				$em->flush();
				return $orcamento;
			} catch (\Throwable $t) {
				throw $t;
			}
	}

	public static function remove($compraId) {
		require  __DIR__ . '/../bootstrap.php';
		try {
			$compra = self::getById($compraId);
			$em = \Utils::getEntityManager();
			$em->remove($compra);
			$em->flush();
		} catch (\Throwable $t) {
			throw $t;
		}
	}

	public static function getTiposDespesa() {
		require  __DIR__ . '/../bootstrap.php';
		$tipos = $entity_manager->getRepository('entities\TipoDespesa')->findAll();
		return $tipos;
	}

	public static function getTipoDespesaById($id) {
		require  __DIR__ . '/../bootstrap.php';
		if (!isset($id)) {
			return null;
		}
		return \Utils::getEntityManager()->find('entities\TipoDespesa',$id);
	}

	public static function getTiposSolicitacao() {
		require  __DIR__ . '/../bootstrap.php';
		$tipos = $entity_manager->getRepository('entities\TipoSolicitacao')->findAll();
		return $tipos;
	}

	public static function getTipoSolicitacaoById($id) {
		require  __DIR__ . '/../bootstrap.php';
		if (!isset($id)) {
			return null;
		}
		return \Utils::getEntityManager()->find('entities\TipoSolicitacao',$id);
	}

	public static function getEstadosCompra() {
		require  __DIR__ . '/../bootstrap.php';
		$estados = $entity_manager->getRepository('entities\EstadoCompra')->findAll();
		return $estados;
	}

	public static function getEstadoCompraById($id) {
		require  __DIR__ . '/../bootstrap.php';
		if (!isset($id)) {
			return null;
		}
		return \Utils::getEntityManager()->find('entities\EstadoCompra',$id);
	}

	public static function save($userId, $despesaRecorrente, $codProjeto, $justificativa, $obs, $tipoDespesaId, $tipoSolicitacaoId, $estadoCompraId, $descricao, $quantidade, $modelo, $arqLocation, $arqName) {
		try {
			require __DIR__ . '/../bootstrap.php';
			$em = \Utils::getEntityManager();
			$compra = new \entities\Compra();
			$em->persist($compra);
			$compra->setUsuario(\services\UsuarioService::getById($userId));
			$compra->setDespesaRecorrente($despesaRecorrente);
			$compra->setCodProjeto($codProjeto);
			$compra->setJustificativa($justificativa);
			$compra->setObs($obs);
			$compra->setTipoDespesa(\services\CompraService::getTipoDespesaById($tipoDespesaId));
			$compra->setTipoSolicitacao(\services\CompraService::getTipoSolicitacaoById($tipoSolicitacaoId));
			$compra->setEstado(\services\CompraService::getEstadoCompraById($estadoCompraId));
			$compra->setDescricao($descricao);
			$compra->setQuantidade($quantidade);
			$compra->setModelo($modelo);
			$compra->setArquivo(\services\ArquivoService::create($arqLocation, $arqName, false));
			$em->flush();
			return $compra;
		} catch (\Throwable $t) {
			throw $t;
		}
	}

	public static function changeProperty($compraId, $prop, $value) {
		$compra = self::getById($compraId);
		$setter = 'set' . strtoupper(substr($prop,0,1)) . substr($prop,1);
		\Utils::getEntityManager()->persist($compra);
		switch ($prop) {
			case 'arquivo':
				$value = \services\ArquivoService::getById($value);
				break;
			case 'estado':
				$value = \services\CompraService::getEstadoCompraById($value);
				break;
			case 'tipoDespesa':
				$value = \services\CompraService::getTipoDespesaById($value);
				break;
			case 'tipoSolicitacao':
				$value = \services\CompraService::getTipoSolicitacaoById($value);
				break;
		}
		$compra->$setter($value);
		\Utils::getEntityManager()->flush();
	}

}