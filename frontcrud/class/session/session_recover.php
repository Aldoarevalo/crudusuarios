<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $val_01         = $_POST['val_01'];
    $val_03         = $_SERVER['REMOTE_ADDR'];

    $dataJSON       = json_encode(
        array(
            'login_var01'   => date('Y-m-d'),
            'login_var02'   => $val_01,
            'login_var03'   => $val_02,
            'login_var04'   => $val_03,
            'login_var05'	=> $_SERVER['HTTP_HOST'],
            'login_var06'	=> $_SERVER['HTTP_USER_AGENT'],
            'login_var07'	=> $_SERVER['HTTP_REFERER'],
            'auditoria_01'  => 'WSZIGO',
            'auditoria_02'	=> date('Y-m-d H:i:s'),
            'auditoria_03'	=> $val_03,
        ));
    
    $resultJSON     = post_curl('login', $dataJSON);
    $resultJSON     = json_decode($resultJSON, true);

    if ($resultJSON['code'] === 200) {
        $_SESSION['login_00']   = strtolower(trim($resultJSON['data']['login_miembro_codigo']));
        $_SESSION['login_01']   = $resultJSON['data']['login_correo'];
        $_SESSION['login_02']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_nombre'])));
        $_SESSION['login_03']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_apellido'])));
        $_SESSION['login_04']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_documento'])));
        $_SESSION['flag_recuperacion'] = $resultJSON['data']['login_flag_recuperacion'];
   

        $_SESSION['rol_usuario'] = $resultJSON['data']['login_miembro_rol'];
      

        $_SESSION['seg_01']     = $_SERVER['REMOTE_ADDR'];
        
        $_SESSION['expire']     = time() + 300;
        
        header('Location: ../../public/'.$val_04.'.php');
    } else {
        $val_01             = NULL;
        $val_02             = NULL;
        $val_03             = NULL;
        $val_04             = NULL;
        
        header('Location: ../../index.php?code='.$resultJSON['code'].'&msg='.$resultJSON['message']);
    }
?>