<?php
require_once ABSPATH . '/validalogin.php';

class ControllerSolicitacao{

	public function __construct(){
        $this->index();
    }

	public function index() {  
		require ABSPATH . '/view/beneficiario/solicitacao/solicitacao.php';
    }
   
}

?>