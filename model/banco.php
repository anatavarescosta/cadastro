<?php
require_once(ABSPATH."/init.php");

class Banco{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);		
    }
	
	function getValidaAcesso($login,$senha){
		
		$novasenha = md5($senha);
		
		$stmt = $this->mysqli->query("SELECT * FROM `usuario` WHERE `login` = '".$login."' and `senha` = '".$novasenha."' and `status` = 1 ");
		$row = $stmt->fetch_array(MYSQLI_ASSOC);
		
		if(!empty($row)){
            return true;
        }else{
            return false;
        }
	}
	
	function getUsuario($login,$senha){
		
		$novasenha = md5($senha);
		
		$result = $this->mysqli->query("SELECT u.codusuario,u.nome FROM usuario u WHERE u.login = '".$login."' and u.senha = '".$novasenha."' and u.status = 1 ");
		$row = $result->fetch_row();
        return $row[0]; 
	}
	
    public function getTipoOcorrencia(){
        $result = $this->mysqli->query("select id_tipo_ocorr,nome from tipo_ocorrencia o  where o.status = 1 order by nome");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;
    }
	
	public function getTotalNomeUsuario($codusuario) {
   		$result = $this->mysqli->query("select count(*) as qtd from usuario u where u.codusuario = ".$codusuario." and u.status = 1 ");
   		$row = $result->fetch_row();   		
		return $row[0]; 
	}

	public function getNomeUsuario($codusuario) {
   		$result = $this->mysqli->query("select u.codusuario,u.nome from usuario u where u.codusuario = ".$codusuario." and u.status = 1 ");
   		$row = $result->fetch_row();
   		
		return $row[1]; 
	}
	
	public function getPerfilUsuario($codusuario) {
   		$result = $this->mysqli->query("select pu.codperfil from usuario u,perfilxusuario pu where u.codusuario = pu.codusuario and u.codusuario = ".$codusuario." and u.status = 1 ");
   		$row = $result->fetch_row();
   		
		return $row[0]; 
	}
	
	public function getNomeVoltarUsuario($codusuario) {
   		$result = $this->mysqli->query("select u.login,u.senha from usuario u where u.codusuario = ".$codusuario." and u.status = 1 ");
   		$row = $result->fetch_row();
   		
		return $row; 
	}
	
	function getValidaAcessoBeneficiario($unimed,$login,$senha){
		$tabela = ($unimed == '034') ? 'beneficiario' : 'intercambio' ;
		if($tabela == 'intercambio'){
   			$result = $this->mysqli->query("select b.senha from intercambio b where b.codunimed = '$unimed' and b.carteira = '$login'");	
			$row = $result->num_rows;
			if($row == '1'){
				$resultado = $result->fetch_row();
				return ($resultado[0] == $senha) ? '1' : '0';
			} else {
				return '-1';
			}
		} else {
			$result = $this->mysqli->query("select count(*) as qtd from ".$tabela." b where b.codunimed = '$unimed' and b.carteira = '".$login."' and b.senha = '".$senha."' and ativo = 'A' ");
			$row = $result->fetch_row();
			return $row[0];
		}
	}
	
	function gravaNovoBeneInterc($codUnimed,$carteira,$nome,$sexo,$nascimento,$acomodacao,$email,$fixo,$cel,$senha){
		$dtNasc = explode('-',$nascimento);
		$query = "INSERT INTO intercambio (nome,datanascimento,telefone,email,sexo,carteira,dataregistro,codunimed,trocasenha,senha,cpf,senhaantiga,telresidencial,codacomodacao) VALUES ('".strtoupper($nome)."','$dtNasc[2]-$dtNasc[1]-$dtNasc[0]','$cel','$email','$sexo','$carteira',NOW(),'$codUnimed','N','".md5($senha)."','unimed','unimed','$fixo','$acomodacao')";
		$result = $this->mysqli->query($query);
	 	return $result; 				
	}

	function gravarSenhaNova($senha,$codunimed,$carteira){
		$tabela = ($codunimed == '034') ? 'beneficiario' : 'intercambio' ;
		$query = "UPDATE $tabela set senha = '$senha' WHERE codunimed = '$codunimed' AND carteira = '$carteira'";
		$result = $this->mysqli->query($query);
	 	return $result; 						
	}

	function getDadosBeneficiario($login,$senha){
   		$result = $this->mysqli->query("select b.codbeneficiario as codbenef,b.carteira ,b.nome,date_format(b.datanascimento,'%d/%m/%Y') as datanascimento,b.telefone,b.telresidencial,b.email,b.sexo,'1' as area,b.trocasenha,b.senhaantiga,b.codunimed from beneficiario b where b.carteira = '".$login."' and b.senha = '".$senha."' union select i.codintercambio as codbenef,i.carteira ,i.nome,date_format(i.datanascimento,'%d/%m/%Y') as datanascimento,i.telefone,i.telresidencial,i.email,i.sexo,'2' as area,i.trocasenha,i.senhaantiga,i.codunimed from intercambio i where i.carteira = '".$login."' and i.senha = '".$senha."' ");
		$row = $result->fetch_row();   		
		return $row; 
	}

	function getDadosBeneficiarioApp($login,$codunimed){
		$result = $this->mysqli->query("select b.codbeneficiario as codbenef,b.carteira ,b.nome,date_format(b.datanascimento,'%d/%m/%Y') as datanascimento,b.telefone,b.telresidencial,b.email,b.sexo,'1' as area,b.trocasenha,b.senhaantiga,b.codunimed from beneficiario b where b.carteira = '$login' and b.codunimed = '$codunimed' union select i.codintercambio as codbenef,i.carteira ,i.nome,date_format(i.datanascimento,'%d/%m/%Y') as datanascimento,i.telefone,i.telresidencial,i.email,i.sexo,'2' as area,i.trocasenha,i.senhaantiga,i.codunimed from intercambio i where i.carteira = '$login' and i.codunimed = '$codunimed'" );
		$row = $result->fetch_row();   		
		return $row; 
 	}	

	function getTotalCodigoMedicos($codigo){
		$result = $this->mysqli->query("select count(*) as qtd from medico m where m.crm = '".$codigo."'");
		$row = $result->fetch_row();   		
		return $row[0];
	
	}

	function getCodigoMedicos($codigo){
		$result = $this->mysqli->query("select crm,nome from medico m where m.crm = '".$codigo."'");
		$row = $result->fetch_row();   		
		return $row;
	
	}
	
	function getTodasEspecialidades(){
		$result = $this->mysqli->query("SELECT e.codigo,e.descricao from especialidade e order by e.descricao asc");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;		
	}
	
	function getTotalMedicoEspecialidades($codmedico){
		$result = $this->mysqli->query("SELECT count(*) as qtd from especialidade e, medicoxespecialidade me where e.codigo = me.codespecialidade and me.crm = '".$codmedico."' order by e.descricao asc");
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getMedicoEspecialidades($codmedico){
		$result = $this->mysqli->query("SELECT e.codigo,e.descricao from especialidade e, medicoxespecialidade me where e.codigo = me.codespecialidade and me.crm = '".$codmedico."' order by e.descricao asc");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	
	function  getTotalDocdTipoTratamento($codtratamento){
		$result = $this->mysqli->query("SELECT count(*) as qtd from anexospredefinidos a where a.codtratamento in(".$codtratamento.")");
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function  getDocdTipoTratamento($codtratamento){
		$result = $this->mysqli->query("SELECT distinct a.codpredefinidos,a.nome,a.codtratamento,a.link from anexospredefinidos a where a.codtratamento in(".$codtratamento.")");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	
	function  getCidades($codestado){
		$result = $this->mysqli->query("select c.codcidade,c.nome from cidade c,estadoxcidade ec where c.codcidade = ec.codcidade and ec.codestado = ".$codestado);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	
	function getProtocolo($protocolo){
	
		$result = $this->mysqli->query("SELECT count(protocolo) as qtd from solicitacao s where protocolo = '".$protocolo."'");
		//echo $protocolo;
		$row = $result->fetch_row();   
		return $row[0];
		
	}
	
	function getInserirProtocolo($codmedico,$codespecialidade,$carteira,$observacao,$dataregistro,$protocolo,$datanascimento,$email,$hospital,$tipo,$medico,$codunidade,$codunimed,$materialopme,$codrol,$emailprestador,$urgencia,$serarealizado,$setor,$protocoloans,$guiaprorrogacao,$guiainternacao,$guiaurgencia,$tipotea,$ngl,$pacientemedicado,$prestador,$genetica,$jaexecutado,$dataexecucao,$codfornecedor,$nomefornecedor,$datarealizacao,$documento,$codsubtratamento,$internadoredepropria){
		$stmt = $this->mysqli->prepare("insert into solicitacao (codmedico,codespecialidade,carteira,observacao,dataregistro,protocolo,datanascimento,email,hospital,tipo,medico,codunidade,codunimed,materialopme,codrol,emailprestador,urgencia,serarealizado,setor,protocoloans,guiaprorrogacao,guiainternacao,guiaurgencia,tipotea,ngl,pacientemedicado,prestador,genetica,jaexecutado,dataexecucao,codfornecedor,nomefornecedor,datarealizacao,documento,codsubtratamento,internadoredepropria) value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
		$stmt->bind_param("ssssssssssssssssssssssssssssssssssss",$codmedico,$codespecialidade,$carteira,$observacao,$dataregistro,$protocolo,$datanascimento,$email,$hospital,$tipo,$medico,$codunidade,$codunimed,$materialopme,$codrol,$emailprestador,$urgencia,$serarealizado,$setor,$protocoloans,$guiaprorrogacao,$guiainternacao,$guiaurgencia,$tipotea,$ngl,$pacientemedicado,$prestador,$genetica,$jaexecutado,$dataexecucao,$codfornecedor,$nomefornecedor,$datarealizacao,$documento,$codsubtratamento,$internadoredepropria);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
	}

	function InsereLocalidade($protocolo,$estadolocalidade,$cidadelocalidade,$id_usuario,$dataregistro){
		//$sqllocalidade = "insert into solicitacaoxlocalidade (protocolo,codestado,codcidade,codusuario,dataregistro) values (".$protocolo.",".$estadolocalidade.",".$cidadelocalidade.",".$id_usuario.",'".$data."') ";
		//$rtlocalidade = mysql_query($sqllocalidade);

		$stmt = $this->mysqli->prepare("insert into solicitacaoxlocalidade (protocolo,codestado,codcidade,codusuario,dataregistro) values (?,?,?,?,?)");
		$stmt->bind_param("sssss",$protocolo,$estadolocalidade,$cidadelocalidade,$id_usuario,$dataregistro);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}

	}
	
	function getInserirEtapas($codprotocolo,$status,$dataregistro,$codusuario,$carteira,$flag){
		
		$stmt = $this->mysqli->prepare("insert into etapas (codprotocolo,status,dataregistro,codusuario,carteira,flag) value (?,?,?,?,?,?) ");
		$stmt->bind_param("ssssss",$codprotocolo,$status,$dataregistro,$codusuario,$carteira,$flag);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
	}
	
	function getMedico($codmedicocooperados){
		$result = $this->mysqli->query("select nome from medico where codmedico ='".$codmedicocooperados."'");
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getEspecialidade($especialidade){
		$result = $this->mysqli->query("select descricao from especialidade where codigo =".$especialidade);
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getTipotratamento($codtratamento){
		$result = $this->mysqli->query("select nome from tratamento where codtratamento =".$codtratamento);
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function getInserirHistoricoprotocolo($carteira,$codunimed,$protocolo,$manifestacao,$categoria,$sentimento,$resolvido,$mensagem,$codusuario,$dataregistro,$unidade,$referencia,$tipotea){
	
		$stmt = $this->mysqli->prepare("insert into historicoprotocolo (carteira,codunimed,protocolo,manifestacao,categoria,sentimento,resolvido,mensagem,codusuario,dataregistro,unidade,referencia,tipotea) value (?,?,?,?,?,?,?,?,?,?,?,?,?) ");
		$stmt->bind_param("sssssssssssss",$carteira,$codunimed,$protocolo,$manifestacao,$categoria,$sentimento,$resolvido,$mensagem,$codusuario,$dataregistro,$unidade,$referencia,$tipotea);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
		
	}	
	
	function getHistoricoprotocolo($protocoloans,$carteira,$codunimed){
		$result = $this->mysqli->query("select codhistoricoprotocolo from historicoprotocolo h where h.protocolo = '".$protocoloans."' and h.carteira = '".$carteira."' and h.codunimed ='".$codunimed."'");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function getProtocoloansxEtapas($codhistoricoprotocolo,$protocolo,$codstatus,$codusuario,$dataregistro,$flag){
		
		$stmt = $this->mysqli->prepare("insert into protocoloansxetapas (codhistoricoprotocolo,protocolo,codstatus,codusuario,dataregistro,flag) value (?,?,?,?,?,?)");
		$stmt->bind_param("ssssss",$codhistoricoprotocolo,$protocolo,$codstatus,$codusuario,$dataregistro,$flag);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
		
	}
	
	function getBeneficiario($nome,$datanascimento,$email,$telefone,$sexo,$telresidencial,$carteira){
	
		$stmt = $this->mysqli->prepare("update beneficiario set nome = '".$nome."',datanascimento='".$datanascimento."',email='".$email."',telefone ='".$telefone."' , sexo ='".$sexo."', telresidencial ='".$telresidencial."' where carteira = ? ");
		$stmt->bind_param("s",$carteira);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}		
		
	}
	
	function getIntercambio($nome,$datanascimento,$email,$telefone,$sexo,$telresidencial,$carteira){
	
		$stmt = $this->mysqli->prepare("update intercambio set nome = '".$nome."',datanascimento='".$datanascimento."',email='".$email."',telefone ='".$telefone."' , sexo ='".$sexo."', telresidencial ='".$telresidencial."' where carteira = ? ");
		$stmt->bind_param("s",$carteira);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}		
		
	}
	
	function getTelefone($carteira,$codunimed,$telresidencial,$telefone){
		$result = $this->mysqli->query("select count(*) as qtd from telefones t where t.carteira = '".$carteira."' and codunimed = '".$codunimed."' and telresidencial = '".$telresidencial."' and telcelular = '".$telefone."'");
		$row = $result->fetch_row();   
		return $row[0];			
	}
	
	function getInserirTelefones($carteira,$codunimed,$dataregistro,$codusuario,$telresidencial,$telcelular){
	
		$stmt = $this->mysqli->prepare("insert into telefones (carteira,codunimed,dataregistro,codusuario,telresidencial,telcelular) value (?,?,?,?,?,?)");
		$stmt->bind_param("ssssss",$carteira,$codunimed,$dataregistro,$codusuario,$telresidencial,$telcelular);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}		
		
	}
	
	function getInserirAnexos($tipo,$nome,$carteira,$protocolo,$codpredefinido,$formato,$tamanho,$caminho,$dataregistro,$id_usuario){
	
		$stmt = $this->mysqli->prepare("insert into anexos (tipo,nome,carteira,protocolo,codpredefinido,formato,tamanho,caminho,dataregistro,id_usuario) values (?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssssssss",$tipo,$nome,$carteira,$protocolo,$codpredefinido,$formato,$tamanho,$caminho,$dataregistro,$id_usuario);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}		
		
	}
	
	function getInserirAnexosComplementares($tipo,$nome,$carteira,$protocolo,$codanexoscomplementar,$formato,$tamanho,$caminho,$dataregistro,$id_usuario){		
		$stmt = $this->mysqli->prepare("insert into anexos (tipo,nome,carteira,protocolo,codanexoscomplementar,formato,tamanho,caminho,dataregistro,id_usuario) values (?,?,?,?,?,?,?,?,?,?)");		
		$stmt->bind_param("ssssssssss",$tipo,$nome,$carteira,$protocolo,$codanexoscomplementar,$formato,$tamanho,$caminho,$dataregistro,$id_usuario);
		//var_dump($stmt);
		//exit;
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}		
		
	}
	
	/*acompanhar*/
	function ProcessoSolicitacaoEtapas($protocolo,$carteira,$codunimed){
		$result = $this->mysqli->query("select count(*) as qtd from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and e.codprotocolo = '".$protocolo."' AND s.carteira = '$carteira' AND s.codunimed = '$codunimed'");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	function ProcessoEtapas($protocolo,$ordem){
		$result = $this->mysqli->query("select count(*) as qtd from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and s.ordem in(".$ordem.") order by e.dataregistro desc ");
		$row = $result->fetch_row();   
		return $row[0];	
	}	
	/*function ProcessoEtapasDescricao($protocolo,$ordem){
		$result = $this->mysqli->query("select * from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and s.ordem in(".$ordem.") order by e.dataregistro desc  limit 1 ");		
		$row = $result->fetch_row();   
		return $row;	
	}*/
	function ProcessoFinalizadoGuia($protocolo){
		$result = $this->mysqli->query("select count(*) as qtd from etapas e, anexos a where e.codprotocolo = a.protocolo and e.carteira = a.carteira and  e.codprotocolo = ".$protocolo." and a.tipo ='G' and e.flag = 1 ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function ProcessoFinalizadoTotalAnexos($protocolo){
		$result = $this->mysqli->query("select count(*) as qtd from etapas e, anexos a where e.codprotocolo = a.protocolo and e.carteira = a.carteira and  e.codprotocolo = ".$protocolo." and e.flag = 1 and a.tipo in('N') ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function ProcessoFinalizadoAnexos($protocolo){
		$result = $this->mysqli->query("select a.tipo from etapas e, anexos a where e.codprotocolo = a.protocolo and e.carteira = a.carteira and  e.codprotocolo = ".$protocolo." and e.flag = 1 and a.tipo  in('A','N') limit 1");
		$row = $result->fetch_row();   
		return is_null($row[0]) ? "" : $row[0] ;	
		//return is_null($row[0]) ? $row[0] : "" ;
	}
	function ProcessoTotalEtapasFinal($protocolo){
		$result = $this->mysqli->query("select count(*) as qtd from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and e.flag = 1 and e.status in ('L','PA','N','OC','OA') limit 1 ");		
		$row = $result->fetch_row();   
		return $row[0];	
	}
	function ProcessoEtapasFinal($protocolo){
		//echo "select e.status from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and e.flag = 1 and e.status in ('L','PA','N','OC','OA') order by e.dataregistro desc  limit 1 ";
		$result = $this->mysqli->query("select e.status from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and e.flag = 1 and e.status in ('L','PA','N','OC','OA') order by e.dataregistro desc  limit 1 ");		
		$row = $result->fetch_row();  
		return (is_null($row)) ? 'AW' : $row[0];	
	}
	function ProcessoEtapasTotalRevalidacao($protocolo){
		$result = $this->mysqli->query("select count(*) as qtd from etapas e,status s where e.status = s.sigla and e.codprotocolo = ".$protocolo." and e.status = 'RV' and e.flag = 1 order by e.dataregistro desc ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	function ProcessoTotalDocumentacao($protocolo){	
		$result = $this->mysqli->query("select count(*) as qtd from complementar c, anexoscomplementar ac WHERE c.codcomplementar = ac.codcomplementar and c.codprotocolo = ".$protocolo." order by c.dataregistro desc ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	function ProcessoDocumentacao($protocolo){	
		$result = $this->mysqli->query("select ac.codanexoscomplemetar from complementar c, anexoscomplementar ac WHERE c.codcomplementar = ac.codcomplementar and c.codprotocolo = ".$protocolo." order by c.dataregistro desc ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	function ProcessoTotalItensDocumentacao($protocolo,$codanexoscomplemetar){
		//echo "select count(*) as qtd from anexoscomplementar ac,anexos a where ac.codanexoscomplemetar in(".$codanexoscomplemetar.") and a.codanexoscomplementar = ac.codanexoscomplemetar and a.flag = 1";	
		$result = $this->mysqli->query("select count(*) as qtd from anexoscomplementar ac,anexos a where ac.codanexoscomplemetar in(".$codanexoscomplemetar.") and a.codanexoscomplementar = ac.codanexoscomplemetar and a.flag = 1 ");
		$row = $result->fetch_row();   
		return $row[0];	
	}		
	function VerificaStatus($protocolo){	
		$result = $this->mysqli->query("select count(*) as qtd from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and e.status = 'S' and s.protocolo = '".$protocolo."' ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	function VerificaCanceladoStatus($protocolo){	
		$result = $this->mysqli->query("select count(*) as qtd from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and e.status = 'S' and s.protocolo = '".$protocolo."' and s.status = 1 ");
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function CancelarProtocolo($protocolo){	
		$stmt = $this->mysqli->prepare("update solicitacao set status = 1, datacancelamento = '".date('Y-m-d H:i:s')."' where protocolo = ? ");
		$stmt->bind_param("s",$protocolo);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
	}	
	
	function  getListarTodosProtocolos($codunimed,$carteira){
		$result = $this->mysqli->query("select s.protocolo,e.status,date_format(s.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and s.codunimed = '".$codunimed."' and s.carteira = '".$carteira."' ORDER BY s.dataregistro DESC");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	
	function  getListarTodosProtocolosIndex($codunimed,$carteira){
		$result = $this->mysqli->query("select s.protocolo,e.status,date_format(s.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and s.codunimed = '".$codunimed."' and s.carteira = '".$carteira."' ORDER BY s.dataregistro DESC LIMIT 5");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;	
	}	

	function  getListarTodosProtocolosBeneficiario($codunimed,$carteira){
		$result = $this->mysqli->query("SELECT h.codhistoricoprotocolo as id, h.protocolo, date_format(h.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro FROM autorizador.historicoprotocolo h WHERE h.codunimed = '$codunimed' and h.carteira = '$carteira' AND h.referencia = 'p' AND h.dataregistro > '2024-05-15 00:00:00' ORDER BY h.dataregistro DESC");
		//$result = $this->mysqli->query("select s.protocoloans,e.status,date_format(s.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and );
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;	
	}

	function  getListarTodosProtocolosBeneficiarioIndex($codunimed,$carteira){
		//$query = "SELECT h.codhistoricoprotocolo as id, h.protocolo, date_format(h.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro FROM autorizador.historicoprotocolo h WHERE h.codunimed = '$codunimed' and h.carteira = '$carteira' AND h.referencia = 'p' ORDER BY h.dataregistro DESC LIMIT 5";
		$result = $this->mysqli->query("SELECT h.codhistoricoprotocolo as id, h.protocolo, date_format(h.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro FROM autorizador.historicoprotocolo h WHERE h.codunimed = '$codunimed' and h.carteira = '$carteira' AND h.referencia = 'p' AND h.dataregistro > '2024-05-15 00:00:00' ORDER BY h.dataregistro DESC LIMIT 5");
		//$result = $this->mysqli->query("select s.protocoloans,e.status,date_format(s.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and );
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;	
	}	

	function  ConsultaProtocoloBeneficiario($protocolo){
		$array = [];

		//$sql = $this->mysqli->query("SELECT p.codprotocoloansxetapas, p.codhistoricoprotocolo, p.protocolo, p.codstatus, p.dataregistro, p.codsubstatus, p.flag, u.unidade FROM protocoloansxetapas p JOIN usuario u ON p.codusuario = u.codusuario WHERE p.protocolo = '".$protocolo."' AND p.codstatus = 1 AND p.dataregistro > '2024-03-01 00:00:00' ORDER BY p.dataregistro ASC");
		$sql = $this->mysqli->query("SELECT p.codprotocoloansxetapas, p.codhistoricoprotocolo, p.protocolo, p.codstatus, p.dataregistro, p.codsubstatus, p.flag, u.unidade FROM protocoloansxetapas p JOIN usuario u ON p.codusuario = u.codusuario WHERE p.protocolo = '".$protocolo."' AND p.dataregistro > '2024-05-15 00:00:00' ORDER BY p.dataregistro ASC");
		//$sql = $this->mysqli->query("SELECT * FROM autorizador.protocoloansxetapas p WHERE p.protocolo = '".$protocolo."' AND p.dataregistro > '2024-03-01 00:00:00' ORDER BY p.dataregistro ASC");
		if($sql->num_rows > 0){
			//$result = $this->mysqli->query("SELECT * FROM autorizador.protocoloansxetapas p WHERE p.protocolo = '".$protocolo."' ORDER BY p.dataregistro ASC");
			while($row = $sql->fetch_array(MYSQLI_ASSOC)){
				$array[] = $row;
			}
		}
		return $array;		
	}

	function getOrientacaoFinalProtocoloBeneficiario($idProtocolo,$idProtHistorico){
		$array = [];
		//$sql = "SELECT observacao, dataregistro FROM historicoprotocoloxobs WHERE codhistoricoprotocolo = $idProtocolo AND codprotocoloansxetapas = $idProtHistorico";
		$result = $this->mysqli->query("SELECT observacao, dataregistro FROM historicoprotocoloxobs WHERE codhistoricoprotocolo = $idProtocolo AND codprotocoloansxetapas = $idProtHistorico LIMIT 1");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}
	
	function  getListarUltimosProtocolos($codunimed,$carteira){
		$result = $this->mysqli->query("select s.protocolo,e.status,date_format(s.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from solicitacao s, etapas e where s.protocolo = e.codprotocolo and s.carteira = e.carteira and e.flag = 1 and s.codunimed = '".$codunimed."' and s.carteira = '".$carteira."' and s.dataregistro between '".date('Y-m-d H:i:s', strtotime('-1 month'))."' and '".date('Y-m-d H:i:s')."' ORDER BY s.dataregistro DESC ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}

	function  getStatusProtocolos($status){
		$result = $this->mysqli->query("select nome,ordem from status s where s.sigla = '".$status."' ");
		$row = $result->fetch_row();   
		return $row;	
	}
	
	function  getListarTodosProtocolosComplementar($codunimed,$carteira){
		$result = $this->mysqli->query("SELECT c.codcomplementar,c.codprotocolo,c.observacao,date_format(c.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,(select b.nome from beneficiario b where b.carteira = s.carteira and b.codunimed = s.codunimed union select i.nome from intercambio i where i.carteira = s.carteira and i.codunimed = s.codunimed) as nome FROM solicitacao s,complementar c WHERE s.carteira = c.carteira and s.protocolo = c.codprotocolo and s.carteira = '".$carteira."' and s.codunimed = '".$codunimed."' ORDER BY c.dataregistro DESC ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}
	
	function  getListarTodosProtocolosComplementarIndex($codunimed,$carteira){
		$result = $this->mysqli->query("SELECT DISTINCT c.codcomplementar,c.codprotocolo,c.observacao,date_format(c.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,(select b.nome from beneficiario b where b.carteira = s.carteira and b.codunimed = s.codunimed union select i.nome from intercambio i where i.carteira = s.carteira and i.codunimed = s.codunimed) as nome FROM solicitacao s,complementar c, anexoscomplementar ac WHERE s.carteira = c.carteira and s.protocolo = c.codprotocolo and s.carteira = '".$carteira."' and s.codunimed = '".$codunimed."' AND c.status = 1 AND ac.codcomplementar = c.codcomplementar AND ac.status = 1 ORDER BY c.dataregistro DESC ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}

	function  getMostrarTodosProtocolosComplementar($protocolo){
	
		$result = $this->mysqli->query("SELECT c.codcomplementar,c.codprotocolo,c.observacao,date_format(c.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,(select b.nome from beneficiario b where b.carteira = s.carteira and b.codunimed = s.codunimed union select i.nome from intercambio i where i.carteira = s.carteira and i.codunimed = s.codunimed) as nome FROM solicitacao s,complementar c WHERE s.carteira = c.carteira and s.protocolo = c.codprotocolo and s.protocolo = '".$protocolo."'" );
		$row = $result->fetch_row();   
		return $row;	
	}
	
	function  getListarTodosProtocolosAnexosComplementar($protocolo){
	
		$result = $this->mysqli->query("SELECT c.codcomplementar,c.codprotocolo,c.observacao,date_format(c.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro FROM solicitacao s,complementar c WHERE s.carteira = c.carteira and s.protocolo = c.codprotocolo and c.codprotocolo = '".$protocolo."'");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function  getListarAnexosComplementar($codcomplementar){
		$result = $this->mysqli->query("SELECT ac.codanexoscomplemetar,s.nome,ac.descricao,ac.status,DATE_FORMAT(ac.datacancelamento,'%d/%m/%Y') as datacancelamento from anexoscomplementar ac, status s  WHERE s.sigla = ac.etapas and ac.codcomplementar = '".$codcomplementar."'");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}
	
	function getLstarTotalAnexosComplementar($codanexoscomplemetar){
		$result = $this->mysqli->query("select count(*) as qtd from anexos a where a.flag = 1 and a.codanexoscomplementar =".$codanexoscomplemetar);
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function getDataSolicitacao($protocolo){		
		$result = $this->mysqli->query("select date_format(s.dataregistro,'%d/%m/%Y') as dataregistro from solicitacao s where s.protocolo = ".$protocolo);
		$row = $result->fetch_row();   
		return $row[0];	
	}
	
	function  getTotalTodosProtocolosReembolso($protocolo,$data1,$data2,$codunimed,$carteira){
		
		$arraydata1 = explode("/",$data1);
		$arraydata2 = explode("/",$data2);
		
		$sql = "select count(*) as qtd ";
		$sql = $sql." from reembolso r, ";
		$sql = $sql." reembolsoxetapas e ";
		$sql = $sql." where r.codprotocoloans = e.codprotocoloans ";
		$sql = $sql." and r.carteira = e.carteira ";
		$sql = $sql." and r.status = 1 ";
		$sql = $sql." and r.carteira = '".$carteira."' ";
		$sql = $sql." and r.codunimed = '".$codunimed."' ";
		if(($protocolo == "") && ($data1 == "") && ($data2 == "")){
			$sql = $sql." and r.dataregistro between '".date('Y-m-d H:i:s', strtotime('-6 month'))."' and '".date('Y-m-d H:i:s')."'";
		} else {
			if ($protocolo != ""){
				$sql = $sql." and r.codprotocoloans = '".$protocolo."' ";
			}
			if (($data1 != "") && ($data2 != "")){
				$sql = $sql." and r.dataregistro between '".$arraydata1[2]."-".$arraydata1[1]."-".$arraydata1[0]." 00:00:01' and '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
			}
		}
		//var_dump($sql);
		//exit;
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_row();   
		return $row[0];	
	}	
	
	function  getListarTodosProtocolosReembolso($protocolo,$data1,$data2,$codunimed,$carteira){
	
		$arraydata1 = explode("/",$data1);
		$arraydata2 = explode("/",$data2);
	
		$sql = "select r.codprotocoloans,r.codunimed,r.carteira,r.status,date_format(r.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,(select b.nome from beneficiario b where b.carteira = r.carteira and b.codunimed = r.codunimed union select i.nome from intercambio i where i.carteira = r.carteira and i.codunimed = r.codunimed) as nome, e.codreembolsoxetapas ";
		$sql = $sql." from reembolso r, ";
		$sql = $sql." reembolsoxetapas e ";
		$sql = $sql." where r.codprotocoloans = e.codprotocoloans ";
		$sql = $sql." and r.carteira = e.carteira ";
		$sql = $sql." and r.status = 1 ";
		$sql = $sql." and r.carteira = '".$carteira."' ";
		$sql = $sql." and r.codunimed = '".$codunimed."' ";
		if(($protocolo == "") && ($data1 == "") && ($data2 == "")){
			$sql = $sql." and r.dataregistro between '".date('Y-m-d H:i:s', strtotime('-6 month'))."' and '".date('Y-m-d H:i:s')."' ";
		} else {		
			if ($protocolo != ""){
				$sql = $sql." and r.codprotocoloans = '".$protocolo."' ";
			}
			if (($data1 != "") && ($data2 != "")){
				$sql = $sql." and r.dataregistro between '".$arraydata1[2]."-".$arraydata1[1]."-".$arraydata1[0]." 00:00:01' and '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
			}
		}
		$sql = $sql." ORDER BY r.dataregistro DESC ";
		//echo $sql;
		//exit;
		$result = $this->mysqli->query($sql);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;	
	}	
	
	function getStatusReembolso($status){
		$result = $this->mysqli->query("select nome,status from statusxreembolso s where s.codstatusxreembolso = ".$status);
		$row = $result->fetch_row();   
		return $row;
	}
	function getTotalAnexosReembolso($codprotocoloans){
		//echo $codprotocoloans;
		//exit;
		$SQLanexosreembolsocoditem = "SELECT count(*) as qtd from anexosxreembolso a ";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." WHERE a.codprotocoloans ='".$codprotocoloans."'";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." AND a.tipo = 'A' ";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." AND a.status = 1 ";
		$result = $this->mysqli->query($SQLanexosreembolsocoditem);
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getAnexosReembolso($codprotocoloans){
		$SQLanexosreembolsocoditem = "SELECT distinct a.coditem,a.codprotocoloans from anexosxreembolso a ";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." WHERE a.codprotocoloans ='".$codprotocoloans."'";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." AND a.tipo = 'A' ";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." AND a.status = 1 ";
		$SQLanexosreembolsocoditem = $SQLanexosreembolsocoditem." group by a.coditem ";
		$result = $this->mysqli->query($SQLanexosreembolsocoditem);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function getTotalItensAnexosReembolso($codprotocoloans,$coditens){
		$SQLanexosreembolso = "SELECT count(*) as qtd from anexosxreembolso a ";
		$SQLanexosreembolso = $SQLanexosreembolso." WHERE a.codprotocoloans ='".$codprotocoloans."' and a.coditem = ".$coditens;
		$SQLanexosreembolso = $SQLanexosreembolso." AND a.tipo = 'A' ";
		$SQLanexosreembolso = $SQLanexosreembolso." AND a.status = 1 ";
		$result = $this->mysqli->query($SQLanexosreembolso);
		$row = $result->fetch_row();   
		return $row[0];

	}
	function getItensAnexosReembolso($codprotocoloans,$coditens){
		$SQLanexosreembolso = "SELECT distinct a.codanexosxreembolso, a.nome,a.extensao,a.tipo,a.status,date_format(a.datacancelamento,'%d/%m/%Y %H:%i:%s') as data,a.caminho,date_format(a.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,codusuario,coditem,codclassificacaodocumento from anexosxreembolso a ";
		$SQLanexosreembolso = $SQLanexosreembolso." WHERE a.codprotocoloans ='".$codprotocoloans."' and a.coditem = ".$coditens;
		$SQLanexosreembolso = $SQLanexosreembolso." AND a.tipo = 'A' ";
		$SQLanexosreembolso = $SQLanexosreembolso." AND a.status = 1 ";
		$result = $this->mysqli->query($SQLanexosreembolso);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;

	}
	
	function getClassificacaoReembolso($codclassificacaodocumento){
	
		$SQLclassificacaoreembolso = "SELECT c.nome FROM classificacaodocumento c WHERE c.codclassificacaodocumento = ".$codclassificacaodocumento;
		$result = $this->mysqli->query($SQLclassificacaoreembolso);
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getAnexosEspecificoReembolso($codprotocoloans,$codanexosxreembolso){
	
		$SQLclassificacaoreembolso = "select a.nome,a.tamanho,a.tipo,a.extensao,a.caminho from anexosxreembolso a where a.codprotocoloans = '".$codprotocoloans."' and a.codanexosxreembolso = ".$codanexosxreembolso;
		$result = $this->mysqli->query($SQLclassificacaoreembolso);
		$row = $result->fetch_row();   
		return $row;
	}
	
	function getTotalConversaBeneficiarioReembolso($protocolo){
		$SQL0 = "SELECT count(*) as qtd from reembolso r, reembolsoxetapas re ,historicoreembolsoxetapas hr ";
		$SQL0 = $SQL0 ." where r.codprotocoloans  = re.codprotocoloans  and ";
		$SQL0 = $SQL0 ." re.codreembolsoxetapas = hr.codetapas and ";
		$SQL0 = $SQL0 ." r.codprotocoloans = '".$protocolo."' and ";
		$SQL0 = $SQL0 ." hr.mostrar = 'S' and ";
		$SQL0 = $SQL0 ." hr.codusuario = null ";
		$SQL0 = $SQL0 ." order by hr.dataregistro desc ";		
		$result = $this->mysqli->query($SQL0);
		$row = $result->fetch_row();   
		return $row[0];

	}
	function getConversaBeneficiarioReembolso($protocolo){
		/*
		$SQLconversa = "SELECT  hr.codhistoricoreembolsoxetapas,r.carteira,r.codunimed,hr.observacao,hr.status,date_format(hr.dataregistro,'%d/%m/%Y %H:%i:%s') as data,r.unidade as codunidade,hr.codusuario,date_format(hr.datacancelamento,'%d/%m/%Y %H:%i:%s') as datacancelamento from reembolso r, reembolsoxetapas re ,historicoreembolsoxetapas hr ";
		$SQLconversa = $SQLconversa ." where r.codprotocoloans  = re.codprotocoloans  and ";
		$SQLconversa = $SQLconversa ." re.codreembolsoxetapas = hr.codetapas and ";
		$SQLconversa = $SQLconversa ." r.codprotocoloans = '".$protocolo."' and ";
		$SQLconversa = $SQLconversa ." hr.mostrar = 'S' and ";
		$SQLconversa = $SQLconversa ." hr.codusuario = null ";
		$SQLconversa = $SQLconversa ." order by hr.dataregistro desc ";		
		*/
		$SQLconversa = "SELECT hr.codusuario, hr.observacao, hr.dataregistro as data ";
		$SQLconversa = $SQLconversa ."FROM reembolso r, reembolsoxetapas re ,historicoreembolsoxetapas hr " ;
		$SQLconversa = $SQLconversa ."WHERE r.codprotocoloans  = re.codprotocoloans  ";
		$SQLconversa = $SQLconversa ."AND  re.codreembolsoxetapas = hr.codetapas ";
		$SQLconversa = $SQLconversa ."AND  r.codprotocoloans = '".$protocolo."' ";
		$SQLconversa = $SQLconversa ."AND  hr.mostrar = 'S' ";
		$SQLconversa = $SQLconversa ."AND hr.codusuario is not null";
		$result = $this->mysqli->query($SQLconversa);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
		

	}
	function getBeneficiarioReembolso($carteira,$codunimed){
		$paciente = " select b.nome,b.codunimed,b.codplano as plano from beneficiario b where b.carteira ='".$carteira."' and b.codunimed ='".$codunimed."'";
		$paciente = $paciente ." UNION ";
		$paciente = $paciente ." select i.nome, i.codunimed,'' as plano  from intercambio i where i.carteira ='".$carteira."' and i.codunimed ='".$codunimed."'";
		$result = $this->mysqli->query($paciente);
		$row = $result->fetch_row();   
		return $row;
	}
	function getTotalConversaPrestadorReembolso($protocolo){
		$SQL1 = "SELECT count(*) as qtd from reembolso r, reembolsoxetapas re ,historicoreembolsoxetapas hr ";
		$SQL1 = $SQL1 ." where r.codprotocoloans  = re.codprotocoloans  and ";
		$SQL1 = $SQL1 ." re.codreembolsoxetapas = hr.codetapas and ";
		$SQL1 = $SQL1 ." r.codprotocoloans = '".$protocolo."' and ";
		$SQL1 = $SQL1 ." hr.mostrar = 'S' and ";
		$SQL1 = $SQL1 ." hr.codusuario is not null ";
		$result = $this->mysqli->query($SQL1);
		$row = $result->fetch_row();   
		return $row[0];
	}	
	function getConversaPrestadorReembolso($protocolo){
		$SQL1 = "SELECT hr.codhistoricoreembolsoxetapas,r.carteira,r.codunimed,hr.observacao,hr.status,date_format(hr.dataregistro,'%d/%m/%Y %H:%i:%s') as data,r.unidade as codunidade,hr.codusuario,date_format(hr.datacancelamento,'%d/%m/%Y %H:%i:%s') as datacancelamento from reembolso r, reembolsoxetapas re ,historicoreembolsoxetapas hr ";
		$SQL1 = $SQL1 ." where r.codprotocoloans  = re.codprotocoloans  and ";
		$SQL1 = $SQL1 ." re.codreembolsoxetapas = hr.codetapas and ";
		$SQL1 = $SQL1 ." r.codprotocoloans = '".$protocolo."' and ";
		$SQL1 = $SQL1 ." hr.mostrar = 'S' and ";
		$SQL1 = $SQL1 ." hr.codusuario is not null  ";
		$SQL1 = $SQL1 ." order by hr.dataregistro desc ";
		$result = $this->mysqli->query($SQL1);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function getInsertConversaReembolso($codetapas,$codusuario,$observacao,$dataregistro,$status,$mostrar){
		$stmt = $this->mysqli->prepare("insert into historicoreembolsoxetapas (codetapas,codusuario,observacao,dataregistro,status,mostrar) value (?,?,?,?,?,?) ");
		$stmt->bind_param("ssssss",$codetapas,$codusuario,$observacao,$dataregistro,$status,$mostrar);
		if($stmt->execute() == TRUE){
			return 1;
		}else{
			return 0;
		}
		
	}
	/*function ProcessoFinalizadoEtapas($protocolo){
		$result = $this->mysqli->query("select e.status from etapas e, anexos a where e.codprotocolo = a.protocolo and e.carteira = a.carteira and  e.codprotocolo = ".$protocolo." and e.flag = 1 limit 1 ");
		$row = $result->fetch_row();   
		return $row[0];	
	}*/
	
	/*ProcessoFinalizadoGuia
	
	anexos = "select * from anexos where flag = 1 and protocolo =".$rsp["protocolo"]." and carteira ='".$carteira."' and tipo = '".$tipo."'";
	$resultanexos = mysql_query($anexos); 
	$totalanexos = mysql_num_rows($resultanexos);
	
	$anexos = "select * from anexos where flag = 1 and protocolo =".$rsp["protocolo"]." and carteira ='".$carteira."' and tipo = 'N'";
	$resultanexos = mysql_query($anexos); 
	$totalanexos = mysql_num_rows($resultanexos); */
	
	function getNextProtocoloans(){
		//$result = $this->mysqli->query("SELECT max(protocolo) as protocolo from solicitacao s");
		$result = $this->mysqli->query("SELECT ultimo_Protocolo() as protocoloans");		
		$row = $result->fetch_row();   
		return $row[0];		
	}

	function  getAceiteLgpd($codunimed,$carteira){
		$result = $this->mysqli->query("SELECT al.aceite FROM aceitelgpd al WHERE al.codunimed = '$codunimed' AND al.carteira = '$carteira'");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array[0] : 0 ;
	}
	
	public function aceiteLgpd($codusuario,$codunimed,$carteira){
		$tipoacesso = ($codunimed == '034') ? 'B' : 'I' ;
		$query = "INSERT INTO aceitelgpd (tipoacesso, codigousuario, codunimed, carteira, aceite, diaaceite) VALUES ('$tipoacesso', $codusuario, '$codunimed', '$carteira', 1, NOW())";
		//echo $query;
		$result = $this->mysqli->query($query);

		//$row = $result->fetch_row();   		
	 	return $result; 
	}	
	
	function  getMostrarTotalProtocolosComplementar($codunimed,$carteira){
	   $sql = " SELECT count(*) as qtd       
				  FROM solicitacao s, 
					   etapas e,
					   complementar c
				 WHERE s.carteira = e.carteira
					   AND s.protocolo = e.codprotocolo
					   AND s.carteira = c.carteira
					   AND s.protocolo = c.codprotocolo
					   AND s.carteira = '".$carteira."'
					   AND s.codunimed = '".$codunimed."'
					   AND e.flag = 1
					   AND c.status = 1 
					   AND e.status = 'DC'

				  ORDER BY c.dataregistro DESC ";
				  //AND exists (select ac.codanexoscomplementar from anexos ac where ac.codanexoscomplementar = c.codcomplementar)       
				  //var_dump($sql);
						$result = $this->mysqli->query($sql);
						$row = $result->fetch_row();   
						return $row[0];	
	}
	
	function  getListarTotalProtocolosComplementar($codunimed,$carteira){
	   $sql = " SELECT c.codcomplementar,
				   c.codprotocolo,
				   c.observacao,
				   date_format(c.dataregistro, '%d/%m/%Y %H:%i:%s') AS dataregistro,
				   (SELECT b.nome
					  FROM beneficiario b
					 WHERE b.carteira = s.carteira AND b.codunimed = s.codunimed
					UNION
					SELECT i.nome
					  FROM intercambio i
					 WHERE i.carteira = s.carteira AND i.codunimed = s.codunimed)
					  AS nome       
			  FROM solicitacao s, 
				   etapas e,
				   complementar c
			 WHERE s.carteira = e.carteira
				   AND s.protocolo = e.codprotocolo
				   AND s.carteira = c.carteira
				   AND s.protocolo = c.codprotocolo
				   AND s.carteira = '".$carteira."'
				   AND s.codunimed = '".$codunimed."'
				   AND e.flag = 1
				   AND c.status = 1 
				   AND e.status = 'DC'      
				        
			  ORDER BY c.dataregistro DESC 
			  limit 1 ";
			  //AND exists (select ac.codanexoscomplementar from anexos ac where ac.codanexoscomplementar = c.codcomplementar)  
			  //var_dump($sql);
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_row();   
		return $row;
	}
	
	function  getTotalMostrarOrientacao($protocolo,$status){
		$SQLanexos = " select count(*) as qtd from(
					SELECT e.observacao,e.dataregistro                
					  FROM etapas e
					WHERE e.codprotocolo = ".$protocolo." 
					AND e.flag = 1 
					AND e.status = '".$status."'
					AND e.observacao is not null
					union 					
					SELECT eh.observacao,eh.dataregistro 
					FROM  etapas e,
						  etapaxhistorico eh 
					WHERE eh.codetapa = e.codetapas 
					AND eh.mostrar = 1
					and e.codprotocolo = ".$protocolo." 
					AND e.flag = 1 
					AND e.status = '".$status."'
					) as t
					ORDER BY t.dataregistro DESC ";	
		$result = $this->mysqli->query($SQLanexos);
		$row = $result->fetch_row();   
		return $row[0];
	}
	function  getMostrarOrientacao($protocolo,$status){
	
		$SQLanexos = " select * from(
					SELECT e.observacao,date_format(e.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro                
					  FROM etapas e
					WHERE e.codprotocolo = ".$protocolo." 
					AND e.flag = 1 
					AND e.status = '".$status."'
					AND e.observacao is not null
					union 					
					SELECT eh.observacao,date_format(eh.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro
					FROM  etapas e,
						  etapaxhistorico eh 
					WHERE eh.codetapa = e.codetapas 
					AND eh.mostrar = 1
					and e.codprotocolo = ".$protocolo." 
					AND e.flag = 1 
					AND e.status = '".$status."'
					) as t
					ORDER BY t.dataregistro DESC ";	
		$result = $this->mysqli->query($SQLanexos);	
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}
	
	function getTotalMostrarGuia($protocolo,$status){
		$SQLanexos = "SELECT count(*) as qtd from anexos a ";
		$SQLanexos = $SQLanexos." WHERE a.tipo = 'G' and flag = 1 and  protocolo =".$protocolo;
		$result = $this->mysqli->query($SQLanexos);
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getMostrarGuia($protocolo,$status){
		$SQLanexos = "SELECT distinct a.codanexos, a.nome,a.formato,a.tipo,a.caminho from anexos a ";
		$SQLanexos = $SQLanexos." WHERE a.tipo = 'G' and flag = 1 and protocolo =".$protocolo;
		$result = $this->mysqli->query($SQLanexos);	
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}

	function getMostrarAnexoNegado($protocolo,$status){
		$SQLanexos = "SELECT distinct a.codanexos, a.nome,a.formato,a.tipo,a.caminho from anexos a ";
		$SQLanexos = $SQLanexos." WHERE a.tipo IN('A','N') and flag = 1 and protocolo =".$protocolo;
		$result = $this->mysqli->query($SQLanexos);	
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}
	
	function getMostrarAnexoGeral($protocolo){
		$SQLanexos = "SELECT distinct a.codanexos, a.nome,a.formato,a.tipo,a.caminho,date_format(a.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro from anexos a ";
		$SQLanexos = $SQLanexos." WHERE a.tipo IN('A','N','PA','L','G','C') and flag = 1 and protocolo =".$protocolo;		
		$result = $this->mysqli->query($SQLanexos);	
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return isset($array) ? $array : null ;
	}
	
	function getAlterarSenha($codUnimed,$carteiranovo,$senha){		
		if ($codUnimed == "034"){
			$stmt = $this->mysqli->prepare("update beneficiario set trocasenha = 'S', senhaantiga = 'unimed' , senha = ? where carteira = ? ");
			$stmt->bind_param("ss",$senha,$carteiranovo);
			if($stmt->execute() == TRUE){
				return 1;
			}else{
				return 0;
			}
		}else{
			$stmt = $this->mysqli->prepare("update intercambio set trocasenha = 'S', senhaantiga = 'unimed' , senha = ? where carteira = ? ");
			$stmt->bind_param("ss",$senha,$carteiranovo);
			if($stmt->execute() == TRUE){
				return 1;
			}else{
				return 0;
			}			
		}
	}			
	
	function getEmailBeneficiario($codunimed,$carteira){
		if ($codunimed == "034"){
			$sql = "select email from beneficiario where carteira ='".$carteira."' and codunimed ='".$codunimed."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_row();   
			return $row[0];
		}else{
			$sql = "select email from intercambio  where carteira ='".$carteira."' and codunimed ='".$codunimed."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_row();   
			return $row[0];
		}
	}	
	
	function getValidaCodigoVerificacao($codigo,$codUnimed,$carteira){
		if ($codUnimed == "034"){
			$sql = "select count(*) as qtd from beneficiario where carteira ='".$carteira."' and codunimed ='".$codUnimed."' and senhaantiga = '".$codigo."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_row();   
			return $row[0];
		}else{
			$sql = "select count(*) as qtd from intercambio  where carteira ='".$carteira."' and codunimed ='".$codUnimed."' and senhaantiga = '".$codigo."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_row();   
			return $row[0];
		}
	}
	
	function logUpdateCodigoVerificacao($codigo,$codUnimed,$carteira){
		if ($codUnimed == "034"){
			//$sql = "update beneficiario set senhaantiga = '".$codigo."' where carteira ='".$carteira."' and codunimed ='".$codUnimed."'";
			$stmt = $this->mysqli->prepare("update beneficiario set trocasenha = 'N', senhaantiga = '".$codigo."' where carteira = ? and codunimed = ? ");
			$stmt->bind_param("ss",$carteira,$codUnimed);
			if($stmt->execute() == TRUE){
				return 1;
			}else{
				return 0;
			}			
		}else{
			$stmt = $this->mysqli->prepare("update intercambio set trocasenha = 'N', senhaantiga = '".$codigo."' where carteira = ? and codunimed = ? ");
			$stmt->bind_param("ss",$carteira,$codUnimed);
			if($stmt->execute() == TRUE){
				return 1;
			}else{
				return 0;
			}
		}
	}
	 
	function getAnexosSolicitacao($codanexos){
		$SQLanexos = "SELECT distinct a.codanexos, a.nome,a.formato,a.tipo,a.caminho from anexos a where a.codanexos = ".$codanexos;
		$result = $this->mysqli->query($SQLanexos);
		$row = $result->fetch_row();   
		return $row;
	}
}
?>
