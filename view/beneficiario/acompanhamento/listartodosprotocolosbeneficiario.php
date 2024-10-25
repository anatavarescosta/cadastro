<?php 
require_once "config.php";
$codunimed 	= $_SESSION["codunimed"];
$carteira	= $_SESSION["carteira"];

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
						<?php $arrayprotocolos = $dados->getListarTodosProtocolosBeneficiarioIndex($codunimed,$carteira);?>
						<?php if (is_null($arrayprotocolos)) { ?>
						<tr>
							<td colspan="3"> Não existe Protocolo gerado.</td>
						</tr>
						<?php 
							} else {
								foreach ($arrayprotocolos as $protocolo){ ?>					
						<tr>
							<td><?php echo $protocolo["protocolo"]?></td>
							<td><?php echo $protocolo["dataregistro"]?></td>
							<td class="text-end">
								<span id="envAnx" class=" align-bottom material-symbols-outlined" onclick="SelecionaProtocoloBeneficiario('<?php echo $protocolo['id']?>','<?php echo $protocolo['protocolo']?>')" title="Vizualizar o andamento do protocolo">
								description
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
