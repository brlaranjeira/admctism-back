<?php

require __DIR__ . '/../../bootstrap.php';

$grupoId = $_REQUEST['grupo'];
$usersId = $_REQUEST['users'];

try {
	foreach ($usersId as $userId) {
		\services\UsuarioService::changeGrupo($userId,$grupoId);
	}
	$grupo = \services\GrupoService::getById($grupoId);
	$message = sizeof($usersId) > 1 ? 'Usuários movidos ' : 'Usuário movido ';
	$message .= 'para o grupo ' . $grupo->getNome();
	echo json_encode(['success'=>true,'message'=>$message]);
} catch (Throwable $t) {
	echo json_encode(['success'=>false,'message'=>'Houve um erro durante o processo','errorMessage'=>$t->getMessage()]);
}

