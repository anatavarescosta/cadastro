<?php 
require_once "../../../config.php";

$protocolo 	= $_REQUEST["protocolo"];
/*
require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$rsorientacao = $dados->getMostrarGuia($protocolo);
*/

/*?>
<a href="#" onclick="MostrarPopoup('<?php echo $rsanexos["codanexos"]; ?>','<?php echo $rsanexos["nome"]; ?>','<?php echo $protocolo; ?>','../solicitacao/<?php echo $path; ?>','<?php echo $extensao?>');"><?php echo $tipo;?></a>


<?php
*/
// Configurações de conexão FTP
$ftp_server = '10.10.10.3';
$ftp_username = 'leonardof.ti';
$ftp_password = 'Kuz0Z4H5';
$ftp_folder = '/autorizador/solicitacao/files/anexos16/LORENA MEL DE ARAUJO.pdf';

// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_username, $ftp_password);

// get contents of the current directory
$contents = ftp_nlist($conn_id, $ftp_folder);

// output $contents
//echo ($contents[0]);



    if ($contents) {
        // Exibe os nomes dos arquivos
        foreach ($contents as $file) {
	
		 header("Content-type:application/pdf");
		header("Content-Disposition:inline;filename='$file");
		readfile($file);
        }
   }
?>