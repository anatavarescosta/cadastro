<?php
require_once "../../../config.php";

$codprotocoloans = base64_decode($_REQUEST["codprotocoloans"]);
$codanexos		 = base64_decode($_REQUEST["codanexos"]);		

//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$anexos = $dados->getAnexosEspecificoReembolso($codprotocoloans,$codanexos);

$formato 	= $anexos[3];
$arquivo	= $anexos[0];
$caminhoimagem	= "https://autorizador.unimedrecife.com.br/".$anexos[4]."/".$arquivo;
//$caminho	= "https://autorizador.unimedrecife.com.br/auditoria/reembolso/files/anexosano2020/anexosmes05/anexosdia28/anexos34488520200528000622/20200528090017286.pdf.pdf";
$caminho	= "/autorizador/".$anexos[4]."/".$arquivo;

// Configura��es de conex�o FTP
$ftp_server 	= '10.10.10.3';
$ftp_username 	= 'unimedrecife';
$ftp_password 	= '!ftpun!m3dr#c!f3#';
$ftp_folder 	= $caminho;

$ftp_conn = ftp_connect($ftp_server);
$login = ftp_login($ftp_conn, $ftp_username, $ftp_password);

ftp_pasv($ftp_conn, true);

// Recebe lista dos arquivos do ftp
$lista = ftp_nlist($ftp_conn, $caminho);

if (is_array($lista)){
?>
<iframe src="<?php echo $caminhoimagem	?>" width="100%" height="400px"></iframe>
<?php
}else{
	echo "Arquivo não encontrado";
}	
?>