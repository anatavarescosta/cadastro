<?php
//require_once(ABSPATH."/model/bancoconcessionaria.php");

class ControllerLogin{

	public function __construct(){
    $this->index();
  }

  public function index() {  

    require ABSPATH . '/view/login.php';
    
  } 
  
}
?>