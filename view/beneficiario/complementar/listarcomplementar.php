<?php 
require_once "../../../config.php";
$protocolo 	= $_REQUEST["protocolo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$dadoscomplementar = $dados->getMostrarTodosProtocolosComplementar($protocolo);
if(!is_null($dadoscomplementar)){
?>
	<div class="row mb-4">
		<div class="col-md-12 mb-4 titulo-linha">
			<h4>Detalhamento do protocolo</h4>
		</div>
		<div class="col-md-12 bloco">
			<div class="row">
				<div class="col-md-12">
					<span><b>Protocolo:</b> <?php echo $protocolo?></span><br>
					<span><b>Data do registro: </b><?php echo $dadoscomplementar[3]?></span><br>
					<span><b>Etapa:</b> Aguardando Documentação</span><br>
				</div>
			</div>
		</div>
		<!--
		<div class="col-md-12 mt-2">
			<div class="row">
				<div class="col-md-12">
					<span><b>OBSERVAÇÃO:</b></span><br>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vehicula pellentesque mauris, ut tincidunt turpis sagittis sed. Curabitur sollicitudin urna non eros tincidunt, in tempor metus convallis. Ut eros velit, vestibulum iaculis nunc non, bibendum lacinia augue. Suspendisse vulputate nulla et sapien mollis interdum.</span>
				</div>
			</div>
		</div>        
		-->
		<div class="col-md-12 mt-4">
			<div class="row">
				<div class="col-md-12">
					<span><b>Anexo:</b></span><br>
					<!--button type="button" id="anxComp" class="btn btn-primario mt-2">Ver anexos enviados</button-->                  
				</div>
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="titulo-linha">
									<th class="txtBold">Documento:</th>
									<th class="txtBold">Status:</th>
									<th class="txtBold text-end">Anexar:</th>
								</tr>
							</thead>
							<?php 
							$arraycomplementar = $dados->getListarTodosProtocolosAnexosComplementar($protocolo);
							foreach ($arraycomplementar as $complementar){ 
								
								$arrayanexoscomplementar = $dados->getListarAnexosComplementar($complementar["codcomplementar"]);

								if(!is_null($arrayanexoscomplementar)){
									foreach ($arrayanexoscomplementar as $anexoscomplementar){ 
										$totalanexoscomplementar = $dados->getLstarTotalAnexosComplementar($anexoscomplementar["codanexoscomplemetar"]);
									?>						
									<tbody>
										<tr>
											<td><?php echo $anexoscomplementar["descricao"]?></td>
											<?php if($totalanexoscomplementar > 0){ ?>
											<td>Recebido</td>
											<?php }else{ ?>
												<?php if ($anexoscomplementar["status"] == 1){ ?>
													<td>Pendente</td>
												<?php }else{ ?>
													<td>Cancelado</td>
												<?php } ?>	
											<?php } ?>
											<?php if($totalanexoscomplementar > 0){ ?>
											<td class="text-end">
												<span class=" align-bottom material-symbols-outlined" title="Arquivo já enviado">
													file_download_done
												</span>
											</td>
											<?php }else{ ?>
												<?php if ($anexoscomplementar["status"] == 1){ ?>
													<td class="text-end">
														<a href="#" onclick="AbriAnexosComplementar('<?php echo $anexoscomplementar['codanexoscomplemetar']?>');">
															<span id="envAnx" class=" align-bottom material-symbols-outlined" title="Selecionar o arquivo para envio">
																upload_file
															</span>
														</a>
													</td>
												<?php }else{ ?>
													<td class="text-end">
														<span class=" align-bottom material-symbols-outlined" title="Cancelado">
															close
														</span>
													</td>
												<?php } ?>	
											<?php } ?>
											
										</tr>
										<!--tr class="verdeb-txt">
											<td>Laudo técnico</td>
											<td>Recebido</td>
											<td class="text-end">
												<span class=" align-bottom material-symbols-outlined">
													file_download_done
												</span>
											</td>
										</tr-->                                
									</tbody>
									<?php 
									} 
								}
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div> 
	</div>
<?php
} else {
?>
	<div>
		<p> No momento, não existem pendências para este protocolo! </p>
	</div>
<?php
}
?>