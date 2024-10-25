<?php 
require_once "../config.php";

$carteira = $_REQUEST["carteira"];
$carteiraarray0 = str_replace(".","",$carteira);
$carteiraarray1 = str_replace("-","",$carteiraarray0);
$carteiranovo   = (substr($carteiraarray1,3,strlen($carteira)));
$codUnimed      = (substr($carteiraarray1,0,3));
  
require_once(ABSPATH."/model/banco.php");
$log = new Banco(); 	

require_once(ABSPATH."/includes/phpmailer/class.phpmailer.php");

$email = $log->getEmailBeneficiario($codUnimed,$carteiranovo);

if ($email == ""){
	echo "0";
}else{
	echo "1";
	function chave()
	{ 
		$car   = "1234567890";
		$cv    = "";
		for ($i = 0; $i < 6; $i++) {
			$cv .= $car[rand(0, strlen($car) - 1)].",";
		}  
		$muda = str_replace(",","",$cv);
	 
	 return $muda;
	 
	}
	
	$codigo = chave();
	
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP();
	$mail->Host = "smtp.unimedrecife.com.br";
	$mail->SMTPAuth = false;
	$mail->Username = "";
	$mail->Password = "";
	$mail->From = "autorizador@unimedrecife.com.br";
	$mail->FromName = "Autorizador WEB - Unimed Recife";
	$mail->AddAddress($email,"Unimed Recife");
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = "Trocar a senha.";
	$mail->Body = "Prezados(as),  <br><br> Utilize o código <b>".$codigo."</b> para sua solicitação de troca de senha. Não o compartilhe. <br>Use-o agora para validar sua nova senha.<br><br>Atenciosamente,<br>Unimed Recife";
	
	if(!$mail->Send()){
		echo "Mensagem não enviada<br />";
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {	
		$log->logUpdateCodigoVerificacao($codigo,$codUnimed,$carteiranovo);
	}
	
}
?>