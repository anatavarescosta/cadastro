<?php
require_once "../../../config.php";

$codtratamento = $_REQUEST["codigo"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 
 
$totaln = $dados->getTotalDocdTipoTratamento($codtratamento);
if ($totaln > 0){
$i=0;
?>
<div class="row mt-2">
	<?php 
	$arraydocumentos = $dados->getDocdTipoTratamento($codtratamento);
	foreach ($arraydocumentos as $documentos){	 
	?>
	<?php $i = $i + 1;?>
		
			<div class="col-md-12 p-2" title="Adicionar arquivo">
				<?php if (isset($documentos["link"])){?>					
						<?php if ($documentos["link"] != 1){ //nao mostra o formulario tea?>
							<?php if ($documentos["link"] == 2){ //para oftalmo?>		
								<span class="align-bottom material-symbols-outlined cursorPointer text-success" onclick="AnexosAut('<?php echo $i?>','<?php echo $documentos['codpredefinidos'] ?>');">
								note_add
								</span>	
								<span><a href="documentosfluxoregulatorio/<?php echo $documentos["nome"] ?>" download><?php echo " | ".$i." - ".ucwords(strtolower(utf8_encode($documentos["nome"])));?></a></span>
							<?php }else{ ?>	
								<span class="align-bottom material-symbols-outlined cursorPointer text-success" onclick="AnexosAut('<?php echo $i?>','<?php echo $documentos['codpredefinidos'] ?>');">
									note_add
								</span>	
								<span><a href="<?php echo HOME_URI.'/includes/downloads/'. $documentos["link"];?>" target="_blank"><?php echo " | ".$i." - ".ucwords(strtolower(utf8_encode($documentos["nome"])));?></a></span>
							<?php } ?>
						<?php } ?>					
				<?php }else{ ?>			
					<span class="align-bottom material-symbols-outlined cursorPointer text-success" onclick="AnexosAut('<?php echo $i?>','<?php echo $documentos['codpredefinidos'] ?>');">
						note_add
					</span>	
					<span><?php echo " | ".$i." - ".ucwords(strtolower(utf8_encode($documentos["nome"])));?></span>
				<?php } ?>				
			</div>
			<div class="col-md-12">
				<div class="row" id="nomestodosarquivos<?php echo $i?>">
					<div class="col-md-6">
						<div id="todosarquivos<?php echo $i?>"></div>
					</div>
				</div>	
				<input type="hidden" name="totaldocumento<?php echo $i?>" value="0">	
			</div>
		
	<?php }?>
	<input type="hidden" name="totalitensdocumento" value="<?php echo $i?>">		
</div>
<?php }else{ ?>
	<input type="hidden" name="totalitensdocumento" value="0">
<?php } ?>