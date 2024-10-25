<?php 
require_once "../../../config.php";

$protocolo	= $_REQUEST["protocolo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].":81".'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 
?>
<div class="col-md-12 conteudoChat">

	<div class="alert alerta-atencao" role="alert">
		<p class="m-0">
			Atendimento das 07 às 17.<br>
			<b>As respostas não são em tempo real.</b>
		</p>
	</div>

<?php
	$total0 = $dados->getTotalConversaPrestadorReembolso($protocolo);
	if ($total0 > 0){
		$i = 0;	
		$rt0 = $dados->getConversaBeneficiarioReembolso($protocolo);
		foreach ($rt0 as $rs0){ 	
			$i++;			
			if($rs0["observacao"] != ""){

				$tratarData = explode(" ",$rs0["data"]);
				$data = explode("-",$tratarData[0]);
				$hora = $tratarData[1];

				$novaDataHora = $data[2]."-".$data[1]."-".$data[0]." ".$hora;

				$totalusuario = $dados->getTotalNomeUsuario($rs0["codusuario"]);
				
				if ($totalusuario > 0){	?>
					<div class="row mb-3">
						<div class="col-md-9 chatOperadora p-2">
							<div class="msgChat p-2 col align-self-end">
								<?php echo $rs0["observacao"];?>
							</div>
						</div>
						<div class="col-md-3"></div>
						<span class="dtChat"><?php echo $novaDataHora;?></span>
					</div>												
				<?php }else{ ?>
					<div class="row mb-3 text-end">
						<div class="col-md-3"></div>
						<div class="col-md-9 chatBeneficiario p-2">
							<div class="msgChat p-2 col align-self-end">
								<?php echo $rs0["observacao"];?>
							</div>
						</div>
						<span class="dtChat"><?php echo $novaDataHora;?></span>
					</div>							
				<?php }	
			}
		}
			
	} else { ?>
		<div class="p-4">Nenhuma informação encontrada</div>
	<?php  } ?>
</div>
