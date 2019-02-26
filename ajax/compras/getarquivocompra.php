<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 22/02/19
 * Time: 17:26
 */

require __DIR__ . "/../../bootstrap.php";

$compra = $entity_manager->find('\entities\Compra', $_REQUEST['compra']);
$arquivo = $compra->getArquivo();
if ($arquivo == null) {
    die("Error: File not found.");
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