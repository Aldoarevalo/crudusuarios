<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
	//<!-- Formulario Agregado 26/09/2020 - Mario Vázquez -->
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $contrasena  = trim($_POST['contrasena']);
    $nuevacontrasena  = trim($_POST['nuevacontrasena']);
    $login = $_SESSION['login_01'];

    $aud01  = 'WSZIGO';
    $aud02  = date('Y-m-d H:i:s');
    $aud03  = $_SERVER['REMOTE_ADDR'];

    $dataJSON = json_encode(
        array(
            'contrasena'            => $contrasena,
            'nuevacontrasena'       => $nuevacontrasena,
            'correo'                => $login,
            'auditoria_01'          => strtoupper(trim($aud01)),
            'auditoria_02'          => $aud02,
            'auditoria_03'          => trim($aud03)
        ));
        
    $result	= post_curl('cambiocontrasena', $dataJSON);

    $result                 = json_decode($result, true);
    $msg                    = str_replace("\n", ' ', $result['message']);

    if ($result['code'] == 200) {
        //header('Location: ../../public/cambiar_contrasena.php?code='.$result['code'].'&msg='.$msg);
        header('Location: ../../public/dashboard_v1.php');
    } else {
        header('Location: ../../public/cambiar_contrasena.php?code='.$result['code'].'&msg='.$msg);
    }
    
	ob_end_flush();
?>