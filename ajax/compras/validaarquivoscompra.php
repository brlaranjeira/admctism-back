<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 11/03/19
 * Time: 13:14
 */

require __DIR__ . "/../../bootstrap.php";

$user = Usuario::getFromJWT($_GET['jwt']);
$compra = $entity_manager->find('\entities\Compra', $_REQUEST['id']);
$valid = true;
$orcamentos = $compra->getOrcamentos();
foreach ($orcamentos as $orcamento) {
	$arquivo = $orcamento->getArquivo();
	$path = $GLOBALS['UPLOADSDIR'] . $arquivo->getName();
	$fileOk = file_exists( $path )  && filesize($path) > 0;
	if (!$fileOk) {
		$valid = false;
		break;
	}
}
echo json_encode(['valid'=>$valid,'jwt'=>$user->getJWT()]);