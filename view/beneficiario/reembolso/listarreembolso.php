<?php 
require_once "../../../config.php";

$codunimed 	= $_REQUEST["codunimed"];
$carteira	= $_REQUEST["carteira"];
$protocolo	= $_REQUEST["protocolo"];
$data1		= $_REQUEST["data1"];
$data2		= $_REQUEST["data2"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

?>
<div class="row mb-4">
  <div class="col-md-12 mb-4 titulo-linha">
	<h4>Listar Reembolso</h4>
  </div>
</div>
<div class="col-md-12 mt-4">
  <div class="row">
	  <div class="col-md-12">
		  <div class="table-responsive">
			  <table class="table table-hover">
				  <thead>
					  <tr class="titulo-linha">
						  <th class="txtBold">Protocolo</th>
						  <th class="txtBold">Carteira</th>
						  <th class="txtBold">Beneficiário</th>
						  <th class="txtBold">Data</th>
						  <th class="txtBold">Status</th>
						  <th class="txtBold">Opção</th>
					  </tr>
				  </thead>
				  <tbody>				  
				  	<?php 
					$totalreembolso = $dados->getTotalTodosProtocolosReembolso($protocolo,$data1,$data2,$codunimed,$carteira);
					if ($totalreembolso > 0){
						$arrayprotocolosreembolso = $dados->getListarTodosProtocolosReembolso($protocolo,$data1,$data2,$codunimed,$carteira);?>
						<?php 
						$cProtAux = [];
						$i = 0;
						foreach ($arrayprotocolosreembolso as $reembolso){ 
							if( !in_array($arrayprotocolosreembolso[$i]["codprotocoloans"], $cProtAux) ){
								$status = $dados->getStatusReembolso($arrayprotocolosreembolso[$i]["status"]);
								
								if ($status[0] != "ED"){
									$nomestatus = "Análise Administrativa";
								}else{
									$nomestatus = $arrayprotocolosreembolso[1];
								}
								?>
								<tr>
									<td><?php echo $arrayprotocolosreembolso[$i]["codprotocoloans"]; ?></td>
									<td><?php echo $arrayprotocolosreembolso[$i]["carteira"]; ?></td>
									<td><?php echo $arrayprotocolosreembolso[$i]["nome"]; ?></td>
									<td><?php echo $arrayprotocolosreembolso[$i]["dataregistro"]; ?></td>
									<td><?php echo $nomestatus ?></td>
									<td>
										<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="MostrarImagemReembolso('<?php echo $arrayprotocolosreembolso[$i]['codprotocoloans']; ?>');" title="Visualizar os documentos anexados">
											photo
										</span>
										<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="MostrarConversaReembolso('<?php echo $arrayprotocolosreembolso[$i]['codprotocoloans']; ?>','<?php echo $arrayprotocolosreembolso[$i]['codreembolsoxetapas']; ?>');" title="Abrir área de chat com o a operadora">
											comment
										</span>
										<!--
										<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="ExibirConversaReembolso('<?php //echo $arrayprotocolosreembolso[0]["codprotocoloans"] ?>','<?php //echo $arrayprotocolosreembolso[0]["codreembolsoxetapas"] ?>');">
											textsms
										</span>
										-->
									</td>
								</tr>
						<?php
							}
							$cProtAux[] = $arrayprotocolosreembolso[$i]["codprotocoloans"];
							$i++;
						}
						?>
					<?php }else{ ?>
					<tr>
					  <td colspan="6">Dados não encontrado</td>
					</tr>
					<?php } ?>
				  </tbody>
			  </table>
		  </div>
	  </div>
  </div>
</div>
