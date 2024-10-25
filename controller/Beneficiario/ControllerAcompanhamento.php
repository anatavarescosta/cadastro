<?php
require_once ABSPATH . '/validalogin.php';

class ControllerAcompanhamento{

	public function acompanhamento() {  
		require_once ABSPATH.'/view/beneficiario/acompanhamento/acompanhamento.php';
    }
    
    public function protocoloautorizacao(){
        require_once ABSPATH."/view/beneficiario/acompanhamento/protocoloautorizacao.php";
    }

    public function protocolobeneficiario(){
        require_once ABSPATH."/view/beneficiario/acompanhamento/protocolobeneficiario.php";
    }    
}
?>