<?php 

include('criptografia.php');

//timezone
date_default_timezone_set('America/Sao_Paulo');

// conexão com o banco de dados
/*

define('BD_SERVIDOR','localhost');
define('BD_USUARIO','root');
define('BD_SENHA','');
define('BD_BANCO','autorizador');

*/

define('BD_SERVIDOR','srvweb-aut.unimedrecife.com.br');
define('BD_USUARIO','autorizador');
define('BD_SENHA',decriptar("VlRGYVYxRXdNVmhUYmxKcFVsVmFjbFl3V2tkTmR6MDk="));
define('BD_BANCO','autorizador');

?>

