<?php
    get_header();
?>
<div class="container">
	<form name="formReemb" id="formReemb" method="post" enctype="multipart/form-data">
	<input type="hidden" name="testeReemb" id="testeReemb">
	<input type="hidden" name="testeanexosReemb" id="testeanexosReemb">	
	<input type="hidden" name="testeconversaReemb" id="testeconversaReemb">	
	<input type="hidden" name="testegravaconversaReemb" id="testegravaconversaReemb">	
	<input type="hidden" name="carteirareembolso" id="carteirareembolso" value="<?php echo $_SESSION["carteira"]?>">
	<input type="hidden" name="codunimedreembolso" id="codunimedreembolso" value="<?php echo $_SESSION["codunimed"]?>">
	<div class="row mb-4 reembolso">
		<h4>
			Acompanhar Reembolso
		</h4>
		<div class="col-md-12 bloco mt-4">
			<div class="row">
				<div class="col-md-6">
					<input type="text" name="protocolo" id="protocolo" placeholder="Número do protocolo" title="Número do protocolo" onkeypress="return somenteNumeros(event)">
				</div>				
				<div class="col-md-3">
					<input type="text" name="data1" id="data1" onKeyUp="barra(this);" onChange="validarData(this);" placeholder="Data inicial" title="Data inicial do período de busca">
				</div>
				<div class="col-md-3">
					<input type="text" name="data2" id="data2" onKeyUp="barra(this);" onChange="validarData(this);" placeholder="Data final" title="Data final do período de busca">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<i id="btn_listarreemb"></i><button type="button" class="btn btn-primary" id="btn_buscar" onclick="ListarReembolso();">Buscar</button>
			</div>		
		</div>
	</div>
	</form>
	<i id="btn_gravaconversareemb"></i>
	<i id="btn_listarconversareemb"></i>
	<i id="btn_listaranexosreemb"></i>
	<div id="reembolso"></div>			
</div>

<div class="modal fade" id="exbReembolso" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header alerta-informativo" role="alert">
				<h5 class="modal-title" id="ModalLabel"> ALERTA </h5>
			</div>
			<div class="modal-body">
			   <div id="mensagemreembolso"></div>
			</div>
			<div class="modal-footer">
				<button type="button" id="modal-closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>	
<div class="modal fade" id="exbAnexosReembolso" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header alerta-informativo" role="alert">
				<h5 class="modal-title" id="ModalLabel"> ANEXOS </h5>
			</div>
			<div class="modal-body">
			   <div id="mensagemanexosreembolso"></div>
			</div>
			<div class="modal-footer">
				<button type="button" id="modal-closed" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>	
<div class="modal fade" id="exbconversaReembolso" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header alerta-informativo" role="alert">
				<h5 class="modal-title" id="ModalLabel"> CHAT REEMBOLSO </h5>
			</div>
			<div class="modal-body">
			   <div id="mensagemconversareembolso"></div>
			   <div id="mensagemgravaconversareembolso"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"   id="grava-mensagem" onClick="GravarConversaReembolso();">Enviar</button>
				<button type="button" class="btn btn-secondary" id="modal-closed" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exbgravaconversaReembolso" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header alerta-informativo" role="alert">
				<h5 class="modal-title" id="ModalLabel"> MENSAGEM PARA A OPERADORA </h5>
			</div>
			<div class="modal-body">
			   <div id="mensagemgravaconversareembolso"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"   id="grava-mensagem"       onClick="GravarConversaReembolso();">Enviar</button>
				<button type="button" class="btn btn-secondary" id="modal-closedconversa" data-bs-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
	
<?php
    get_footer();
?>