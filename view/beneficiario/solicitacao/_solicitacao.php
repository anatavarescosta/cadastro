<?php 
get_header();

$cpf 			= "0";
$carteira 		= $_SESSION["codunimed"].$_SESSION["carteira"];
$nomecompleto 	= "null";
$nascimento		= "null";
$gerar 			= $_SESSION["gerar"];

require_once(ABSPATH."/model/banco_autorizador.php");
$dados = new BancoAutorizador(); 

$infototal = $dados->getTotalInformacaoPessoais($_SESSION["codunimed"],$_SESSION["carteira"]);
if ($infototal > 0){
	$info = $dados->getInformacaoPessoais($_SESSION["codunimed"],$_SESSION["carteira"]);
	$nome 			= $info[2];
	if ($info[7] == "F"){
		$sexo 			= "Feminino";
	}else if ($info[7] == "M"){
		$sexo 			= "Masculino";
	}else{
		$sexo 			= "Outros";
	}
	$datanascimento = $info[3];
	$email			= $info[6];
	$telfixo		= $info[4];
	$telcelular		= $info[5];
}else{
	echo "Algo deu errado.";
	exit;
}
//protocolo
$protocolo    = $dados->getNextProtocolo();
//$protocolo 	   = $nprotocolo+1;

?>
 <!--onSubmit="return GravarSolicitacaoBeneficiario();"-->
