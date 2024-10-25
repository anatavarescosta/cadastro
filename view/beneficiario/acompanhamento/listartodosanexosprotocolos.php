<?php 
require_once "config.php";
require_once "class/AcessaFtp.php";

$protocolo 	= $_SESSION["protocolo"];

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

?>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover" id="listaProtocolo">
					<thead>
						<tr class="titulo-linha">
							<th class="txtBold">Arquivo</th>
							<th class="txtBold">Data Registro</th>
						</tr>
					</thead>					
					<tbody>
					<?php 
					
					$rsanexos = $dados->getMostrarAnexoGeral($protocolo);
					if(is_null($rsanexos)){
						echo "<b>Arquivo não encontrado</b><br>Entre em contato com nosso callcenter no 81 3413.8400 para maiores informações.";
						die;
					}
					$cont = 0;
					foreach ($rsanexos as $anexos){

						$ftp = new AcessaFtp;
						
						$arquivo = $anexos["nome"];	
						if ($anexos["caminho"] == ""){
							$path = "files/anexos".$protocolo."/".$arquivo;
						}else{
							$path = $anexos["caminho"];
						}
				
						if($ftp->buscar($path,$anexos["formato"],$protocolo,$cont)){
							$linkDownload[$cont] = "anx-$protocolo-$cont.".$anexos['formato'];
						} else {
							echo "<b>Desculpe,</b><br>Tente novamente ou entre em contato com nosso callcente no 81 3413.8400 para maiores informações.";
							die;
						}
					?>
					<tr>
						<td><a href="#" onclick="MostrarImagemAnexos('<?php echo $linkDownload[$cont]; ?>');"><?php echo $arquivo; ?></a></td>
						<td><?php echo $anexos["dataregistro"]; ?></td>
					</tr>								
					<?php 
						$cont++;
					}	 
					?>
					</tbody>					
				</table>
			</div>
		</div>
	</div>
</div> 
