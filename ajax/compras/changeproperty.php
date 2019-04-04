<?php

require __DIR__ . '/../../bootstrap.php';

$user = \services\UsuarioService::getFromJWT($_REQUEST['jwt']);
$compra = \services\CompraService::getById($_REQUEST['compra']);
if ($compra->getUsuario()->getId() === $user->getId() || $user->getGrupo()->getAdmin()) {
	try {
		\services\CompraService::changeProperty($_REQUEST['compra'],$_REQUEST['prop'],$_REQUEST['value']);
		echo json_encode(['success'=>true,'message'=>'Compra editada.']);
	}catch ( Throwable $t) {
		echo json_encode(["success" => false, "message" => 'Houve um erro no processo. Favor contatar o setor responsável', "errormessage" => $t->getMessage()]);
	}
} else {
	echo json_encode(['success' => false, 'message' => 'Você não tem permissão para editar esta compra']);
}