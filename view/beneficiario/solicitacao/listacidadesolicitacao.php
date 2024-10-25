<?php
require_once "../../../config.php";

$codestado = $_REQUEST["codestado"];

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 
?>
<select name="cidade" style="width:175px">
	<option value="0">Selecione uma Cidade</option> 
	<?php 
	$arraycidades = $dados->getCidades($codestado);
	foreach ($arraycidades as $cidades){
	?>
	<option value="<?php echo $cidades["codcidade"]?>"><?php echo utf8_encode($cidades["nome"])?></option> 
	<?php }?>
</select>
