<?php
require_once ABSPATH . '/validalogin.php';

class ControllerReembolso{

	public function __construct(){
        $this->index();
    }

	public function index() {  

		require ABSPATH . '/view/beneficiario/reembolso/gerarreembolso.php';
			
    }
   
}
?>