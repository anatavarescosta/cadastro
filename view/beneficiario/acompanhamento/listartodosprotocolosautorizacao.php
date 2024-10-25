<?php 
require_once "config.php";
$codunimed 	= $_SESSION["codunimed"];
$carteira	= $_SESSION["carteira"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

?>
<div class="col-md-12 mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover" id="listaProtocoloIndex">
					<thead>
						<tr class="titulo-linha">
							<th class="txtBold">Protocolo</th>
							<th class="txtBold">Data Registro</th>
							<th class="txtBold text-end">Opções</th>
						</tr>
					</thead>					
					<tbody>
						<?php $arrayprotocolos = $dados->getListarTodosProtocolosIndex($codunimed,$carteira);?>
						<?php foreach ($arrayprotocolos as $protocolo){ ?>
						<?php 
							$arraystatus = $dados->getStatusProtocolos($protocolo["status"]);
							
							if ($arraystatus[1] == 1){
								$status = "Solicitado";
							}else if ($arraystatus[1] == 2){
								$status = "Análise Administrtiva";
							}else if ($arraystatus[1] == 3){
								$status = "Análise Técnica";
							}else if ($arraystatus[1] == 4){
								$status = "Auditoria Técnica";
							}else if ($arraystatus[1] == 5){
								$status = $arraystatus[0];	
							}
						
						?>						
						<tr>
							<td><?php echo $protocolo["protocolo"]?></td>
							<td><?php echo $protocolo["dataregistro"]?></td>
							<td class="text-end">
								<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="SelecionaProtocolo('<?php echo $protocolo['protocolo']?>')" title="Vizualizar o andamento do protocolo">
								description
								</span>
								<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="VisualizarAnexosProtocolo('<?php echo $protocolo['protocolo']?>')" title="Vizualizar anexos">
								download
								</span>
							</td>
						</tr>
						<?php } ?>
					</tbody>					
				</table>
			</div>
		</div>
	</div>
</div> 
