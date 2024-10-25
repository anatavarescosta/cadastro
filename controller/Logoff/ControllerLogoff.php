<?php
//require_once(ABSPATH."/model/bancoconcessionaria.php");

class ControllerLogoff{

	public function __construct(){
    $this->index();
  }

  public function index() {  

    require ABSPATH . '/view/logoff.php';
    
  } 
  
}
?>