<?php 
require_once "../../../config.php";
require_once "../../../class/AcessaFtp.php";

date_default_timezone_set('America/Recife');

foreach ($_REQUEST as $campo => $valor) {
    if($valor == ""){
		if(($campo != "nsocial") && ($campo != "email") && ($campo != "contrato") && ($campo != "obsSolicitacao")){
			header('Location: '.HOME_URI.'/beneficiario/solicitacao/a/sp8');
			die;
		}
	}
}

$carteira 				= $_REQUEST["carteira"]; 
$nome					= $_REQUEST["nome"];
$nsocial				= $_REQUEST["nsocial"];
$email					= $_REQUEST["email"];
$datanascimento 		= explode("/",$_REQUEST["datanascimento"]);
$sexo					= $_REQUEST["sexo"];
$telresidencial 		= $_REQUEST["telFixo"];
$telefone				= $_REQUEST["telCel"];
$codmedicocooperados 	= $_REQUEST["crm"];
$medicocooperados	 	= $_REQUEST["nomeMed"];
$especialidade		 	= $_REQUEST["espMed"];
$tipo				 	= $_REQUEST["tipoTratamento"];
$arraycodtratamento 	= explode("_",$tipo);
$data 			 		= date("Y-m-d H:i:s");
$observacao				= $_REQUEST["obsSolicitacao"];
$unidade				= $_REQUEST["unidade"];
$codunimed				= $_REQUEST["codunimed"];
$id_usuario				= $_REQUEST["id_usuario"];
$parametro       		= $_REQUEST["parametro"];
if (isset($_REQUEST["documento"])){
	$documento = $_REQUEST["documento"];
}else{
	$documento = null;
}
if (isset($_REQUEST["pacientemedicado"])){
	$pacientemedicado = $_REQUEST["pacientemedicado"];
}else{
	$pacientemedicado = "";
}
if (isset($_REQUEST["tipotea"])){
	$tipotea = $_REQUEST["tipotea"];
}else{
	$tipotea = "";
}
if (isset($_REQUEST["serarealizado"])){
	$serarealizado = $_REQUEST["serarealizado"];
}else{
	$serarealizado = "";
}
$contrato = empty($_REQUEST['strHospital'])?0:$_REQUEST['contrato'];
/*if ($contrato != 0){
	$arrayprestador = explode("#",$_REQUEST["strHospital"]);
	$hospital 		= $arrayprestador[1];
	$contrato		= $arrayprestador[0];
}else{
	$hospital	= "";
	$contrato	= null;
}
echo $contrato;
exit;*/
if($_REQUEST["codunimed"] == "034"){ 
	$estado 			= $_REQUEST["estadoTratamento"];
	$cidades 			= $_REQUEST["municipioTratamento"];	
	$localatendimento 	= $_REQUEST["localatendimento"];
	if ($localatendimento == "N"){
		//$estadolocalatend = $_REQUEST["estadoResidencia"];
		//$cidadelocalatend = $_REQUEST["municipioResidencia"];
		//$estado = $_REQUEST["estadoResidencia"];
		//$cidades = $_REQUEST["municipioResidencia"];
	}else{
		$estadolocalatend = "";
		$cidadelocalatend = "";
	}
}else{
	$estado 			= "";
	$cidades 			= "";	
	$localatendimento 	= "";
	$estadolocalatend 	= "";
	$cidadelocalatend 	= "";
}
$protocolo = $_REQUEST["protocolo"];
$codsubtratamento = null;
session_start();
$_SESSION["carteira"] 		= $carteira;
$_SESSION["codunimed"] 		= $codunimed;
$_SESSION["sexo"] 			= $_REQUEST["sexo"];
$_SESSION["nome"] 			= $nome;
$_SESSION["datanascimento"] = $_REQUEST["datanascimento"];
$_SESSION["gerar"] 			= $_REQUEST["gerar"]; // verificar o acesso de validação médica

require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$totaldocs = $_REQUEST["totalitensdocumento"];
			
