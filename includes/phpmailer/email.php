<?php 
define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT']);

require_once(ABSPATH."/model/banco.php");
$lista = new Banco(); 	
?>
<?php 
require_once("class.phpmailer.php");

function chave()
{ 
	$car   = "1234567890";
 	//$car   = "1234567890AbCdeFgHijklmnopqrstuvwxyz";
 	$cv    = "";
 
 	for ($i = 0; $i < 6; $i++) {
 		$cv .= $car{rand(0, strlen($car) - 1)}.",";
 	}  
	
	$muda = str_replace(",","",$cv);
 
 return $muda;
}


$codigo = chave();

$mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->Host = "smtp.unimedrecife.com.br"; //seu servidor SMTP
$mail->SMTPAuth = false; // 'true' para autenticação
$mail->Username = ""; // usuário de SMTP
$mail->Password = ""; // senha de SMTP
$mail->From = "autorizador@unimedrecife.com.br";
$mail->FromName = "Site - Unimed Recife";
$mail->AddAddress($emailnovo,"Unimed Recife");
//$mail->AddAttachment("../phpmailer/aviso/informativo.png" , 'informativo.png');
$mail->WordWrap = 50; // Definição de quebra de linha
$mail->IsHTML(true); // envio como HTML se 'true'
$mail->Subject = "Código de Verificação";
$mail->Body = "Prezados(as),  <br><br> Insira <b>".$codigo."</b> como código de segurança para sua solicitação de validação de e-mail. Não o compartilhe. Use-o agora para acessar a nossa pagina.<br><br>Atenciosamente,<br>Unimed Recife";

if(!$mail->Send())
{
	echo "Mensagem não enviada<br />";
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {

	if($lista->getTiporecebimentoboleto($carteira) == 0){
		$lista->getInsertTiporecebimentoboleto($carteira,$codunimed,$correios,$sms,$email,$codigo,$emailnovo,$emailantigo,$dataregistro);
	}else{
		$lista->getUpdateTiporecebimentoboleto($codigo,$emailnovo,$emailantigo,$carteira);
	}
}
?>