<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 17:41
 */

require __DIR__ . '/../../bootstrap.php';

$user = \services\UsuarioService::getFromJWT($_REQUEST['jwt']);
if (!isset($user)) {
	http_response_code(401);
}
try {
	$parent = isset($_REQUEST['parent']) ? $_REQUEST['parent'] : null;

	$grupos = \services\GrupoService::getGruposByParent($parent);
	$gruposJson = array_map(function ($g) {
		return $g->asJSON();
	}, $grupos);
	echo json_encode(array("grupos" => $gruposJson, "jwt" => \services\UsuarioService::getJWT($user->getId())));
} catch (Throwable $t) {
	echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
}