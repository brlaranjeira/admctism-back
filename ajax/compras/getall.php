<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 31/01/19
 * Time: 08:09
 */

require __DIR__ . "/../../bootstrap.php";
$user = \services\UsuarioService::getFromJWT($_GET['jwt']);
if (true) {
	$compras = \services\CompraService::getAll();
	$data = '[' . implode(',', array_map(function ($t) { return $t->asJSON(); }, $compras)) . ']';
	echo json_encode(["success"=>true,"compras"=>$data,"jwt"=> \services\UsuarioService::getJWT($user->getId())]);
} else {
	echo json_encode(["success"=>"false"]);

}