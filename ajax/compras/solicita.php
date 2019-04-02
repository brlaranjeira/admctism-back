<?

require __DIR__ . "/../../bootstrap.php";
$user = \services\UsuarioService::getFromJWT($_POST['jwt']);
if (false) {
    echo json_encode(["success"=>"false"]);
} else {
    try {
    	$arqLocation = $_FILES['arq_outroarq']['tmp_name'];
    	$arqName = $_FILES['arq_outroarq']['name'];
        $tipoDespesaId = $_POST['tipoDespesa'];
        $tipoSolicitacaoId = $_POST['tipoSolicitacao'];
        $estadoCompraId = 1;
		$despesaRecorrente = $_POST['despesaRecorrente'];
		$codProjeto = (strtolower($_POST['vincProj']) === 's' && isset($_POST['codProj'])) ? $_POST['codProj'] : null;
        $justificativa = $_POST['justificativa'];
        $obs = isset($_POST['obs']) ? $_POST['obs'] : null;

        $numItems = sizeof($_POST['descricao']);
        $orcamentoIdx = 0;
        for ($i = 0; $i < $numItems; $i++) {

        	$descricao = $_POST['descricao'][$i];
        	$quantidade = $_POST['quantidade'][$i];
        	$modelo = isset($_POST['modelo'][$i]) ? $_POST['modelo'][$i] : null;
        	try {
				$compra = \services\CompraService::save($user->getId(), $despesaRecorrente, $codProjeto, $justificativa, $obs, $tipoDespesaId, $tipoSolicitacaoId, $estadoCompraId, $descricao, $quantidade, $modelo, $arqLocation, $arqName);
			} catch ( \Throwable $t ) {
				foreach ($t->getTrace() as $tr) {
					var_dump($tr);
				}
				echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
			}
            $orcamentoLimit = $orcamentoIdx + $_POST['numOrcamentos'][$i];
            for (; $orcamentoIdx < $orcamentoLimit; $orcamentoIdx++) {
            	$vlOrcamento = $_POST['vl_orcamento'][$orcamentoIdx];
            	$orcArqLocation = $_FILES['arq_orcamento']['tmp_name'][$orcamentoIdx];
            	$orcArqName = $_FILES['arq_orcamento']['name'][$orcamentoIdx];
				\services\CompraService::addOrcamento($compra->getId(),$vlOrcamento,$orcArqLocation,$orcArqName);

                /*$orcamento = new \entities\Orcamento;
                $orcamentoArq = \services\ArquivoService::create($vlArqLocation, $vlArqName,false);
                $orcamento->setArquivo($orcamentoArq);
                $orcamento->setCompra($compra);
                $orcamento->setValor($_POST['vl_orcamento'][$orcamentoIdx]);
                $compra->addOrcamento($orcamento);*/
            }
        }
        echo json_encode(["success" => true, "message" => 'Compra solicitada!' ]);
    } catch ( \Throwable $t ) {
		foreach ($t->getTrace() as $tr) {
			var_dump($tr);
    	}
        echo json_encode([ "success" => false, "message" => 'Houve um erro na solicitação. Favor contatar o setor responsável', "errormessage" => $t->getMessage() ]);
    }
}