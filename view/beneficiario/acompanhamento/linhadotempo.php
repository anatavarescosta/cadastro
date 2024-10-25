<?php
	require_once "config.php";
	$protocolo 	= $_SESSION["protocolo"];
	$carteira  	= $_SESSION['carteira'];
	$codunimed 	= $_SESSION["codunimed"];
	$tipo		= $_SESSION["tipo"];
	$msgNaoEncontrado = '';

	global $linkBloco;
	$linkBloco = "";

	require_once(ABSPATH."/model/banco.php");
	$dados = new Banco(); 

	function blocoEvento($posEvento,$tituloBloco,$subTitulo){
		global $linkBloco;
		$linkBloco = ($posEvento == 'eventoAtual') ? $linkBloco : '' ;
		return	"<div class='col-md-9 $posEvento'>
					<h4 class='mb-0 txtBold'>$tituloBloco</h4>
					<p class='m-0'>
						$subTitulo 
					</p>
					$linkBloco
				</div>";
	}

	function iconeBloco($posEvento,$icone){
		return 	"<div class='col-md-3 d-none d-sm-block'>
					<span class='align-bottom material-symbols-outlined $posEvento'>
						$icone
					</span>
				</div>";
	}	
?>
<div class="row mb-4">
	<div class="col-md-12 titulo-linha titulo-linha">
		<h4>Linha do tempo</h4>
	</div>
	<div class="col-md-12 mb-4">
		<div class="mt-2"><span class="pEtapa">&nbsp</span> Próxima etapa.</div>
		<div class="mt-2"><span class="eAtual">&nbsp</span> Etapa atual.</div>
		<div class="mt-2"><span class="eProce">&nbsp</span> Etapa já processada.</div>
	</div>
	<div class="timeline">
	<?php 
		$cancelado = $dados->VerificaCanceladoStatus($protocolo);
		if ($cancelado == 1){
	?>
			<div class="conteudoEventoAtual right">
				<div class="eventoSolicitacao text-white">
					<div class="row">
						<?php
								echo blocoEvento('eventoAtual','Cancelado',"Processo cancelado: <b> $protocolo </b>");
								echo iconeBloco('iconeAtual','breaking_news_alt_1');
						?>						
<!--
						<div class="col-md-3 d-none d-sm-block">
							<span class=" align-bottom material-symbols-outlined iconeAtual">
								print
							</span>
						</div>

						<div class="col-md-9 eventoAtual">
							<h4 class="mb-0 txtBold">Cancelado</h4>
							<p class="m-0">
								Processo cancelado</a>
							</p>
						</div>
-->
					</div>
				</div>
			</div>
	<?php 
		} else { 
			$existe = $dados->ProcessoSolicitacaoEtapas($protocolo,$carteira,$codunimed);
			if ($existe > 0){

				//impressao
				$ordens = "5";
				$totals = $dados->ProcessoEtapas($protocolo,$ordens);
				if ($totals > 0){
					
					$revalidacao = $dados->ProcessoEtapasTotalRevalidacao($protocolo);
					
					if ($revalidacao == 0){
					
						$totalfinalizado = $dados->ProcessoFinalizadoGuia($protocolo);						
						if ($totalfinalizado > 0){
							$etapas = $dados->ProcessoEtapasFinal($protocolo);
							if ($etapas == "PA"){ 
								$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para visualizar a orientação.</a>";
							} else {
								$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para imprimir o processo.</a>";
							}
						}else{ 
							$totaetapas = $dados->ProcessoTotalEtapasFinal($protocolo);	
							if ($totaetapas > 0){		
								$etapas = $dados->ProcessoEtapasFinal($protocolo);
								if (($etapas == "OC") or ($etapas == "OA")){ 
									$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para visualizar a orientação.</a>";
								} else if ($etapas == "N"){
									$anexos = $dados->ProcessoFinalizadoAnexos($protocolo);
									if(($anexos == "N") || ($anexos == "A")){
										$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para visualizar a orientação.</a>";
									} else {
										$linkBloco = "<h5 class='mb-0 txtBold'>Em breve estaremos disponibilizando a orientação.</h5>";
									}
								} else if ($etapas == "PA"){ 
									$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para visualizar a orientação.</a>";
								} else {
									$linkBloco = "<a href='#!' onclick=MostrarPopoupObs('$protocolo','$etapas');>Clique aqui para imprimir o processo.</a>";
								}
							}
						}
					}
				} 

				for ($i=5; $i >= 1 ; $i--) { 
					$totals = $dados->ProcessoEtapas($protocolo,$i);
					if($totals > 0){
						$itemLinha[] = $i;
					}
				}
				
				$btn_cancelar = ((sizeof($itemLinha) == 1) && ($itemLinha[0] == 1)) ? true : false ;

				$i = 0;
				$lado = ($i == 0) ? 'right' : 'left' ;
				foreach ($itemLinha as $chave => $valor) {
					$posicao = array_search($valor,$itemLinha);	
					if (($posicao == 0) && ($valor == '5')){
						$posEvento[$i] = ["eventoAtual","iconeAtual","conteudoEvento",$lado];
					} elseif (($posicao == 0) && ($valor < '5')) {
						array_unshift($itemLinha,$valor+1);
						$posEvento[] = ['evento',"icone","conteudo",$lado];
						array_unshift($posEvento,["eventoSeguinte","iconeSeguinte","conteudoEventoSeguinte",$lado]);
						array_pop($posEvento);
						$lado = ($lado == 'right') ? 'left' : 'right' ;
						$posEvento[1] = ["eventoAtual","iconeAtual","conteudoEventoAtual",$lado];
						$i++;
					} else {
						$posEvento[$i] = ["eventoFinalizado","iconeFinalizado","conteudoEvento",$lado];
					}
					$i++;
					$lado = ($lado == 'right') ? 'left' : 'right' ;
				}

				foreach ($itemLinha as $key => $value) {
					$classLinhaTempo = $posEvento[$key][2] .' '. $posEvento[$key][3];
					switch ($value) {
						case '1':
							?>
								<div class="<?php echo $classLinhaTempo; ?> ">
									<div class="eventoSolicitacao">
										<div class="row">
											<?php
												//$msg = ($btn_cancelar) ? "Abertura do processo de número:<b> $protocolo </b> <br> <button type='button' onclick='CancelarProtocolo($protocolo);' id='btn_cancelar' class='btn btn-danger mt-2'>Cancelar</button>" : "Abertura do processo de número:<b> $protocolo </b>" ;
												$msg = ($btn_cancelar) ? "Abertura do processo de número:<b> $protocolo </b> <br> <button type='button' data-bs-toggle='modal' data-bs-target='#ConfirmaCancelar' id='btn_cancelar' class='btn btn-danger mt-2'>Cancelar</button>" : "Abertura do processo de número:<b> $protocolo </b>" ;
												if ($posEvento[$key][3] == 'right') {
													echo blocoEvento($posEvento[$key][0],'Solicitado',$msg);
													echo iconeBloco($posEvento[$key][1],'lab_profile');
												} else {
													echo iconeBloco($posEvento[$key][1],'lab_profile');
													echo blocoEvento($posEvento[$key][0],'Solicitado',$msg);
												}
											?>
										</div>								
									</div>
								</div>						
							<?php
							break;
						case '2':
							?>
								<div class="<?php echo $classLinhaTempo; ?>">
									<div class="eventoSolicitacao">
										<div class="row">											
											<?php 
												$revalidacao = $dados->ProcessoEtapasTotalRevalidacao($protocolo);
												if ($revalidacao > 0){
													$msgBloco = "Processo em revalidação.";
												} else {
													$msgBloco = "em análise administrativa.";
												}

												if ($posEvento[$key][3] == 'right') {
													echo blocoEvento($posEvento[$key][0],'Em Análise',$msgBloco);
													echo iconeBloco($posEvento[$key][1],'format_list_numbered');
												} else {
													echo iconeBloco($posEvento[$key][1],'format_list_numbered');
													echo blocoEvento($posEvento[$key][0],'Em Análise',$msgBloco);
												}
											?>													
										</div>							
									</div>
								</div>						
							<?php
							break;
						case '3':
							?>
								<div class="<?php echo $classLinhaTempo; ?>">
									<div class="eventoSolicitacao">
										<div class="row">
											<?php
												if ($posEvento[$key][3] == 'right') {
													echo blocoEvento($posEvento[$key][0],'Em Auditoria','Processo em análise técnica.');
													echo iconeBloco($posEvento[$key][1],'find_in_page');
												} else {
													echo iconeBloco($posEvento[$key][1],'find_in_page');
													echo blocoEvento($posEvento[$key][0],'Em Auditoria','Processo em análise técnica.');
												}											
											?>											
										</div>							
									</div>
								</div>						
							<?php
							break;
						case '4':
							?>
								<div class="<?php echo $classLinhaTempo; ?>">
									<div class="eventoSolicitacao">
										<div class="row">
											<?php 
												$totaldocumentos = $dados->ProcessoTotalDocumentacao($protocolo);
												$contanexos = 0;
												if ($totaldocumentos > 0){
													$arraydocumentos = $dados->ProcessoDocumentacao($protocolo);
													
													foreach ($arraydocumentos as $iddocumentos){	
														$totalitensdocumentos = $dados->ProcessoTotalItensDocumentacao($protocolo,$iddocumentos["codanexoscomplemetar"]);
														if ($totalitensdocumentos > 0){
															$contanexos = $contanexos + 1;	
														}				
													}
												}
											?>	
											<?php
												if ($totaldocumentos != $contanexos){
													if($posEvento[$key][0] == "eventoFinalizado"){
														$msgBloco = "Documentação complementar pendente";
													} else {
														$msgBloco = "
																		<form action='".HOME_URI."/beneficiario/complementar' method='POST'>
																			<input type='hidden' name='protocolo' id='protocolo' value='$protocolo' />
																			<button class='linkDocCom'>Documentação complementar pendente.</button>
																		</form>
																	";														
													}
												} else { 
													$msgBloco = "Processo em auditoria.";
												}
												
												if ($posEvento[$key][3] == 'right') {
													echo blocoEvento($posEvento[$key][0],'Em Execução',$msgBloco);
													echo iconeBloco($posEvento[$key][1],'order_play');
												} else {
													echo iconeBloco($posEvento[$key][1],'order_play');
													echo blocoEvento($posEvento[$key][0],'Em Execução',$msgBloco);
												}											
											?>
										</div>							
									</div>
								</div>						
							<?php
							break;
						case '5':
								$revalidacao = $dados->ProcessoEtapasTotalRevalidacao($protocolo);
								if ($revalidacao == 0){
							?>
									<div class="<?php   if(($key == 0) && ($posEvento[$key][0] == "eventoAtual")){
															echo "conteudoEventoAtual "; 
														} else {
															echo "conteudoEventoSeguinte ";
														}
														echo $posEvento[$key][3];
												?>">
										<div class="eventoSolicitacao">
											<div class="row">
												<?php 
													$etapas = $dados->ProcessoEtapasFinal($protocolo);
													
													$evento = $posEvento[$key][0];
													$titEvento = "Finalizado";
													$msgEvento = "Detalhamento...";

													if ($posEvento[$key][3] == 'right') {
														echo blocoEvento($posEvento[$key][0],$titEvento,$msgEvento);
														echo iconeBloco($posEvento[$key][1],'inventory');
													} else {
														echo iconeBloco($posEvento[$key][1],'inventory');
														echo blocoEvento($posEvento[$key][0],$titEvento,$msgEvento);
													}											
												?>													
											</div>							
										</div>
									</div>						
							<?php
								}
							break;
						
						default:
							echo "Protocolo não encontrado";
							break;
					}
				}	
			} else {
				$msgNaoEncontrado = "<p><b>Não encontramos o protocolo, verifique se preencheu corretamente.</b></p>";
			}
		}
	?>
	</div>
	<?php echo ($msgNaoEncontrado != '') ? $msgNaoEncontrado : ''; ?>
</div>	
