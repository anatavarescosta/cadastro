<?php
require_once "../../../config.php";

$crm = $_REQUEST["medico"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$totalmedico = $dados->getTotalCodigoMedicos($codigo);
if ($totalmedico > 0){
	echo "1";
}else{
	echo "0";
}
?>