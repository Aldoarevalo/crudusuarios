<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $codigo  = trim($_POST['codigo']);
    $canje  = trim($_POST['cmbEstado']);
    $tarjeta =trim($_POST['cmbEstado2']);
    $informacion = trim($_POST['cmbEstado3']);
    $login = $_SESSION['login_01'];

    $dataJSON = json_encode(
        array(
            'codigo'            => $codigo,
            'canje'            => $canje,
            'tarjeta'           => $tarjeta,
            'ziquiero'          => $informacion,
            'usucreacion'       => $login
        ));
        
    $result	= post_curl('actualizarcorreo', $dataJSON);

    $result                 = json_decode($result, true);
    $msg                    = str_replace("\n", ' ', $result['message']);

    if ($result['code'] == 200) {
        header('Location: ../../admin/lista_correo_canjes.php');
    } else {
        header('Location: ../../admin/editar_correo_canje.php?codigo='.$codigo);
    }
    
	ob_end_flush();
?>