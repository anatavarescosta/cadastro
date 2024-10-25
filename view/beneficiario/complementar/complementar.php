<?php
get_header();
?>
<div class="container">
	<form method="post" id="formCompBene"  name="formCompBene" class="mb-4" enctype="multipart/form-data">
		<input type="hidden" name="testeComp" id="testeComp">
		<input type="hidden" name="testeCompTodos" id="testeCompTodos">
		<input type="hidden" name="testeCompTodosAnexos" id="testeCompTodosAnexos">
		<input type="hidden" name="compCodUsuario" id="compCodUsuario" value="<?php echo $_SESSION["codunimed"]?>">
		<input type="hidden" name="compCartUsuario" id="compCartUsuario" value="<?php echo $_SESSION["carteira"]?>">

		<div class="row mb-2">
			<h3>Documentos complementares</h3>
			<div class="col-md-12 bloco mt-4">
				<div class="row">
					<div class="col-10 col-md-6">
						<input type="text" class="mb-0" name="protocolo" id="protocolo" placeholder="Protocolo" title="Protocolo do atendimento" onkeypress="return somenteNumeros(event)">
					</div>				
					<div class="col-2 col-md-1 ps-0 pt-2">
						<i id="btn_listaracomp"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">				
				<i id="btn_comp"></i><button type="button" class="btn btn-primary" onclick="BuscarDocumentacaoComplementar(document.formCompBene.protocolo.value);">Buscar</button>
				<i id="btn_comp"></i><button type="button" class="btn btn-secondary" onclick="MostrarListaComplementar('<?php echo $_SESSION['codunimed']?>','<?php echo $_SESSION['carteira']?>');">Listar todos</button>
			</div>
		</div>	
	</form>
	<i id="btn_anexosacomp"></i>
	<div id="acompanhar"></div>

    <div class="modal fade" id="exbAnexo" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header alerta-informativo" role="alert">
                    <h5 class="modal-title" id="ModalLabel"> ANEXOS </h5>
                </div>
                <div class="modal-body">
                   <div id="mensagem"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="exbTodosAnexo" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alerta-informativo" role="alert">
                    <h5 class="modal-title" id="ModalLabel"> ANEXOS </h5>
                </div>
                <div class="modal-body">
                   <div id="mensagemcomplementar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>	
	<div class="modal fade" id="envAnexo" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<form method="post" action="complementar/anexosacompanhamento" id="formCompAnexos" onsubmit="return GarvarAnexosComplementar();"  name="formCompAnexos" class="mb-4" enctype="multipart/form-data">
		<input type="hidden" name="codanexoscomplemetar" id="codanexoscomplemetar" value="">
		<input type="hidden" name="codprotocolo" id="codprotocolo" value="">
		<input type="hidden" name="codunimed" id="codunimed" value="<?php echo $_SESSION["codunimed"]; ?>">
		<input type="hidden" name="carteira" id="carteira" value="<?php echo $_SESSION["carteira"]; ?>">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">				
					<div class="modal-header alerta-informativo" role="alert">
						<h5 class="modal-title" id="ModalLabel"> ENVIAR ANEXO </h5>
					</div>
					<div class="modal-body">
						<label for="" class="mt-0">Selecione o arquivo.</label>
						<input type="file" name="arquivo" id="arquivo" value="" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">enviar</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					</div>
			</div>
		</div>
		</form>
	</div>	
</div>
<?php
if(isset($_POST['protocolo'])){
	?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById('protocolo').value = '<?php echo $_POST['protocolo']; ?>';
			BuscarDocumentacaoComplementar('<?php echo $_POST['protocolo']; ?>');
		});		
	</script>
	<?php
}
get_footer();
?>