<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 21/03/19
 * Time: 14:53
 */

require_once __DIR__ . '/../../bootstrap.php';

$user = \Usuario::getFromJWT($_REQUEST['jwt']);
$usuarios = \services\UsuarioService::getAll();
$usuariosJson = array_map(function ($u) {
	return $u->asJSON();
}, $usuarios);
echo json_encode(array("usuarios"=>$usuariosJson,"jwt"=>$user->getJWT()));