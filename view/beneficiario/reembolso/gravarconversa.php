<?php 
require_once "../../../config.php";

$protocolo		 = $_REQUEST["protocolo"];
$observacao      = str_replace("'","",$_REQUEST["obs"]);
$codusuario		 = 0; 	
$codetapa        = $_REQUEST["codreembolsoxetapas"];
$data        	 = date('Y-m-d H:i:s');
$status			 = 1;
$mostrar		 = 'S';

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].":81".'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

if ($dados->getInsertConversaReembolso($codetapa,$codusuario,$observacao,$data,$status,$mostrar) == 1){
	echo 1;
}else{
	echo 0;
}

header("Location:".ABSPATH."/view/beneficiario/acompanharreembolso");
?>
