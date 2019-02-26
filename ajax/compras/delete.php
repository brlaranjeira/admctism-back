<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 13/02/19
 * Time: 11:44
 */

require __DIR__ . "/../../bootstrap.php";
$user = Usuario::getFromJWT($_POST['jwt']);


$compra = $entity_manager->find('\entities\Compra', $_POST['compra']);

if ($user->getUid() == $compra->getUsuario()) {
    try {
        $entity_manager->remove($compra);
        $entity_manager->flush();
        echo json_encode([
            'success' => true,
            'message' => 'Compra excluída!'
        ]);
    } catch (Throwable $t) {
        echo json_encode([
            "success" => false,
            "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável',
            "errormessage" => $t->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Você não tem permissão para excluir esta compra'
    ]);
}
