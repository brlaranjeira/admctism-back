<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 31/01/19
 * Time: 08:09
 */

require __DIR__ . "/../../bootstrap.php";

$user = \services\UsuarioService::getFromJWT($_GET['jwt']);
if (false) {
    echo json_encode(["success"=>"false"]);
} else {
    $tipos = \services\CompraService::getTiposDespesa();
	$tipos = array_map(function ($t) { return $t->asJSON(); }, $tipos);
    $data = '[' . implode(',',$tipos) . ']';
    $jwt = \services\UsuarioService::getJWT($user->getId());
    $ret = ["jwt"=>$jwt,"tipos"=>$data,"success"=>true];
    echo json_encode($ret);
}