<?php
	require_once "config.php";
	$protBenefi 	= $_SESSION["protocolo"];
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
		$protocoloBeneficiario = $dados->ConsultaProtocoloBeneficiario($protBenefi);
		$totalRegistros = sizeof($protocoloBeneficiario);
		if ($totalRegistros > 0){
			$i = 0;
			$lado = ($i == 0) ? 'right' : 'left' ;
			
			$fimRegistro = $totalRegistros - 1;
			$protocoloBeneficiario = array_reverse($protocoloBeneficiario);
			foreach ($protocoloBeneficiario as $key => $value) {
				$atual = ($value["flag"] == "1") ? true : false ;
				switch ($key) {
					case '0':

						$posEvento[] = ($atual) ? ["eventoAtual","iconeAtual","conteudoEventoAtual",$lado] : ["eventoFinalizado","iconeFinalizado","conteudoEvento",$lado] ;
						//$msgArray[]	 = ($value["codstatus"] == '6') ? ["Finalizado","O protocolo foi finalizado."] : ["Em análise administrativa","Processo em análise administrativa"] ;

						if($value["codstatus"] == '6'){
							if($value["unidade"] == '62'){
								$msgArray[] = ["Finalizado","Protocolo finalizado durante atendimento"];
							} else {
								$msgArray[] = ["Finalizado","O protocolo foi finalizado."];
							}
						} else {
							$msgArray[] = ["Em análise administrativa","Processo em análise administrativa"];
						}

						?>
							<div class="<?php echo ($atual) ? "conteudoEventoAtual $lado" : "conteudoEvento $lado";  ?>">
								<div class="eventoSolicitacao">
									<div class="row">
										<?php 
											if($value["unidade"] != '62'){
												global $linkBloco;
												$linkBloco = "<a href='#!' onclick=MostrarPopoupObsBeneficiario('".$value['codhistoricoprotocolo']."','".$value['codprotocoloansxetapas']."');>Clique aqui para visualizar a orientação.</a>";
											}

											if ($lado == 'right') {
												echo blocoEvento($posEvento[0][0],$msgArray[0][0],$msgArray[0][1]);
												echo iconeBloco($posEvento[0][1],'find_in_page');
											} else {
												echo iconeBloco($posEvento[0][1],'find_in_page');
												echo blocoEvento($posEvento[0][0],$msgArray[0][0],$msgArray[0][1]);
											}											
										?>													
									</div>							
								</div>
							</div>						
						<?php
						$msgArray = [];
						$posEvento = [];
						$lado = ($lado == 'right') ? 'left' : 'right' ;

						break;
					
					case '1':
						$posEvento[] = ($atual) ? ["eventoAtual","iconeAtual","conteudoEventoAtual",$lado] : ["eventoFinalizado","iconeFinalizado","conteudoEvento",$lado] ;
						$msgArray[]	 = ($value["codstatus"] == '6') ? ["Fim","Processo finalizado."] : ["Em análise administrativa","Processo em análise administrativa"] ;
						?>
							<div class="<?php echo ($atual) ? "conteudoEventoAtual $lado" : "conteudoEvento $lado";  ?>">
								<div class="eventoSolicitacao">
									<div class="row">
										<?php
											if ($lado == 'right') {
												echo blocoEvento($posEvento[0][0],$msgArray[0][0],$msgArray[0][1]);
												echo iconeBloco($posEvento[0][1],'find_in_page');
											} else {
												echo iconeBloco($posEvento[0][1],'find_in_page');
												echo blocoEvento($posEvento[0][0],$msgArray[0][0],$msgArray[0][1]);
											}											
										?>											
									</div>							
								</div>
							</div>						
						<?php
						$msgArray = [];
						$posEvento = [];
						$lado = ($lado == 'right') ? 'left' : 'right' ;
						break;
					
					case $fimRegistro:

						$posEvento[] = ($atual) ? ["eventoAtual","iconeAtual","conteudoEventoAtual",$lado] : ["eventoFinalizado","iconeFinalizado","conteudoEvento",$lado] ;
						?>
							<div class="<?php echo ($atual) ? "conteudoEventoAtual $lado" : "conteudoEvento $lado";  ?> ">
								<div class="eventoSolicitacao">
									<div class="row">
										<?php
											$msg = "Abertura do processo de número:<b> ".$value["protocolo"]." </b>" ;
											if ($lado == 'right') {
												echo blocoEvento($posEvento[0][0],'Solicitado',$msg);
												echo iconeBloco($posEvento[0][1],'lab_profile');
											} else {
												echo iconeBloco($posEvento[0][1],'lab_profile');
												echo blocoEvento($posEvento[0][0],'Solicitado',$msg);
											}
										?>
									</div>								
								</div>
							</div>						
						<?php
						$msg = "";
						$posEvento = [];
						$lado = ($lado == 'right') ? 'left' : 'right' ;

						break;
					
					default:
						//echo "Protocolo não encontrado";
						break;
				}
			}	
		} else {
			$msgNaoEncontrado = "<p><b>Desculpe, não encontramos o seu protocolo, caso o mesmo seja de antes do dia 15/05/2024 entre em contato com o nosso CallCenter no número 3413.8400.</b></p>";
		}
	?>
	</div>
	<?php echo ($msgNaoEncontrado != '') ? $msgNaoEncontrado : ''; ?>
</div>	
