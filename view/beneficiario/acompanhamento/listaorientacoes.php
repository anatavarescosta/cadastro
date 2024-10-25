<?php 
require_once "config.php";
require_once "class/AcessaFtp.php";

$protocolo 	= $_SESSION["protocolo"];
$status		= $_SESSION["status"];

require_once(ABSPATH."/model/banco.php");
$dados = new Banco();
?>
<h5 class="mb-4">
	<?php
		switch ($status) {
			case 'OC':
				echo 'Orientação ao cliente!';
				break;
			case 'OA':
				echo 'Orientação ao cliente/Prestador!';
				break;
			case 'PA':
				echo 'Parcialmente Autorizado!';
				break;
			case 'A':				
			case 'L':
				echo 'Liberado!';
				break;
			case 'N':
				echo 'Não Liberado!';
				break;			
			default:
				# code...
				break;
		}
	?>
</h5>
<?php
if (($status == "OC") || ($status == "OA")){ 
	$totalorientacao = $dados->getTotalMostrarOrientacao($protocolo,$status);
	if ($totalorientacao > 0){
		$rsorientacao = $dados->getMostrarOrientacao($protocolo,$status);
	?>
		<div class="table-responsive">
			<table class="table table-hover" id="listaProtocolo">
				<thead>
					<tr class="titulo-linha">
						<th class="txtBold">Observação</th>
						<th class="txtBold">Registro</th>
					</tr>
				</thead>					
				<tbody>
					<?php foreach ($rsorientacao as $orientacao){ ?>
						<tr>
							<td><?php echo utf8_encode($orientacao["observacao"]);?></td>
							<td><?php echo utf8_encode($orientacao["dataregistro"]);?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>

				</tfoot>
			</table>
		</div>
	<?php 
	} else { 
		echo "Registro não encontrado."; 
	} 
} else if (($status == "L") || ($status == "PA")){ 
	
	$ftp = new AcessaFtp;

	$rsanexos = $dados->getMostrarGuia($protocolo,$status);
	if(is_null($rsanexos)){
		echo "Entre em contato com nosso callcenter no 81 3413.8400 para maiores informações.";
		die;
	}
	$cont = 0;
	foreach ($rsanexos as $anexos){
		
		$arquivo = $anexos["nome"];	
		if ($anexos["caminho"] == ""){
			$path = "files/anexos".$protocolo."/".$arquivo;
		}else{
			$path = $anexos["caminho"];
		}

		if($ftp->buscar($path,$anexos["formato"],$protocolo,$cont)){
			$linkDownload[$cont] = HOME_URI."/includes/downloads/beneficiario/anx-$protocolo-$cont.".$anexos['formato'];
		} else {
			echo "Desculpe, tente novamente ou entre em contato com nosso callcente.";
			die;
		}

		$tipo = ($anexos["tipo"] == "PA") ? "Impressão da Orientação" : "Impressão da Guia" ;						

		$cont++;
	}

	for ($i=0; $i < $cont; $i++) { 
	?>
		<a href="<?php echo $linkDownload[$i]; ?>" target="_blank"><?php echo $i." - ".$tipo; ?></a><br>
	<?php
		if($i == $cont-1){
			$ftp->fechaFtp();
		}
	}	 
	?>
	<!--<a href="#" onclick="MostrarPopoupGuia('<?php //echo $anexos['codanexos']; ?>','<?php //echo $anexos['nome']; ?>','<?php //echo $protocolo; ?>','<?php //echo $linkDownload[$cont]; ?>','<?php //echo $extensao?>');"><?php //echo $cont." - ".$tipo;?></a><br>-->
<?php
} else if (($status == "A") || ($status == "N")){ 
	
	$ftp = new AcessaFtp;

	$rsanexos = $dados->getMostrarAnexoNegado($protocolo,$status);
	$cont = 0;
	foreach ($rsanexos as $anexos){
		
		$arquivo = $anexos["nome"];	
		if ($anexos["caminho"] == ""){
			$path = "files/anexos".$protocolo."/".$arquivo;
		}else{
			$path = $anexos["caminho"];
		}

		if($ftp->buscar($path,$anexos["formato"],$protocolo,$cont)){
			$linkDownload[$cont] = HOME_URI."/includes/downloads/beneficiario/anx-$protocolo-$cont.".$anexos['formato'];
		} else {
			echo "Desculpe, tente novamente ou entre em contato com nosso callcente.";
			die;
		}

		$cont++;
	}

	for ($i=0; $i < $cont; $i++) { 
	?>
		<a href="<?php echo $linkDownload[$i]; ?>" target="_blank"><?php echo $i." - Impressão da Orientação" ?></a><br>
	<?php
		if($i == $cont-1){
			$ftp->fechaFtp();
		}
	}
}
?>