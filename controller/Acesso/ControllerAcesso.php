<?php

class ControllerAcesso{

	public function __construct(){
        $this->loginAcesso();
    }

    public function loginAcesso(){
		session_start();
		
		require_once(ABSPATH."/model/banco.php");
		$validaacesso = new Banco(); 
		
		$carteira 		= $_POST["login"];
		if(strlen($carteira) == 21){
			$carteira = substr($carteira,1,strlen($carteira));
		}
		$carteiraarray0 = str_replace(".","",$carteira);
		$carteiraarray1 = str_replace("-","",$carteiraarray0);
		$carteiranovo   = substr($carteiraarray1,3,strlen($carteira));
		$codUnimed      = substr($carteiraarray1,0,3);
		$senha 			= md5($_POST['senha']);

		switch ($codUnimed) {
			case '034':
				if (substr($carteiranovo,0,4) == "3200"){
					header("Location: index/a/l4");
					die;
				}
				break;
			/*
			case '037':
				header("Location: index/a/l7");
				die;
				break;				
			*/
			case '308':
				header("Location: index/a/l5");
				die;
				break;

			case '974':
				header("Location: index/a/l6");					
				die;
				break;				
			
			default:
				break;
		}

		$acesso = $validaacesso->getValidaAcessoBeneficiario($codUnimed,$carteiranovo,$senha);			
		if ($acesso == 1){	
		
			$dados = $validaacesso->getDadosBeneficiario($carteiranovo,$senha);	
			$lgpd = $validaacesso->getAceiteLgpd($codUnimed,$carteiranovo);
			
			$_SESSION["codusuario"]		= "null";
			$_SESSION["carteira"] 		= $dados[1];
			$_SESSION["codunimed"] 		= $dados[11];
			$_SESSION["sexo"] 			= $dados[7];
			$_SESSION["nome"] 			= $dados[2];
			$_SESSION["datanascimento"] = $dados[3];
			$_SESSION["gerar"] 			= 0; // verificar o acesso de validação médica
			$_SESSION["aceitelgpd"] 	= $lgpd; 

			header("Location:".HOME_URI."/beneficiario");
			die;

		}else if($acesso == '-1'){
			header("Location: ".HOME_URI."/cadbeneficiario");	
			die;
		} else {
			header("Location: ".HOME_URI."/index/a/l1");	
			die;
		}	  
        
    }
	
}
?>

