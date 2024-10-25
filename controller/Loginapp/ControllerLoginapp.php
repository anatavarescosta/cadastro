<?php
require_once ABSPATH."/model/ValidaAcessoApp.php";		
require_once ABSPATH."/model/banco.php";

class ControllerLoginApp{

	public function __construct(){
        $this->loginApp();
    }

    public function loginApp(){
		session_start();
			
		$validaacesso = new Banco(); 

		if(($_SESSION['car_app'] == "") || ($_SESSION['tk_app'] == "")){
			header("Location: index/a/l3");
			die;			
		}

		$carteiraUnimed 	= base64_decode($_SESSION['car_app']);
		$token		 		= base64_decode($_SESSION['tk_app']);		
		
		$tamanhoCarteira 	= mb_strlen($carteiraUnimed); 
		$carteira 			= substr($carteiraUnimed,-13);
		if($tamanhoCarteira == 17){
			$codUnimed = substr($carteiraUnimed,1,3);
		} else {
			$codUnimed = substr($carteiraUnimed,0,3);
		}

		switch ($codUnimed) {
			case '034':
				if (substr($carteira,0,4) == "3200"){
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

		$acessoApp = new ValidaAcessoApp;

		if($acessoApp->validar($codUnimed,$carteira,$token)){

			//$acesso = $validaacesso->getValidaAcessoBeneficiario($codUnimed,$carteiranovo,$senha);			
			//if ($acesso == 1){

			$dados = $validaacesso->getDadosBeneficiarioApp($carteira,$codUnimed);	
			$lgpd = $validaacesso->getAceiteLgpd($codUnimed,$carteira);

			if(is_null($dados)){
				if($codUnimed != '034'){
					header("Location: ".HOME_URI."/cadbeneficiario");
					die;
				}
				header("Location:".HOME_URI."/index");
				die;
			}
			
			$_SESSION["codusuario"]		= "null";
			$_SESSION["carteira"] 		= $dados[1];
			$_SESSION["codunimed"] 		= $dados[11];
			$_SESSION["sexo"] 			= $dados[7];
			$_SESSION["nome"] 			= $dados[2];
			$_SESSION["datanascimento"] = $dados[3];
			$_SESSION["gerar"] 			= 0; // verificar o acesso de validação médica
			$_SESSION["aceitelgpd"] 	= $lgpd;

			$_SESSION['start'] = time();
						
			header("Location:".HOME_URI."/beneficiario");
			die;
			/*
			} else if ($acesso == '-1'){
				header("Location: ".HOME_URI."/cadbeneficiario");	
				die;
			} else {
				header("Location: ".HOME_URI."/index/a/l1");	
				die;
			}
			*/
		} else {
			header("Location:".HOME_URI);
			die;
		}
    }
	
}
?>

