<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 17:41
 */

require_once __DIR__ . '/../../bootstrap.php';

$grupo = new \entities\Grupo();
$nome = $_POST['nome'];
$admin = strtolower($_POST['admin']) === 'true';
$superGrupoId = $_POST['parent'];
$superGrupo = \services\GrupoService::getById($superGrupoId);


try {
	\services\GrupoService::addGrupo($nome, $admin, $superGrupo);
	$message = $superGrupo === null ?
		'Grupo adicionado' :
		'Subgrupo de '. $superGrupo->getNome() . ' adicionado';
	echo json_encode(['success'=>true,'message'=>$message]);
} catch (Throwable $t) {
	echo json_encode(['success'=>false,'message'=>'Houve um erro durante o processo','errorMessage'=>$t->getMessage()]);
}



