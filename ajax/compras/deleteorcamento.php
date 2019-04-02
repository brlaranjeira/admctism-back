<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 19/02/19
 * Time: 16:16
 */

require __DIR__ . "/../../bootstrap.php";
$user = \services\UsuarioService::getFromJWT($_POST['jwt']);

$orcamentoId = $_REQUEST['orcamento'];
$orcamento = \services\OrcamentoService::getById($orcamentoId);
if ($orcamento->getCompra()->getUsuario()->getId() == $user->getId()) {
	try {
		\services\OrcamentoService::removeOrcamento($orcamentoId);
		echo json_encode(['success' => true, 'message' => 'Orcamento excluído!']);
	} catch (Throwable $t) {
		echo json_encode(["success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage()]);
	}
} else {
	echo json_encode(['success' => false, 'message' => 'Você não tem permissão para excluir este orcamento']);
}