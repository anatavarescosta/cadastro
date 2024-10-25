<?php
	function autoload($class_name) {
		$R_URI = $_SERVER['REQUEST_URI'];
		$grupo = explode("/",$R_URI);
		if(isset($grupo[2])){
			$classe = ($grupo[2] == "") ? 'Login' : $grupo[2] ;	
		} else {
			$classe = 'Login';
		}

		//$file = ABSPATH . '/classe/' . $classe . "/" . $class_name . '.php';
		$file = ABSPATH . '/controller/' . $classe . "/" . $class_name . '.php';
		if (!file_exists( $file ) ) {
			//require_once ABSPATH . '/includes/404.php';
			return;
		}
		require_once $file;
	}
	spl_autoload_register('autoload');

	function get_headerLogin(){
		require ABSPATH . '/view/header.php';
	}
	
	function get_header(){
		require ABSPATH . '/view/header.php';
		require ABSPATH . '/includes/topo.php';
	}

	function get_footer(){
		require ABSPATH . '/view/footer.php';
	}
	
	function get_footerLogin(){
		require ABSPATH . '/view/footerlogin.php';
	}	

	function bloqueioSolicitacao(){
		return in_array($_SESSION['codunimed'], LIST_BLOQ_UNIMED);
	}
?>