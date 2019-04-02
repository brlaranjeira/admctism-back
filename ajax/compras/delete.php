<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 13/02/19
 * Time: 11:44
 */

require __DIR__ . "/../../bootstrap.php";

$user = \services\UsuarioService::getFromJWT($_POST['jwt']);
$compraId = $_POST['compra'];
$compra = \services\CompraService::getById($compraId);
if ($user->getId() == $compra->getUsuario()->getId()) {
    try {
    	\services\CompraService::remove($compraId);
        echo json_encode([ 'success' => true, 'message' => 'Compra excluída!' ]);
    } catch (Throwable $t) {
        echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
    }
} else {
    echo json_encode([ 'success' => false, 'message' => 'Você não tem permissão para excluir esta compra' ]);
}
