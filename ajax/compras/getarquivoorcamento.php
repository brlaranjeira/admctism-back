<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 13/02/19
 * Time: 15:26
 */

require __DIR__ . "/../../bootstrap.php";

$orcamento = $entity_manager->find('\entities\Orcamento', $_REQUEST['id']);
$arquivo = $orcamento->getArquivo();
if (!isset($arquivo)) {
	die("Error: File not found");
}
$fileLocation = $GLOBALS['UPLOADSDIR'] . $arquivo->getName();
if (file_exists($fileLocation)) {
    header("Cache-Control: public");
    header("Content-type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($fileLocation));
    header("Content-Disposition: attachment; filename=".$arquivo->getOriginalName());
    readfile($fileLocation);
    die();
} else {
    die("Error: File not found.");
}