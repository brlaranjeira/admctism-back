<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 17:41
 */

require_once __DIR__ . '/../../bootstrap.php';

$user = Usuario::getFromJWT($_REQUEST['jwt']);
if (!isset($user)) {
	http_response_code(401);
}
$parent = isset($_REQUEST['parent']) ? $_REQUEST['parent'] : null;

$grupos = \services\GrupoService::getGruposByParent( $parent );
$gruposJson = array_map( function ($g) {
	return $g->asJSON();
}, $grupos );
echo json_encode(array("grupos"=>$gruposJson,"jwt"=>$user->getJWT()));
