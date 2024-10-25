<?php
require_once "../../../config.php";
session_start();
$protocolo	= $_REQUEST["protocolo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$existe = $dados->ProcessoSolicitacaoEtapas($protocolo,$_SESSION['carteira'],$_SESSION['codunimed']);
if ($existe > 0){
	$verifica = $dados->VerificaStatus($protocolo);
	//$verifica = 0;
	if ($verifica == 0){
		$msg = "<b>Esse protocolo não pode ser cancelado, o mesmo encontra-se em tratativa.</b>";
		$tipoAlerta = "alerta-atencao";
	}else{
		$cancelado = $dados->VerificaCanceladoStatus($protocolo);
		if ($cancelado == 1){	
			$msg = "<b>Protocolo já está cancelado.</b>";
			$tipoAlerta = "alerta-atencao";
		}else{
			$verifica = $dados->CancelarProtocolo($protocolo);
			if($verifica == 1){
				$msg = "<b>Protocolo cancelado com sucesso.</b>";
				$tipoAlerta = "alerta-informativo";
			}else{
				$msg = "<b>Algo deu errado</b><br>Entre em contato com call center 3413-8400!";	
				$tipoAlerta = "alerta-atencao";
			}
		}
	}
}else{
	$msg = "<b>Protocolo não encontrado.</b>";
	$tipoAlerta = "alerta-informativo";
}
echo "<div class='alert $tipoAlerta' role='alert'>
		<p class='m-0'>
		<b>Prezado Cliente</b>,<br>
		$msg
		</p>
	 </div>";
?>