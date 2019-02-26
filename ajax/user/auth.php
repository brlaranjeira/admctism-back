<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 31/01/19
 * Time: 10:54
 */

require '../../bootstrap.php';

$user = $_POST['usr'];
$password = $_POST['pw'];;
if (Usuario::auth($user,$password)) {
    $jwt = (new Usuario($user,true))->getJWT();
    $ret = ["success"=>true,"jwt"=>$jwt];
} else {
    $ret = ["success"=>false];
}
echo json_encode($ret);