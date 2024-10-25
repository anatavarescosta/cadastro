<?php
  
require_once "config.php";

$url = $_SESSION["url"];
/*
//define('ABSPATH', $_SERVER['DOCUMENT_ROOT']);
require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$anexos = $dados->getAnexosSolicitacao($codanexos);
$imagem = $anexos[4];

$caminhoimagem	= "https://autorizador.unimedrecife.com.br/autorizador/solicitacao/".$imagem;
$caminho		= "/autorizador/solicitacao/".$imagem;

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
	*/
?>
<iframe src="<?php echo HOME_URI."/includes/downloads/beneficiario/$url"; ?>" width="100%" height="400px"></iframe>
<?php
/*}else{
	echo "Arquivo não encontrado";
}*/	
?>