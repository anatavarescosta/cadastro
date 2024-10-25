		<!-- FOOTER --> 
		</div>
		<div class="container-fluid footer">
			<footer class="row m-0 text-center">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<p class="mt-3">Copyright &copy; 2022 - <?php echo date('Y') ?><?php echo " - ".NOMESISTEMA." - ".VERSAOSISTEMA." - ";?>Unimed Recife - todos os direitos reservados.</p>
				</div>
			</footer>
		</div>	  
		<!-- FIM FOOTER -->	

		<div class="modal fade" id="modalLgpd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header alerta-informativo" role="alert">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">ATENÇÃO</h1>
					</div>
					<div class="modal-body">
						<p class="m-0">
							<b>Prezado Cliente</b>,<br>
							Para que possamos prestar os nossos Serviços de Saúde, torna-se imprescindível a coleta de suas informações pessoais e sensíveis no Autorizador Web. <br><br>Os dados coletados variam de acordo com o tipo de serviço a ser prestado. Para mais detalhes, consulte a <a href="<?php echo HOME_URI . "/includes/downloads/politica-privacidade-autorizadorweb.pdf"; ?>" target="_Blank">Política de privacidade</a> do Autorizador Web.
						</p>
					</div>
					<div class="modal-footer">
						<!--<button type="button" class="btn btn-secondary" onClick="aceiteRecusa();">Não aceito</button>-->
						<button type="button" class="btn btn-primary" onClick="aceiteSim();"> Ciente </button>
					</div>
				</div>
			</div>
		</div>

		<div id="cont_alertamodal" class="cont_alertamodal"></div>

		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/js.js"></script>	
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/fancyTable.js"></script>	
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/lgpd.js"></script>	
		
		<!-- REVISAR ESTES ARQUIVOS -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/AjaxInit.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/beneficiario.js"></script>


		<!--GUARDA COOKIE -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/jquery.cookie.js"></script> 
		
		<!-- PEGA COOKIE
		<script>console.debug($.cookie("favourite-city"));</script>-->
			
		<!-- ACESSIBILIDADE -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/acessibilidade.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


		<?php 
			global $e;
			global $tipoEvento;
			$index = (isset($_REQUEST['url'])) ? explode('/',$_REQUEST['url']) : ["index"] ;
			if ($index[0] == 'index') {
				if ($tipoEvento == "a"){
					require 'alertamodal.php';
					alertamodal($e,$index[0]);
				}
				return;
			}elseif(($tipoEvento == "exibe")||($tipoEvento == "a")||($tipoEvento == "conf") ){
				require 'alertamodal.php';
				alertamodal($e,$index[0]);
			}
		?>

	</body>
<html>
