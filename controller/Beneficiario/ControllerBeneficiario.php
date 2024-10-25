<?php
require_once ABSPATH . '/validalogin.php';

class ControllerBeneficiario{

	public function __construct(){
        $this->index();
    }

	public function index() {  
  
		require ABSPATH . '/view/beneficiario/beneficiario/beneficiario.php';
			
    }
   
}
?>