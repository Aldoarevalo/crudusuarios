<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $codigo  = trim($_GET['codigo']);
  
    //error_log("nuestro codigo gget: " . $codigo);

    $login = $_SESSION['login_01'];

    $dataJSON = json_encode(
        array(
            'codigo'       => $codigo,
           
        ));
        
    $result	= get_curl('operacion/eliminarusuario', $dataJSON);

    $result                 = json_decode($result, true);
    $msg                    = str_replace("\n", ' ', $result['message']);

    if ($result['code'] == 200) {
        header('Location: ../../admin/lista_usuarios.php');
    } else {
        header('Location: ../../admin/editar_usuario.php?codigo='.$codigo);
    }
    
	ob_end_flush();
?>