<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 21/02/19
 * Time: 15:05
 */

require __DIR__ . "/../../bootstrap.php";
$user = \services\UsuarioService::getFromJWT($_POST['jwt']);
$compraId = $_POST['compra'];
$compra = \services\CompraService::getById($compraId);
$valor = $_POST['valor'];
$arqLocation = $_FILES['arq']['tmp_name'];
$arqName = $_FILES['arq']['name'];

if ($compra->getUsuario()->getId() == $user->getId()) {
    try {
        $orcamento = \services\CompraService::addOrcamento($compraId,$valor,$arqLocation,$arqName);
        echo json_encode([ 'success' => true, 'message' => 'Orçamento adicionado!', 'orcamento' => $orcamento->asJSON() ]);
    } catch (Throwable $t) {
        echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
        echo $t->getTraceAsString();
    }
} else {
    echo json_encode([ 'success' => false, 'message' => 'Você não tem permissão para excluir esta compra' ]);
}