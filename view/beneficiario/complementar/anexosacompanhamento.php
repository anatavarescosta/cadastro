<?php
require_once "config.php";
require_once "class/AcessaFtp.php";
//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

$protocolo  = $_REQUEST["codprotocolo"];
$carteira 	= $_REQUEST["carteira"];
$id_usuario	= 0;

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

if ($_FILES["arquivo"]["name"] == ""){
	header('Location: '.HOME_URI.'/beneficiario/solicitacao/a/sp7');
	die;
}					

$nome_arquivo      = $_FILES["arquivo"]["name"];
$extensao_arquivo  = substr($nome_arquivo,strpos($nome_arquivo,'.')+1,strlen($nome_arquivo)-strpos($nome_arquivo,'.'));				
$tamanho_arquivo   = $_FILES["arquivo"]["size"];						
$extensoes		   = array('jpg', 'png', 'jpeg','pdf');
$extensao 		   = substr(strtolower($nome_arquivo), -3);
if($extensao == 'peg'){
	$extensao 		   = substr(strtolower($nome_arquivo), -4);
}
$tam_maximo 	   = 1024 * 1024 * 2; // 2Mb
$origem  			= $_FILES["arquivo"]["tmp_name"];

$nome_arquivo = "C-".$protocolo."-".date('dmY').date('His').".".$extensao;
$caminho           = "files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo."/".$nome_arquivo;

$dataregistro 	= $dados->getDataSolicitacao($protocolo);
$arraydata 		= explode("/",$dataregistro);

$ftp = new AcessaFtp;

if (is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".$arraydata[2]))){
	if (is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]))){
		if (is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]))){
			if (is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo))){
			}else{		
				$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo);
			}								
		}else{
			$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]);
			$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo);
		}
	}else{
		$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]);
		$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]);
		$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo);
	}
}else{
	$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]);
	$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]);
	$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]);
	$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo);
}

$destino = "/autorizador/solicitacao/files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo."/".$nome_arquivo;
$destinoBanco = "files/anexosano".$arraydata[2]."/anexosmes".$arraydata[1]."/anexosdia".$arraydata[0]."/anexos".$protocolo."/".$nome_arquivo;
$ftp->gravar($destino, $origem, $protocolo);

//verifica se existe protocolo na pasta
if (is_array($ftp->verificar($destino))){
	$codanexoscomplemetar = $_REQUEST["codanexoscomplemetar"];
	$rsanexos  = $dados->getInserirAnexosComplementares('C',$nome_arquivo,$carteira,$protocolo,$codanexoscomplemetar,$extensao,$tamanho_arquivo,$destinoBanco,date("Y-m-d H:i:s"),$id_usuario);
	$ftp->fechaFtp();
}						

header("Location: ".HOME_URI."/beneficiario/complementar/a/dc1");
die;
?>