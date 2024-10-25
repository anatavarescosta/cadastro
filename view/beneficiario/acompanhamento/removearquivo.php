<?php
require_once "../../../config.php";
$protocolo = $_GET['protocolo'];
$cont = 99;
for ($i=0; $i < $cont; $i++) { 
    if (file_exists(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.pdf")){
        $ext = "pdf";
    } else if (file_exists(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.png")){
        $ext = "png";
    } else if (file_exists(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.jpg")){
        $ext = "jpg";
    } else if (file_exists(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.jpeg")){
        $ext = "jpeg";
    } else if (file_exists(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.gif")){
        $ext = "gif";
    } else {
        $i = 99;
    } 
    if($ext != ""){
        unlink(ABSPATH."/includes/downloads/beneficiario/anx-$protocolo-$i.$ext");
        $ext = "";
    }
}
?>