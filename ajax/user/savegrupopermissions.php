<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 20/03/19
 * Time: 15:43
 */

require __DIR__ . '/../../bootstrap.php';

$grupo = \services\GrupoService::getById($_POST['grupo']);
$admin = strtolower($_POST['admin']) === 'true';
$grupo->setAdmin($admin);

try {
	\services\GrupoService::updateGrupo($grupo);
	echo json_encode(['success'=>true,'message'=>'Permissões Salvas']);
} catch (Throwable $t) {
	echo json_encode(['success'=>false,'message'=>'Houve um erro durante o processo','errorMessage'=>$t->getMessage()]);
}

