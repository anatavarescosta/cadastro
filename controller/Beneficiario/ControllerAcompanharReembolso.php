<?php
require_once ABSPATH . '/validalogin.php';

class ControllerAcompanharReembolso{

	public function __construct(){
        $this->index();
    }

	public function index() {  
  
		require ABSPATH . '/view/beneficiario/reembolso/acompanharreembolso.php';
			
    }
   
}
?>