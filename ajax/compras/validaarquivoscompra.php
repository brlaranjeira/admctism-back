<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 11/03/19
 * Time: 13:14
 */

require __DIR__ . "/../../bootstrap.php";

$user = Usuario::getFromJWT($_GET['jwt']);
$compras = $entity_manager->getRepository('\entities\Compra')->findAll();
$errors = [];
foreach ($compras as $compra) {
	$orcamentos = $compra->getOrcamentos();
	foreach ($orcamentos as $orcamento) {
		$arquivo = $orcamento->getArquivo();
		$path = $GLOBALS['UPLOADSDIR'] . $arquivo->getName();
		$fileOk = file_exists( $path )  && filesize($path) > 0;
		if (!$fileOk) {
			$errors[] = $compra->getId();
			break;
		}
	}

}
$witherror = '[' . implode(',',$errors) . ']';
echo json_encode(['witherror'=>$witherror,'jwt'=>$user->getJWT()]);