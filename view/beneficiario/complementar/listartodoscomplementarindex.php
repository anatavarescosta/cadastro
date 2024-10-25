<?php 
require_once "../../../config.php";
$codunimed 	= $_REQUEST["codunimed"];
$carteira	= $_REQUEST["carteira"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

?>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="titulo-linha">
							<th class="txtBold">Protocolo</th>
							<!--<th class="txtBold">Observação</th>-->
							<th class="txtBold">Data Registro</th>
							<th class="txtBold text-end">Opção</th>
						</tr>
					</thead>					
					<tbody>
						<?php $arraycomplementar = $dados->getListarTodosProtocolosComplementarIndex($codunimed,$carteira);
							  if(!is_null($arraycomplementar)){
							  	foreach ($arraycomplementar as $complementar){ ?>											
						<tr>
							<td><?php echo $complementar["codprotocolo"]?></td>
							<!--<td><?php //echo $complementar["nome"] ?></td>-->
							<td><?php echo $complementar["dataregistro"]?></td>
							<td class="text-end">
								<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="SelecionaProtocoloComplementar('<?php echo $complementar['codprotocolo']?>')" title="Vizualizar o protocolo">
									upload_file
								</span>
							</td>
						</tr>
						<?php 	}
							  }
						?>
					</tbody>					
				</table>
			</div>
		</div>
	</div>
</div> 
