<?php
require_once "../../../config.php";
//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$codmedico = $_REQUEST["codmedico"];

if ($codmedico == ""){
?>
	<select name="espMed"  id="espMed" class="form-control"><option value="">Especialidade m&eacute;dica</option></select>
<?php
}else if ($codmedico == "0"){
	$arrayespecialidade = $dados->getTodasEspecialidades();
	?>
	<select name="espMed" style="width:330px;margin-left:18px">
		<option value="0">Escolha...</option>
		<?php foreach ($arrayespecialidade as $epsecialidades){	?>
			<option value="<?php echo $epsecialidades["codigo"];?>"><?php echo utf8_encode($epsecialidades["descricao"]);?></option>
		<?php } ?>
	</select>&nbsp;<font color="#990000">*</font>
<?php 
}else{
	$arraytotalmedicoespecialidade = $dados->getTotalMedicoEspecialidades($codmedico);
	if ($arraytotalmedicoespecialidade > 0){
		$arraymedicoespecialidade = $dados->getMedicoEspecialidades($codmedico);
		$i = 0;
	?>
	<select name="espMed" style="width:330px;margin-left:18px">
		<option value="0">Especialidade m&eacute;dica</option>
		<?php	
		foreach ($arraymedicoespecialidade as $medicoepsecialidades){
			if (($i % 2) == 0){ 
				$fundo="#fff"; 
			}else{ 
				$fundo="#ccc"; 
			}
			$i++;
		?>
		<option value="<?php echo $medicoepsecialidades["codigo"];?>"><?php echo utf8_encode($medicoepsecialidades["descricao"]);?></option>
		<?php }	?>
	</select>&nbsp;<font color="#990000">*</font>
	<?php
	}else{
		echo "<p style='margin-left:10px'>Especialidade n�o mapeada para o m�dico.</p>";	
		?>
		<input type="hidden" name="espMed" value="0">
		<?php
	}
}
?>




