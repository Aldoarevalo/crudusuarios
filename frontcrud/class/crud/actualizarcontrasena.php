<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
	
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';
   
    $nuevacontrasena  = trim($_POST['nuevacontrasena']);
    $login = $_SESSION['login_01'];
    //var_dump($_SESSION,"resultados del post actualizar pass");
    $aud01  = 'WSZIGO';
    $aud02  = date('Y-m-d H:i:s');
    $aud03  = $_SERVER['REMOTE_ADDR'];

    $dataJSON = json_encode(
        array(
            'nuevacontrasena'       => $nuevacontrasena,
            'correo'                => $login,
            'auditoria_01'          => strtoupper(trim($aud01)),
            'auditoria_02'          => $aud02,
            'auditoria_03'          => trim($aud03)
        ));
        
    $result	= post_curl('actualizarcontrasena', $dataJSON);

    $result                 = json_decode($result, true);
    $msg                    = str_replace("\n", ' ', $result['message']);

    if ($result['code'] == 200) {
        //header('Location: ../../public/dashboard_v1.php');
        header('Location: ../../public/actualizar_contrasena.php?code='.$result['code'].'&msg='.$msg);
    } else {
        header('Location: ../../public/actualizar_contrasena.php?code='.$result['code'].'&msg='.$msg);
    }
    
	ob_end_flush();
?>