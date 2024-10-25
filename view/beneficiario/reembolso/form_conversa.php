<?php 
require_once "../../../config.php";

$protocolo				= $_REQUEST["protocolo"];
$codreembolsoxetapas 	= $_REQUEST["codreembolsoxetapas"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
//define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].":81".'/autorizador');

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

?>
<div class="container">	
	<form method="post" id="formConve" name="formConve" enctype="multipart/form-data" onsubmit="return validaForm('formConve')">
		<input type="hidden" name="protocolo" id="protocolo" value="<?php echo $protocolo?>">
		<input type="hidden" name="codreembolsoxetapas" id="codreembolsoxetapas" value="<?php echo $codreembolsoxetapas?>">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<span><textarea name="obs" id="obs" cols="2" rows="3" title="Digite sua mensagem e clique em enviar"></textarea></span>
					</div>
				</div>						
			</div>
		</div>	
	</form>
</div>
