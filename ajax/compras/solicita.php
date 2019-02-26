<?

require __DIR__ . "/../../bootstrap.php";
$user = Usuario::getFromJWT($_POST['jwt']);
if (!$user->hasGroup(['10001','10002','10004'])) {
    echo json_encode(["success"=>"false"]);
} else {
    try {
        $arq = isset($_FILES['arq_outroarq'])
            ? \entities\Arquivo::create($_FILES['arq_outroarq']['tmp_name'], $_FILES['arq_outroarq']['name'])
            : null;
        $tipoDespesa = $entity_manager->find('\entities\TipoDespesa', $_POST['tipoDespesa']);
        $tipoSolicitacao = $entity_manager->find('\entities\TipoSolicitacao', $_POST['tipoSolicitacao']);
        $estadoCompra = $entity_manager->find('\entities\EstadoCompra', 1);

        $numItems = sizeof($_POST['descricao']);
        $orcamentoIdx = 0;
        for ($i = 0; $i < $numItems; $i++) {
            $compra = new \entities\Compra;
            $entity_manager->persist($compra);

            $compra->setDespesaRecorrente($_POST['despesaRecorrente']);
            $compra->setCodProjeto((strtolower($_POST['vincProj']) === 's' && isset($_POST['codProj'])) ? $_POST['codProj'] : null);
            $compra->setJustificativa($_POST['justificativa']);
            $compra->setObs(isset($_POST['obs']) ? $_POST['obs'] : null);
            $compra->setUsuario($user->getUid());
            $compra->setArquivo($arq);

            $compra->setTipoDespesa($tipoDespesa);
            $compra->setTipoSolicitacao($tipoSolicitacao);
            $compra->setEstado($estadoCompra);

            $compra->setDescricao($_POST['descricao'][$i]);
            $compra->setQuantidade($_POST['quantidade'][$i]);
            $compra->setModelo(isset($_POST['modelo'][$i]) ? $_POST['modelo'][$i] : null);

            $orcamentoLimit = $orcamentoIdx + $_POST['numOrcamentos'][$i];
            for (; $orcamentoIdx < $orcamentoLimit; $orcamentoIdx++) {
                $orcamento = new \entities\Orcamento;
                $orcamentoArq = \entities\Arquivo::create($_FILES['arq_orcamento']['tmp_name'][$orcamentoIdx], $_FILES['arq_orcamento']['name'][$orcamentoIdx],false);
                $orcamento->setArquivo($orcamentoArq);
                $orcamento->setCompra($compra);
                $orcamento->setValor($_POST['vl_orcamento'][$orcamentoIdx]);
                $compra->addOrcamento($orcamento);
            }
        }
        $x = $compra->getOrcamentos();
        $entity_manager->flush();
        echo json_encode([
            "success" => true,
            "message" => 'Compra solicitada!'
        ]);
    } catch ( \Throwable $t ) {
        echo json_encode([
            "success" => false,
            "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável',
            "errormessage" => $t->getMessage()
        ]);
    }
}