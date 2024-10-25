<?php
require_once(ABSPATH."/init.php");

class BancoAutorizador{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);		
    }
	
	
	function getTotalInformacaoPessoais($codunimed,$carteira){
		$tabela = ($codunimed == '034') ? 'beneficiario' : 'intercambio' ;
   		$result = $this->mysqli->query("select count(carteira)as qtd from ".$tabela." b where b.codunimed = '".$codunimed."' and b.carteira = '".$carteira."'");
		$row = $result->fetch_row();   		
		return $row[0]; 
	}
	
	function getInformacaoPessoais($codunimed,$carteira){
   		$result = $this->mysqli->query("select b.codbeneficiario as codbenef,b.carteira ,b.nome,date_format(b.datanascimento,'%d/%m/%Y') as datanascimento,b.telefone,b.telresidencial,b.email,b.sexo,'1' as area,b.trocasenha,b.senhaantiga,b.codunimed from beneficiario b where b.codunimed = '".$codunimed."' and b.carteira = '".$carteira."' union select i.codintercambio as codbenef,i.carteira ,i.nome,date_format(i.datanascimento,'%d/%m/%Y') as datanascimento,i.telefone,i.telresidencial,i.email,i.sexo,'2' as area,i.trocasenha,i.senhaantiga,i.codunimed from intercambio i where i.codunimed = '".$codunimed."' and i.carteira = '".$carteira."' ");
		$row = $result->fetch_row();   		
		return $row; 
	}
	
	function getTotalTipoTratamento(){
		$result = $this->mysqli->query("select count(*) as qtd from tratamento where status = 1 and codtratamento not in (22,24,25,26,18,34) order by nome asc");
		$row = $result->fetch_row();   
		return $row[0];
	}
	
	function getTipoTratamento(){
		
		$result = $this->mysqli->query("select codtratamento,nome,tipo,nomeclatura from tratamento where status = 1 and codtratamento not in (22,24,25,26,18,34) order by nome asc");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function getTotalPrestador(){
	
		$result = $this->mysqli->query("select count(*) as qtd from prestador p order by p.descricao");
		$row = $result->fetch_row();   
		return $row[0];
	
	}
	
	function getPrestador(){
	
		$result = $this->mysqli->query("select p.codigo,p.descricao from prestador p order by p.descricao");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	
	}
	
	function getEstado(){
		
		$result = $this->mysqli->query("select e.codestado,e.sigla,e.nome from estado e order by e.nome desc");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function getMunicipio(){
		
		$result = $this->mysqli->query("select e.codestado,e.sigla,e.nome from estado e order by e.nome desc");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$array[] = $row;
		}
		return $array;
	}
	
	function getNextProtocolo(){
		$row = '';
		//$result = $this->mysqli->query("SELECT max(protocolo) as protocolo from solicitacao s");
		$result = $this->mysqli->query("SELECT nextval('sq_protocolo') as protocolo");		
		if ($result === false) {
			die("Erro na consulta: " . $this->mysqli->error);
		}
		$row = $result->fetch_row();   
		return (isset($row[0])) ? $row[0] : '' ;
	}
	
	
	
	
}
?>
