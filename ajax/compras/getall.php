<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 31/01/19
 * Time: 08:09
 */

require __DIR__ . "/../../bootstrap.php";
$user = Usuario::getFromJWT($_GET['jwt']);

if (!$user->hasGroup(['10001','10002','10004'])) {
    echo json_encode(["success"=>"false"]);
} else {
    $compras = $entity_manager->getRepository('entities\Compra')->findAll();
    $data = '[' . implode(',', array_map(function ($t) { return $t->asJSON(); }, $compras)) . ']';
    echo json_encode(["success"=>true,"compras"=>$data,"jwt"=>$user->getJWT()]);
}