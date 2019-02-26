<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 21/02/19
 * Time: 15:05
 */

require __DIR__ . "/../../bootstrap.php";
$user = Usuario::getFromJWT($_POST['jwt']);

$compra = $entity_manager->find('\entities\Compra', $_POST['compra']);
if ($compra->getUsuario() == $user->getUid()) {
    try {
        $orcamento = new \entities\Orcamento();
        $entity_manager->persist($orcamento);
        $orcamento->setCompra($compra);
        $orcamento->setValor($_POST['valor']);
        $arquivo = \entities\Arquivo::create($_FILES['arq']['tmp_name'], $_FILES['arq']['name'],false);
        $orcamento->setArquivo($arquivo);
        $entity_manager->flush();
        echo json_encode([
            'success' => true,
            'message' => 'Orçamento adicionado!',
            'orcamento' => $orcamento->asJSON()
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