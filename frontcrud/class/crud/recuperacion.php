<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
	//<!-- Formulario Agregado 26/09/2020 - Open -->
    ob_start();
    
    require '../../class/function/curl_api.php';
    require '../../class/function/function.php';

    $var01  = 1;
    $var07  = strtolower(trim($_POST['val_07']));

    $aud01  = 'WSZIGO';
    $aud02  = date('Y-m-d H:i:s');
    $aud03  = $_SERVER['REMOTE_ADDR'];

    $work01 = $_POST['workCodigo'];
    $work02 = $_POST['workModo'];
    $work03 = $_POST['workPage'];
    $work04 = $_POST['workCaptcha'];

    $work03 = 'class/session/session_recover.php?val_01='.$var07.'&';

    $JSONCaptcha    = getCaptcha($work04);
    $JSONCaptcha['success']=true; //Se setea el valor porque el localhost no esta permitido visualizar el recapcha
    if ($JSONCaptcha['success'] == true) {
        if (isset($var07)) {
            $dataJSON = json_encode(
                array(
                    'miembro_var07'         => $var07,
                    'auditoria_01'          => strtoupper(trim($aud01)),
                    'auditoria_02'          => $aud02,
                    'auditoria_03'          => trim($aud03)
                ));
                
            switch($work02){
                case 'C':
                    $result	= post_curl('recuperacion', $dataJSON);
                    break;
            }
        }

        $result                 = json_decode($result, true);
        $msg                    = str_replace("\n", ' ', $result['message']);
        $_SESSION['registro_01']= strtolower(trim($var07));

        if ($result['code'] == 200) {
            //header('Location: ../../'.$work03.'code='.$result['code'].'&msg='.$msg);
            header('Location: ../../recuperar.php?code='.$result['code'].'&msg='.$msg);
        } else {
            header('Location: ../../recuperar.php?code='.$result['code'].'&msg='.$msg);
        }
    } else {

        //header('Location: ../../'.$work03.'code=400&msg=Error del servicio reCaptcha');
    }
    
	ob_end_flush();
?>