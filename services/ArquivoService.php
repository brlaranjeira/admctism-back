<?php


namespace services;


class ArquivoService
{

	public static function newFileName() {
		$updir = $GLOBALS['UPLOADSDIR'];
		do {
			$fname = time();
		} while (file_exists("$updir$fname"));
		return "$updir$fname";
	}

	public static function create($location,$originalName,$persist=true) {

		require __DIR__ . '/../bootstrap.php';
		$em = \Utils::getEntityManager();
		$arq = new \entities\Arquivo();
		$arq->setContentHash( hash_file('sha256',$location) );
		$extension = strrchr($originalName,'.');

		$arq->setOriginalName( substr(substr($originalName,0,strlen($originalName)-strlen($extension)),0,50-strlen($extension)) . $extension);
		$arquivoIdentico = $em->getRepository('\entities\Arquivo')->findOneBy(['contentHash'=>$arq->getContentHash()]);
		if (isset($arquivoIdentico)) {
			$arq->setName( $arquivoIdentico->getName() );
		} else {
			$name = \Utils::newFileName();
			$moveOk = move_uploaded_file($location,$name);
			if (!$moveOk) {
				throw new \Exception('err');
			}
			//pega o que tem depois da ultima barra (i.e., soh o nome do arquivo)
			$arq->setName( substr(strrchr($name,'/'),1) );
		}
		if ($persist) {
			$em->persist($arq);
			$em->flush();
		}
		return $arq;
	}

}