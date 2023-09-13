<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $codigo  = trim($_POST['codigo']);
    $nombre  = trim($_POST['nombre']);
    $apellido  = trim($_POST['apellido']);
    $documento  = trim($_POST['documento']);
    $correo  = trim($_POST['correo']);
    $celular  = trim($_POST['celular']);
    $cmbPerfil  = trim($_POST['cmbPerfil']);
   
    $login = $_SESSION['login_01'];

    $dataJSON = json_encode(
        array(
            'codigo'       => $codigo,
            'nombre'       => $nombre,
            'apellido'     => $apellido,
            'documento'    => $documento,
            'correo'       => $correo,
            'celular'      => $celular,
            'rol'          => $cmbPerfil,
            'usuarioAct'   => $login
        ));
        
    $result	= post_curl('actualizarusuario', $dataJSON);

    $result                 = json_decode($result, true);
    $msg                    = str_replace("\n", ' ', $result['message']);

    if ($result['code'] == 200) {
        header('Location: ../../admin/lista_usuarios.php');
    } else {
        header('Location: ../../admin/editar_usuario.php?codigo='.$codigo);
    }
    
	ob_end_flush();
?>