<?php
require_once ABSPATH . '/validalogin.php';

class ControllerReembolsoDoc{

	public function __construct(){
        $this->index();
    }

	public function index() {  
  
		require ABSPATH . '/view/beneficiario/reembolso/reembolsodoc.php';
			
    }
   
}
?>