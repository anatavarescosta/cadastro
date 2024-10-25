<?php
if((isset($_GET['carteira'])) && (isset($_GET['token']))){
    session_start();
    $_SESSION['car_app'] = $_GET['carteira'];
    $_SESSION['tk_app'] = $_GET['token'];
    header("Location: loginapp");
    die;
}
header("Location: index");
die;

/*
echo " == ";
echo base64_decode($carteira);
echo " == ";
echo base64_decode($token);
*/
?>