<div class="container">
	<form action="<?php echo HOME_URI; ?>/view/beneficiario/solicitacao/gravarsolicitacao.php" method="post" id="formSolBene" name="formSolBene" class="form" enctype="multipart/form-data" onSubmit="return validaForm('formSolBene');">
	<input type="hidden" name="protocolo" id="protocolo" value="<?php echo $protocolo?>" >	
	<input type="hidden" name="codunimed" id="codunimed" value="<?php echo $_SESSION["codunimed"]?>" >
	<input type="hidden" name="carteira" id="carteira" value="<?php echo $_SESSION["carteira"]?>" >
	<input type="hidden" name="gerar" id="gerar" value="0" >
	<input type="hidden" name="unidade" id="unidade" value="0" >
	<input type="hidden" name="id_usuario" id="id_usuario" value="null" >
	<input type="hidden" name="parametro" id="parametro" value="0" >
		<div class="row mb-4">
			<h4 title="Informações pessoais">
				<span class=" align-bottom material-symbols-outlined">
					person
				</span>
				Informações Pessoais
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-12">
						<span><b>Número da Carteira:</b> 0 <?php echo $_SESSION["codunimed"]." ".$_SESSION["carteira"]?></span><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<span><b>Nome:</b> <input type="hidden" name="nome" id="nome" value="<?php echo $nome?>" ><?php echo $nome;?></span><br>
						<span><b>Nome Social: <input type="hidden" name="nsocial" id="nsocial" value="" ><?php  //echo $datacontrato[0]["Nome_social"]?></b></span><br>
					</div>
					<div class="col-md-4">
						<span><b>Sexo:</b> <input type="hidden" name="sexo" id="sexo" value="<?php echo $nome?>" ><?php echo $sexo?></span><br>
						<span><b>Nascimento:</b> <input type="hidden" name="datanascimento" id="datanascimento" value="<?php echo $datanascimento?>" ><?php echo $datanascimento?></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4 title="Contato">
				<span class=" align-bottom material-symbols-outlined">
					contacts
				</span>				
				Contato
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-6">
						<input type="text" name="email" id="email" value="<?php echo $email?>" placeholder="Email *" title="Principal email">
					</div>				
					<div class="col-md-3">
						<input type="text" name="telFixo" id="telFixo" value="<?php echo $telfixo?>" placeholder="Telefone fixo *" title="Número do telefone fixo">
					</div>
					<div class="col-md-3">
						<input type="text" name="telCel" id="telCel" value="<?php echo $telcelular?>" placeholder="Celular *" title="Número do telefone celular">
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4 title="Dados do médico">
				<span class=" align-bottom material-symbols-outlined">
					medical_information
				</span>	
				Dados Médicos
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<!-- 
						Valor 0 = Cooperado
						Valor 1 = Não Cooperado
					-->
					<input type="hidden" name="cooperado" id="coop" value="0">
					<div class="col-md-2">
						<input type="text" name="crm" id="crm" placeholder="CRM *" onChange="getNomeMedico(this.value);" onkeypress="return somenteNumeros(event)" title="CRM">
					</div>				
					<div class="col-md-6">
						<input type="text" name="nomeMed" id="nomeMed" onchange="getmedico(this.value);" placeholder="Nome do médico *" title="Nome do médico">
					</div>
					<div class="col-md-4">
						<select name="espMed" id="espMed" onchange="" title="Especialidade da solicitação">
							<option value="0">Especialidade médica *</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4 title="Tratamento da solicitação">
				<span class=" align-bottom material-symbols-outlined">
					clinical_notes
				</span>	
				Tratamento
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-6">
						<select name="tipoTratamento" id="tipoTratamento" onChange="MostrarFlags(this.value,'<?php echo $_SESSION["carteira"];?>','<?php echo $_SESSION["codunimed"];?>');MostrarDoucumentosTipoTratamento(this.value);" title="Tipo do tratamento">
							<option value="0_0">Tipo do tratamento *</option>
							<?php			
							$totaltratamento = $dados->getTotalTipoTratamento();
							if ($totaltratamento > 0){
							?>
								<?php	
								$varraytratamento = $dados->getTipoTratamento();
								foreach ($varraytratamento as $tratamento){	
								
									if(($tratamento["tipo"] == 1) and (($tratamento["nomeclatura"] == 0) or (!isset($tratamento["nomeclatura"])))){
										$tipo = "Internação";	
									}else{
										$tipo = "";	
									}
									
									if ($gerar == 1){
										if ($tratamento["codtratamento"] == 22){
											$selected = "selected";
										}else{
											$selected = "";
										}
									}else{
										$selected = "";
									}
									
								?>
								 <option <?php echo $selected;?> value="<?php echo $tratamento["tipo"]."_".$tratamento["codtratamento"];?>"><?php echo $tipo." ".utf8_encode($tratamento["nome"]);?></option>
								<?php }	?>
							<?php }?>
						</select>
					</div>

					<div id="hospital" style="display:none" class="col-md-6">
						<div class="row mb-4">
							<div class="col-md-12">
								<input type="hidden" name="contrato" id="contrato" value="">
								<select name="strHospital" id="strHospital" class="dropdownSelect" style="width: 100%" onChange="getprestador(this.value);" title="Sugestão de hospital para o tratamento" >					
									<option value="0">Sugestão de Hospital *</option>
									<?php 					
									$totalprestadores = $dados->getTotalPrestador();					
									if ($totalprestadores > 0){
										$arrayprestadores = $dados->getPrestador();
										foreach ($arrayprestadores as $prestador){
										?>	
											<option value="<?php echo $prestador["codigo"]." # ".utf8_encode($prestador["descricao"])?>"><?php echo utf8_encode($prestador["descricao"])?></option>
										<?php
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>	

					<div id="mostrarprorrogacao" style="display:none" class="col-md-6">
						<div class="row mb-4">
							<div class="col-md-12">
								<select name="documento" id="documento"  onChange="MostrarDocumentoHospital(this.value);">
									<option value="0">Gerar Documento</option>
									<option value="1">Internação</option>
									<option value="2">Prorrogação</option>
									<option value="3">Aditivo</option>
									<option value="4">Admissão</option>
								</select>
							</div>
						</div>
					</div>

					<div id="pacientemedicadoonc" style="display:none" class="col-md-6">
						<div class="row mb-4">
							<div class="col-md-12">
								<select name="pacientemedicado" id="pacientemedicado">
									<option value="0">O tratamento Será *</option>
									<option value="I">Inicial</option>
									<option value="C">Continuação</option>
								</select>
							</div>
						</div>
					</div>

					<div id="tea" style="display:none;" class="col-md-6">
						<div class="row mb-4">
							<div class="col-md-12">
								<select name="tipotea" id="tipotea">
									<option value="0">O tratamento Será *</option>
									<option value="C">Continuação de Terapia</option>
									<option value="A">Adição de Terapia</option>
									<option value="I">Solicitação Inicial de Terapia</option>
								</select>
							</div>
						</div>
					</div>

					<div id="tipostratamento" style="display:none" class="col-md-6">
						<div class="row mb-4">
							<div class="col-md-12">
								<select name="serarealizado" id="serarealizado" onChange="SerarRealizado(document.formSolBene.tipoTratamento.value,this.value);">
									<option value="0">Será Realizado *</option>
									<option value="C">Consultório</option>
									<option value="H">Hospital / Clínica</option>
								</select>
							</div>
						</div>
					</div>					
					
				</div>
				<div class="row mt-2">
					<div class="col-md-12">
						<h6 title="Documentos para solicitação">
							<span class=" align-bottom material-symbols-outlined">
								file_present
							</span>							
							<b>Documentos</b>
						</h6>
						<div class="alert alerta-atencao" role="alert">
							<p class="m-0">Prezado beneficiário, Caso não constem os anexos necessários para análise do(s) procedimento(s), haverá o <b>CANCELAMENTO</b> do protocolo.</p>
							<p class="m-0"><b>Tamanho max. do arquivo ( 2mb ) / Tipos de arquivos aceitos (.pdf .png .jpg e .jpeg).</b></p>
						</div>
					</div>
					<div class="col-md-12" id="listaDocs"></div>
				</div>
			</div>
		</div>		
		<div class="row mb-4">
			<h4 title="Localização">
				<span class=" align-bottom material-symbols-outlined">
					location_on
				</span>	
				Localização
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-6">
						<select name="estadoTratamento" id="estadoTratamento" onChange="MostrarCidadeSolicitacao(this.value,'T');" title="Estado onde será o atendimento">
							<option value="0">Estado do atendimento *</option>
							<?php 
							$arrayestado = $dados->getEstado();
							foreach ($arrayestado as $estado){
							?>
							<option value="<?php echo $estado["codestado"]?>"><?php echo utf8_encode($estado["nome"]); ?></option> 
							<?php }?>
						</select>
					</div>
					<div class="col-md-6">
						<select name="municipioTratamento" id="municipioTratamento" title="Município para o atendimento">
							<option value="0">Município do atendimento *</option>																		
						</select>
					</div>				
				</div>
				<div class="row">
					<div class="col-md-4" title="Residência do beneficiário">
						<label for="localatendimento">Reside no mesmo Local do atendimento?</label>
						<select name="localatendimento" id="localatendimento" onChange="MostrarLocalAtendimento(this.value);">
							<option value="0"> </option>
							<option value="S">Sim</option>
							<option value="N">Não</option> 
						</select>
					</div>
				</div>			
				<div id="campoResidencia" style="display:none">	
					<div class="row">
						<div class="col-md-6 mt-2">
							<select name="estadoResidencia" id="estadoResidencia" onChange="MostrarCidadeSolicitacao(this.value,'L');" title="Estado em que reside">
								<option value="0">Estado em que reside *</option>
								<?php 
								$arrayestado = $dados->getEstado();
								foreach ($arrayestado as $estado){
								?>
								<option value="<?php echo $estado["codestado"]?>"><?php echo utf8_encode($estado["nome"]); ?></option> 
								<?php }?>											
							</select>
						</div>
						<div class="col-md-6 mt-2">
							<select name="municipioResidencia" id="municipioResidencia" title="Município em que reside">
								<option value="0">Município em que reside *</option>																		
							</select>
						</div>				
					</div>	
				</div>		
			</div>
		</div>	

		<div class="row mb-4">
			<h4 title="Observação">
				<span class=" align-bottom material-symbols-outlined">
					comment
				</span>	
				Observação
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-12">
						<p>Caso queria deixar alguma informação a mais, utilize o campo a baixo.</p>
						<textarea name="obsSolicitacao" id="obsSolicitacao" cols="30" rows="10" title="Demais informações sobre a solicitação"></textarea>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary" id="btn_envSolicitacao">Enviar Solicitação</button>
			</div>
		</div>
	
	</form>

</div>

<?php
get_footer();
?>