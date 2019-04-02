<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 31/01/19
 * Time: 10:54
 */

require '../../bootstrap.php';

$userName = $_REQUEST['usr'];
$password = $_REQUEST['pw'];;

try {
	if (\services\UsuarioService::auth($userName,$password)) {
		$user = \services\UsuarioService::getByLogin($userName);
		$jwt = \services\UsuarioService::getJWT($user->getId());
		echo json_encode(["success"=>true,"jwt"=>$jwt]);
	} else {
		echo json_encode(["success"=>false, "message"=>'Login e/ou senha inválidos']);
	}
} catch (Throwable $t) {
	echo json_encode(['success'=>false,'message'=>'Houve um erro durante o processo','errorMessage'=>$t->getMessage()]);
}
