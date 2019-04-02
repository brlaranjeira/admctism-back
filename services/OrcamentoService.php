<?php


namespace services;


class OrcamentoService
{

	public static function getById($id) {
		require __DIR__ . "/../bootstrap.php";
		if (!isset($id)) {
			return null;
		}
		return \Utils::getEntityManager()->find('\entities\Orcamento',$id);
	}

	public static function removeOrcamento($orcamentoId) {
		require __DIR__ . "/../bootstrap.php";
		$em = \Utils::getEntityManager();
		$orcamento = self::getById($orcamentoId);
		$em->remove($orcamento);
		$em->flush();
	}

}