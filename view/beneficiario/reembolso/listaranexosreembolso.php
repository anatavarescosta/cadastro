<?php 
require_once "../../../config.php";

$codprotocoloans = $_REQUEST["protocolo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 
?>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<?php
				$totalanexosreembolsocoditem = $dados->getTotalAnexosReembolso($codprotocoloans);
				
				if ($totalanexosreembolsocoditem > 0){

					$arrayanexosreembolsocoditem = $dados->getAnexosReembolso($codprotocoloans);
					foreach ($arrayanexosreembolsocoditem as $rsanexosreembolsocoditem){ 					
					?>
						<span> Item <?php echo $rsanexosreembolsocoditem["coditem"];?> :</span>
					<?php	
						$totalanexosreembolso = $dados->getTotalItensAnexosReembolso($codprotocoloans,$rsanexosreembolsocoditem["coditem"]);				
						$rtanexosreembolso = $dados->getItensAnexosReembolso($codprotocoloans,$rsanexosreembolsocoditem["coditem"]);
						$cont = 0;
					?>
							<div class="row">
								<div colspan="12">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Tipo</th>
													<th>Classificação</th>
													<th>Nome</th>
													<th>Usuário</th>
													<th>Data Registro</th>
												</tr>
											</thead>	
											<tbody>															
					<?php
						foreach ($rtanexosreembolso as $rsanexosreembolso){ 
						
							$cont = $cont + 1;	
							if ($rsanexosreembolso["tipo"] == "A"){
								$tipo = "Anexos";
							}else{
								$tipo = "Documentos predefinidos";	
							}
							
							$totalusuario = $dados->getTotalNomeUsuario($rsanexosreembolso["codusuario"]);
							if ($totalusuario > 0){
								$usuario = $dados->getNomeUsuario($rsanexosreembolso["codusuario"]);
							}else{
								$usuario = "Beneficiário";
							}
							
							if ($rsanexosreembolso["codclassificacaodocumento"] == ""){
								$classificacao = "";
							}else{
								$nomeclassificacaodocumento = $dados->getClassificacaoReembolso($rsanexosreembolso["codclassificacaodocumento"]);
								$classificacao = $nomeclassificacaodocumento;
							}
						    if ($rsanexosreembolso["status"] == 0){ 
					?>
								<tr>
									<td id="cor1<?php echo $cont?>"><?php echo $cont." - ".$tipo;?></td>
									<td id="cor2<?php echo $cont?>"><?php echo $classificacao;?></td>
									<td id="cor3<?php echo $cont?>"><?php echo $rsanexosreembolso["nome"];?></td>
									<td id="cor4<?php echo $cont?>"><?php echo $usuario;?></td>			
									<td id="cor5<?php echo $cont?>"><?php echo $rsanexosreembolso["dataregistro"];?></td>			
								</tr>
					<?php   } else{ ?>
								<tr>
									<td><a class="linkAnexos" href="#" id="cor<?php echo $rsanexosreembolso["coditem"]?>1<?php echo $cont?>" onclick="MostrarPopoupReembolso('<?php echo base64_encode($rsanexosreembolso["codanexosxreembolso"]); ?>','<?php echo $rsanexosreembolso["nome"]?>','<?php echo base64_encode($codprotocoloans); ?>','<?php echo base64_encode($rsanexosreembolso["caminho"]); ?>','<?php echo base64_encode($rsanexosreembolso["extensao"])?>','<?php echo $rsanexosreembolso["coditem"]?>','<?php echo base64_encode($cont)?>','<?php echo $totalanexosreembolso?>');"><?php echo $cont." - ".$tipo;?></a></td>
									<td><a class="linkAnexos" href="#" id="cor<?php echo $rsanexosreembolso["coditem"]?>2<?php echo $cont?>" onclick="MostrarPopoupReembolso('<?php echo base64_encode($rsanexosreembolso["codanexosxreembolso"]); ?>','<?php echo base64_encode($rsanexosreembolso["nome"]); ?>','<?php echo base64_encode($codprotocoloans); ?>','<?php echo base64_encode($rsanexosreembolso["caminho"]); ?>','<?php echo base64_encode($rsanexosreembolso["extensao"])?>','<?php echo $rsanexosreembolso["coditem"]?>','<?php echo base64_encode($cont)?>','<?php echo $totalanexosreembolso?>');"><?php echo $classificacao;?></a></td>
									<td><a class="linkAnexos" href="#" id="cor<?php echo $rsanexosreembolso["coditem"]?>3<?php echo $cont?>" onclick="MostrarPopoupReembolso('<?php echo base64_encode($rsanexosreembolso["codanexosxreembolso"]); ?>','<?php echo base64_encode($rsanexosreembolso["nome"]); ?>','<?php echo base64_encode($codprotocoloans); ?>','<?php echo base64_encode($rsanexosreembolso["caminho"]); ?>','<?php echo base64_encode($rsanexosreembolso["extensao"])?>','<?php echo $rsanexosreembolso["coditem"]?>','<?php echo base64_encode($cont)?>','<?php echo $totalanexosreembolso?>');"><?php echo $rsanexosreembolso["nome"];?></a></td>
									<td><a class="linkAnexos" href="#" id="cor<?php echo $rsanexosreembolso["coditem"]?>4<?php echo $cont?>" onclick="MostrarPopoupReembolso('<?php echo base64_encode($rsanexosreembolso["codanexosxreembolso"]); ?>','<?php echo base64_encode($rsanexosreembolso["nome"]); ?>','<?php echo base64_encode($codprotocoloans); ?>','<?php echo base64_encode($rsanexosreembolso["caminho"]); ?>','<?php echo base64_encode($rsanexosreembolso["extensao"])?>','<?php echo $rsanexosreembolso["coditem"]?>','<?php echo base64_encode($cont)?>','<?php echo $totalanexosreembolso?>');"><?php echo $usuario;?></a></td>			
									<td><a class="linkAnexos" href="#" id="cor<?php echo $rsanexosreembolso["coditem"]?>5<?php echo $cont?>" onclick="MostrarPopoupReembolso('<?php echo base64_encode($rsanexosreembolso["codanexosxreembolso"]); ?>','<?php echo base64_encode($rsanexosreembolso["nome"]); ?>','<?php echo base64_encode($codprotocoloans); ?>','<?php echo base64_encode($rsanexosreembolso["caminho"]); ?>','<?php echo base64_encode($rsanexosreembolso["extensao"])?>','<?php echo $rsanexosreembolso["coditem"]?>','<?php echo base64_encode($cont)?>','<?php echo $totalanexosreembolso?>');"><?php echo $rsanexosreembolso["dataregistro"];?></a></td>														
								</tr>
					<?php   }
						}
					?>
										</table>
									</div>
								</div>
							</div>					
					<?php 
					} 
				} else {
			?>
				<tr>
					<td colspan="7">N&atilde;o existe essa informa&ccedil;&atilde;o</td>
				</tr>
			<?php 
				}
			?>

		</div>
	</div>
</div> 