if ($totaldocs == 0){
	header('Location: '.HOME_URI.'/beneficiario/solicitacao/a/sp7');
	die;
}else{
	//protocolo ans
	$protocoloans = $dados->getNextProtocoloans();
	$totalprotocolo = $dados->getProtocolo($protocolo);

	if ($totalprotocolo == 0){

		// ###################
		// ENVIO DOS ANEXOS
		$arquivoEnviado = false;
		$totaldocs = $_REQUEST["totalitensdocumento"];
		if ($totaldocs > 0){	
			for($d=1;$d<=$totaldocs;$d++){
				$itens = $_REQUEST["totaldocumento".$d];	
				if ($itens > 0){
					for($i=1;$i<=$itens;$i++){
						$tamanho_arquivo   	= $_FILES["arquivo".$d.$i]["size"];
						$tam_maximo 		= 1024 * 1024 * 2;
						if($tamanho_arquivo > $tam_maximo){
							header('Location: beneficiario/solicitacao/a/sp6');
							die;
						}
					}
				}
			}

			for($d=1;$d<=$totaldocs;$d++){
				$itens = $_REQUEST["totaldocumento".$d];	
				if ($itens > 0){
					for($i=1;$i<=$itens;$i++){
						$ftp = new AcessaFtp;
						
						if ($_FILES["arquivo".$d.$i]["name"] != ""){

							$arquivo = $_FILES["arquivo".$d.$i]["name"];
						
							$nome_arquivo      = $_FILES["arquivo".$d.$i]["name"];
							$extensao_arquivo  = substr($nome_arquivo,strpos($nome_arquivo,'.')+1,strlen($nome_arquivo)-strpos($nome_arquivo,'.'));				
							$tamanho_arquivo   = $_FILES["arquivo".$d.$i]["size"];						
							$extensoes		   = array('jpg', 'png', 'jpeg','pdf');
							$extensao 		   = substr(strtolower($nome_arquivo), -3);
							if($extensao == 'peg'){
								$extensao 		   = substr(strtolower($nome_arquivo), -4);
							}
							$origem  		   = $_FILES["arquivo".$d.$i]["tmp_name"];	

							$nome_arquivo 	   = "A-".$protocolo."-".date('dmY').date('His').$i.".".$extensao;
							$caminho           = "files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo."/".$nome_arquivo;
							
							if(is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".date('Y')))){
								if(is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')))){
									if(is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')))){											
										if(is_array($ftp->verificar("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo))){										
										}else{
											$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo);
										}																									
									}else{
										$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d'));
										$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo);
									}
								}else{
									$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m'));
									$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d'));
									$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo);						
								}
							}else{
								$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y'));
								$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m'));
								$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d'));
								$ftp->criarCaminho("/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo);
							}
							
							$destino = "/autorizador/solicitacao/files/anexosano".date('Y')."/anexosmes".date('m')."/anexosdia".date('d')."/anexos".$protocolo."/".$nome_arquivo;
							$ftp->gravar($destino, $origem, $protocolo, $arraydata);

							if(is_array($ftp->verificar($destino))){	
								$codpredefinidos = $_REQUEST["codpredefinidos".$d.$i];
								$registroAnexo[] = ['A',$nome_arquivo,$carteira,$protocolo,$codpredefinidos,$extensao,$tamanho_arquivo,$caminho,date("Y-m-d H:i:s"),$id_usuario];
								sleep(1);
								/*
								$codpredefinidos = $_REQUEST["codpredefinidos".$d.$i];
								$rsanexos  = $dados->getInserirAnexos('A',$nome_arquivo,$carteira,$protocolo,$codpredefinidos,$extensao,$tamanho_arquivo,$caminho,date("Y-m-d H:i:s"),$id_usuario);
								sleep(1);							
								*/
								$arquivoEnviado = true;
							}														
						}
					}
					$ftp->fechaFtp();
				}	
			}	
		}
		// FIM DO ENVIO DOS ANEXOS
		// ######################################
		if($arquivoEnviado){
			$gravarsolicitacao = $dados->getInserirProtocolo($codmedicocooperados,$especialidade,$carteira,$observacao,$data,$protocolo,$datanascimento[2]."-".$datanascimento[1]."-".$datanascimento[0],$email,trim($contrato),$arraycodtratamento[1],trim($medicocooperados),$unidade,$codunimed,'','','','N',$serarealizado,'',$protocoloans,null,null,'','','N','',null,'N','','',null,'','',$documento,$codsubtratamento,'N');
			if ($gravarsolicitacao == 1){	
				foreach ($registroAnexo as $chave => $valor) {
					$rsanexos = $dados->getInserirAnexos($valor[0],$valor[1],$valor[2],$valor[3],$valor[4],$valor[5],$valor[6],$valor[7],$valor[8],$valor[9]);
				}
				
				if($_REQUEST["codunimed"] == "034"){ 			
					$gravalocalidade = $dados->InsereLocalidade($protocolo,$estado,$cidades,$_SESSION['codusuario'],date('Y-m-d H:i:s'));
				}
				
				/*etapas*/
				$gravaretapas = $dados->getInserirEtapas($protocolo,'S',$data,$_SESSION['codusuario'],$carteira,'1');
				
				if ($gravaretapas == 1){
					//gerar histórico ans
					if ($codunimed == "034"){
						if($codmedicocooperados == "999"){
							//medico
							$rsmedico = $dados->getMedico($codmedicocooperados);
							$nomemedico = $rsmedico;						
						}else{						
							$nomemedico = $medicocooperados;
						}
						
						//especialidade
						$rsespecialidade = $dados->getEspecialidade($especialidade);
						
						//tipotratamento
						$rstipotratamento = $dados->getTipotratamento($arraycodtratamento[1]);				
						
						//gerar histórico ans
						$rtprotocolo = $dados->getInserirHistoricoprotocolo($carteira,$codunimed,$protocoloans,'6','5','5','0','O histórico de protocolo do beneficiário foi gerado a partir do número de solicitação '.$protocolo.', onde o médico solicitante foi '.utf8_encode($nomemedico).' cujo a especialidade é '.utf8_encode($rsespecialidade).', e o tipo de tratamento selecionado foi '.utf8_encode($rstipotratamento).'.',$id_usuario,date("Y-m-d H:i:s"),$unidade,'A',$tipotea);
						$rshistorico = $dados->getHistoricoprotocolo($protocoloans,$carteira,$codunimed);
						$codhistoricoprotocolo = $rshistorico;
						$rtprotocoloxetapas = $dados->getProtocoloansxEtapas($codhistoricoprotocolo,$protocoloans,'6',$id_usuario,date('Y-m-d H:i:s'),'1');

						$rsusuario  = $dados->getBeneficiario($nome,$datanascimento[2]."-".$datanascimento[1]."-".$datanascimento[0],$email,$telefone,$sexo,$telresidencial,$carteira);
					}
			
					if ($codunimed != "034"){
						$rsusuario  = $dados->getIntercambio($nome,$datanascimento[2]."-".$datanascimento[1]."-".$datanascimento[0],$email,$telefone,$sexo,$telresidencial,$carteira);	
					}
					
	
					$_SESSION["protocolo"] = $protocolo; 
					$_SESSION["protocoloans"] = $protocoloans;
					
					if ($protocoloans == 0){ 	
						header("Location: ".HOME_URI."/beneficiario/a/sp1"); 
						die();
					} else {
						header("Location: ".HOME_URI."/beneficiario/a/sp2"); 
						die();
					}
				} else {
					header("Location: ".HOME_URI."/beneficiario/a/sp4"); 
					die();
				}
			} else {
				header("Location: ".HOME_URI."/beneficiario/a/sp4"); 
				die();
			}
		} else {
			header("Location: ".HOME_URI."/beneficiario/a/sp7"); 
			die();
		}
		
	} else {			
		header("Location: ".HOME_URI."/beneficiario/a/sp5"); 
		die();
	} 
} 
?>
