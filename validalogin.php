<?php
    try {
        $status = session_status();
        if ($status != PHP_SESSION_ACTIVE) {
            session_start();
        }
    } catch (Exception $e) { }    
    
    if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 600)) {
        session_unset(); 
        session_destroy(); 
        header("Location: ".HOME_URI."/index/a/l2");
        exit;
    }
    if(!isset($_SESSION['carteira'])){
        session_unset(); 
        session_destroy(); 
        header("Location: ".HOME_URI."/index/a/l3");
        exit;
    }

    $_SESSION['start'] = time();
?>