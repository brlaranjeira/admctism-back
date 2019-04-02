<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 21/03/19
 * Time: 14:53
 */

require __DIR__ . '/../../bootstrap.php';

$user = \services\UsuarioService::getFromJWT($_REQUEST['jwt']);
try {
	$usuarios = \services\UsuarioService::getAll();
	$usuariosJson = array_map(function ($u) {
		return $u->asJSON();
	}, $usuarios);
	echo json_encode(array("usuarios" => $usuariosJson, "jwt" => \services\UsuarioService::getJWT($user->getId())));
} catch (Throwable $t) {
	echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
}