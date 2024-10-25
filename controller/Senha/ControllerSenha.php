<?php
//require_once ABSPATH."/model/ValidaAcesso.php";
require_once ABSPATH."/model/banco.php";

class ControllerSenha{

    public function esqueciasenha(){
		session_start();
		$carteira 		= (isset($_SESSION['carteira'])) ? $_SESSION["codunimed"].$_SESSION['carteira'] : $_REQUEST["carteira"] ;
		$carteiraarray0 = str_replace(".","",$carteira);
		$carteiraarray1 = str_replace("-","",$carteiraarray0);
		$carteiranovo   = (substr($carteiraarray1,3,strlen($carteira)));
		$codUnimed      = (substr($carteiraarray1,0,3));

		$_SESSION["carteira"] 		= $carteiranovo;
		$_SESSION["codunimed"] 		= $codUnimed;

		require ABSPATH . '/view/esqueciasenha.php';
		
	}

	public function trocarsenha(){
		session_start();
		$validaacesso = new Banco(); 
		
		$carteira 		= (isset($_SESSION['carteira'])) ? $_SESSION["codunimed"].$_SESSION['carteira'] : $_REQUEST["carteira"] ;
		$carteiraarray0 = str_replace(".","",$carteira);
		$carteiraarray1 = str_replace("-","",$carteiraarray0);
		$carteiranovo   = (substr($carteiraarray1,3,strlen($carteira)));
		$codUnimed      = (substr($carteiraarray1,0,3));
		$codigo		    = $_REQUEST["codEmail"];
		$senha			= md5($_REQUEST['senha']);
		
		if ($validaacesso->getValidaCodigoVerificacao($codigo,$codUnimed,$carteiranovo) > 0){		
			$dados = $validaacesso->getAlterarSenha($codUnimed,$carteiranovo,$senha);
			header("Location: ".HOME_URI."/index/a/es3");
			die;
		}else{
			header("Location: ".HOME_URI."/esqueciasenha/a/es2");
			die;
		}
		
	}

	public function mudarsenha(){
		require ABSPATH . '/view/beneficiario/senha/mudarsenha.php';
	}

	public function gravarsenha(){
		session_start();
		$validaacesso = new Banco(); 
		
		$senha 		      = $_POST['senhaUsuario'];
		$confirmacaoSenha = $_POST['senhaUsuarioConfirmacao'];

		if($senha == $confirmacaoSenha){
			if ($validaacesso->gravarSenhaNova(md5($senha),$_SESSION["codunimed"],$_SESSION['carteira'])){		
				header("Location: ".HOME_URI."/beneficiario/a/ms1");
				die;
			}else{
				header("Location: ".HOME_URI."/mudarsenha/a/ms2");
				die;
			}
		}else{
			header("Location: ".HOME_URI."/mudarsenha/a/ms2");
			die;
		}
		
	}

}
?>

