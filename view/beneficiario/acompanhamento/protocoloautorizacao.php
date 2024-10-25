<?php
get_header();
$_SESSION['tipo'] = 'autorizacao';
//2812041
?>
<div class="container">
	<form  method="post" id="formBuscProtocolo" name="formBuscProtocolo" class="mb-4" enctype="multipart/form-data">
	<input type="hidden" name="testeAcomp" id="testeAcomp">
	<input type="hidden" name="testeBuscar" id="testeBuscar">
	<input type="hidden" name="codUnimed" id="codUnimed" value="<?php echo $_SESSION["codunimed"]?>">
	<input type="hidden" name="cartUnimed" id="cartUnimed" value="<?php echo $_SESSION["carteira"]?>">

		<div class="row mb-2">
			<h3>Acompanhamento do Protocolo de Autorização</h3>
			<div class="col-md-12 bloco mt-4">
				<div class="row">
					<div class="col-10 col-md-6">
						<input type="text" class="mb-0" name="protocolo" id="protocolo" placeholder="Protocolo - 0000000" title="Protocolo do atendimento" onkeypress="return somenteNumeros(event)">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">				
				<button type="button" class="btn btn-primary" onclick="BuscarProtocolo(document.formBuscProtocolo.protocolo.value);" title="Buscar este protocolo">Buscar</button>
				<button type="button" class="btn btn-secondary" onclick="MostrarListaProtocolo();" title="Buscar todos os protocolos">Listar todos</button>
			</div>
		</div>
	</form>
	<div id="bscprotocoloautorizacao"></div>
	<div id="linhadotempo"></div>
	<div class="modal fade" id="mdCancelar" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header alerta-informativo " role="alert">
					<h5 class="modal-title" id="ModalLabel"> ATENÇÃO </h5>
				</div>
				<div class="modal-body">
					<div id="mensagem"></div>
				</div>
				<div class="modal-footer">
					<button type="button" id="modal-closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdBuscar" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header alerta-informativo " role="alert">
					<h5 class="modal-title" id="ModalLabel"> LISTAR SOLICITAÇÃO </h5>
				</div>
				<div class="modal-body">
					<div id="mensagembuscar"></div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_Closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdOrienta" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header alerta-informativo " role="alert">
					<h5 class="modal-title" id="ModalLabel">DETALHES DA SOLICITAÇÃO</h5>
				</div>
				<div class="modal-body">
					<div id="mensagemorientacao"></div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_Closed" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeArquivos(document.formBuscProtocolo.protocolo.value)">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdAnexos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header alerta-informativo " role="alert">
					<h5 class="modal-title" id="ModalLabel">LISTAR ANEXOS</h5>
				</div>
				<div class="modal-body">
					<div id="mensagemanexos"></div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_Closed" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeArquivos(document.formBuscProtocolo.protocolo.value)">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ConfirmaCancelar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header alerta-informativo " role="alert">
					<h5 class="modal-title" id="ModalLabel">Cancelar Protocolo</h5>
				</div>
				<div class="modal-body">
					<div id="msgCancelar">Deseja cancelar este Protocolo?</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_confirma" class="btn btn-primary" data-bs-dismiss="modal" onclick="CancelarProtocolo(document.formBuscProtocolo.protocolo.value)">Confirmar</button>
					<button type="button" id="btn_Closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>	
	<script>
        const mModal = document.getElementById('mdBuscar');
        mModal.addEventListener('hidden.bs.modal', event => {
			var div = document.querySelector('.modal-backdrop');
			if (div) {
				div.remove();
			}			
		})

        const mdAnexos = document.getElementById('mdAnexos');
        mdAnexos.addEventListener('hidden.bs.modal', event => {
			removeArquivos(document.formBuscProtocolo.protocolo.value);
		})		
    </script>    

</div>
<?php
get_footer();
?>