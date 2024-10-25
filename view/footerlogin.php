		<!-- FOOTER --> 
		</div>
		<!-- FIM FOOTER -->	

		<div id="cont_alertamodal" class="cont_alertamodal"></div>

		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/js.js"></script>	
		
		<!-- REVISAR ESTES ARQUIVOS -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/AjaxInit.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/beneficiario.js"></script>


		<!--GUARDA COOKIE -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/jquery.cookie.js"></script> 
		
		<!-- ACESSIBILIDADE -->
		<script type="text/javascript" language="javascript" src="<?php echo HOME_URI;?>/public/js/acessibilidade.js"></script>

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
