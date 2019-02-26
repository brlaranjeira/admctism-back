<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 19/02/19
 * Time: 16:16
 */

require __DIR__ . "/../../bootstrap.php";
$user = Usuario::getFromJWT($_POST['jwt']);

$orcamento = $entity_manager->find('\entities\Orcamento', $_POST['orcamento']);
if ($orcamento->getCompra()->getUsuario() == $user->getUid()) {
    try {
        $entity_manager->remove($orcamento);
        $entity_manager->flush();
        echo json_encode([
            'success' => true,
            'message' => 'Orcamento excluído!'
        ]);
    } catch ( Throwable $t ) {
        echo json_encode([
            "success" => false,
            "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável',
            "errormessage" => $t->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Você não tem permissão para excluir este orcamento'
    ]);
}