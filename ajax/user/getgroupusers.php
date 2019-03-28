<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 21/03/19
 * Time: 14:53
 */

require_once __DIR__ . '/../../bootstrap.php';
$user = \Usuario::getFromJWT($_REQUEST['jwt']);
$grupo = \services\GrupoService::getById($_REQUEST['grupo']);
$usuarios = \services\GrupoService::getGroupUsers($grupo);
$usuariosJson = array_map(function ($u) {
	return $u->asJSON();
}, $usuarios);
echo json_encode(array("usuarios"=>$usuariosJson,"jwt"=>$user->getJWT()));