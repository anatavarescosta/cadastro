<?php
require_once "config.php";
require_once "class/AcessaFtp.php";

$protocolo 		 = $_SESSION["protocolo"];
$idProtHistoricoANS = $_SESSION["idProtHistoricoANS"];

require_once(ABSPATH . "/model/banco.php");
$dados = new Banco();
?>
<h5 class="mb-4"> Orientação ao cliente! </h5>
<?php $rsorientacao = $dados->getOrientacaoFinalProtocoloBeneficiario($protocolo,$idProtHistoricoANS);	?>
<div class="table-responsive">
	<table class="table table-hover" id="listaProtocolo">
		<thead>
			<tr class="titulo-linha">
				<th class="txtBold">Observação</th>
				<th class="txtBold">Registro</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rsorientacao as $orientacao) { ?>
				<tr>
					<td><?php echo $orientacao["observacao"]; ?></td>
					<td><?php echo $orientacao["dataregistro"]; ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>

		</tfoot>
	</table>
</div>