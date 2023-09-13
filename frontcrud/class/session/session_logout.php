<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    unset($_SESSION['login_00']);
    unset($_SESSION['login_01']);
    unset($_SESSION['login_02']);
    unset($_SESSION['login_03']);
    unset($_SESSION['login_04']);
    unset($_SESSION['rol_usuario']);

   

    unset($_SESSION['seg_01']);

    unset($_SESSION['expire']);

    session_unset();
    session_destroy();
    
    header('Location: ../../index.php');
  
    
?>