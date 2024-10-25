<?php
require_once '../../../validalogin.php';
require_once '../../../config.php';
require_once ABSPATH.'/model/banco.php';

class ControllerLgpd{

	public function aceite() {  
        //session_start();

        $dados = new Banco(); 
		$dados->aceiteLgpd($_SESSION['codusuario'],$_SESSION['codunimed'],$_SESSION['carteira']);
        $_SESSION['aceitelgpd'] = 1;
        return true;
    }
}

?>