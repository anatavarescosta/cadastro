<?php
require_once ABSPATH . '/validalogin.php';

class ControllerComplementar{

	public function __construct(){
        $this->index();
    }

	public function index() {  

		require ABSPATH . '/view/beneficiario/complementar/complementar.php';
		
    }
   
}
?>