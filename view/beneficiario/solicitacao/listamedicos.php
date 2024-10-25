<?php
require_once "../../../config.php";

$codigo = $_REQUEST["codigo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$totalmedico = $dados->getTotalCodigoMedicos($codigo);
if ($totalmedico > 0){
	$vmedico = $dados->getCodigoMedicos($codigo);
	$medico = $vmedico[0]."#".$vmedico[1];
}else{
	$medico = "0#0";
}

echo $medico;
?>