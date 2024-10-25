<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo HOME_URI;?>/public/images/favicon.ico" type="image/x-icon" />
		<title><?php echo NOMESISTEMA; ?> - <?php echo VERSAOSISTEMA?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/bootstrap.min.css" media="screen">	

		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/padrao.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/style.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/header_footer.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/menu-dropdown.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/chat.css" media="screen">

		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/login.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/beneficiario.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/linhaTempo.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/acompanharreembolso.css" media="screen">

		<!--<link rel="stylesheet" type="text/css" href="<?php echo HOME_URI;?>/public/css/select-search.min.css" />-->

		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<script type="text/javascript" language="javascript"  src="<?php echo HOME_URI;?>/public/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" language="javascript"  src="<?php echo HOME_URI;?>/public/js/jquery.min.js"></script>	
		
	</head>

	<body onload="<?php if(isset($_SESSION['aceitelgpd']) && ($_SESSION['aceitelgpd'] == 0)){ echo 'aceite();'; } ?>">
