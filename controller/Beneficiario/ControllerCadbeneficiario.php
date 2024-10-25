<?php
require_once ABSPATH."/model/banco.php";
require_once ABSPATH."/includes/phpmailer/class.phpmailer.php";
//require_once ABSPATH . '/validalogin.php';

class ControllerCadbeneficiario{

	public function view() {  
		require ABSPATH . '/view/beneficiario/beneficiario/cadbeneficiario.php';
    }

    public function gravar(){
        $codUnimed  = $_POST['codunimed'];
        $carteira   = $_POST['carteira'];
        $nome       = $_POST['nome'];
        $sexo       = $_POST['sexo'];
        $nascimento = $_POST['dtnascimento'];
        $acomodacao = $_POST['acomodacao'];
        $email      = $_POST['email'];
        $fixo       = $_POST['telFixo'];
        $cel        = $_POST['telCel'];

        $dados = new Banco();

        $acesso = $dados->getValidaAcessoBeneficiario($codUnimed,$carteira,$senha);			
		if (($acesso == 1) || ($acesso == 0)){
            header("Location: ".HOME_URI."/index/a/ci2");
            die;            
        }

        function chave(){ 
            $car   = "abcdefghijklmnopqrstuvwxyz1234567890";
            $cv    = "";
            for ($i = 0; $i < 8; $i++) {
                $cv .= $car[rand(0, strlen($car) - 1)].",";
            }  
            $muda = str_replace(",","",$cv);
            return $muda;
	    }   
	    $senha = chave();

        if($dados->gravaNovoBeneInterc($codUnimed,$carteira,$nome,$sexo,$nascimento,$acomodacao,$email,$fixo,$cel,$senha)){

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
            $mail->Subject = "Acesso AutorizadorWEB.";
            $mail->Body = "Prezados(as), <br><br> Utilize a senha <b>".$senha."</b> para seu acesso ao AutorizadorWEB.<br><br>Atenciosamente,<br>Unimed Recife";
            
            if(!$mail->Send()){
                echo "Mensagem não enviada<br />";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {	
                $dados->logUpdateCodigoVerificacao($senha,$codUnimed,$carteiranovo);
            }

            header("Location: ".HOME_URI."/index/a/ci1");
            die;
        } else {
            header("Location: ".HOME_URI."/index/a/99");
            die;            
        }
    }
   
}

?>