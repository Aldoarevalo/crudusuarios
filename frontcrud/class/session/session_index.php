<?php
  if(!isset($_SESSION)){ 
    session_start(); 
  
}

require '../../class/function/curl_api.php';
require '../../class/function/function.php';

switch ($_GET['tipo']) {
    case '1':
        $val_01         = $_POST['val_01'];
        $val_02         = $_POST['val_02'];
        $val_04         = 'dashboard_v1';
        break;
    
    case '2':
        $val_01         = $_GET['val_01'];
        $val_02         = $_GET['val_02'];
        $val_04         = 'recuperar_v1';
        break;
}

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
    // Resto de tu código para enviar la solicitud a la API y manejar la respuesta
    
    // Aquí simulamos una respuesta exitosa de la API
    error_log("ANTES DEL POST - val_01: " . $val_01 . ", val_02: " . $val_02);

    $resultJSON     = post_curl('login', $dataJSON);
   

    $resultJSON     = json_decode($resultJSON, true);
    $errorLogMessage = "Resultado del POST: " . json_encode($resultJSON);
    error_log($errorLogMessage);
    
    // Verificar si el inicio de sesión fue exitoso
    if ($resultJSON['code'] === 200) {
      
        $_SESSION['login_00']   = strtolower(trim($resultJSON['data']['login_miembro_codigo']));
        $_SESSION['login_01']   = $resultJSON['data']['login_correo'];
        $_SESSION['login_02']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_nombre'])));
        $_SESSION['login_03']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_apellido'])));
        $_SESSION['login_04']   = ucwords(strtolower(trim($resultJSON['data']['login_miembro_documento'])));
        $_SESSION['flag_recuperacion'] = $resultJSON['data']['login_flag_recuperacion'];
   
        $_SESSION['seg_01'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['expire'] = time() + 3000;
        $_SESSION['rol_usuario'] = $resultJSON['data']['login_miembro_rol'];

        if($_SESSION['flag_recuperacion']==1)
        {
            header('Location: ../../public/actualizar_contrasena.php');
        } else if ($_SESSION['rol_usuario'] == 4) {
            echo '<h1 style="color:#8a2be2;margin-left:220px;margin-bottom:5px;position:absolute;margin-top:10px;" >Por favor verifica tu cuenta para disfrutar de todos los beneficios</h1><br>';
            echo '<a href="../index.php"><button type="button" name="submit" class="btn btn-cuboton btn-block btn-lg" style="background-color:blue;margin-left:550px;margin-top:100px;width:13%; !important;height:30px; color:#ffffff !important;">Iniciar Sesión</button></a>';
        
            exit();
        }
      else if ($_SESSION['rol_usuario'] === null) {
            echo '<h1 style="color:#8a2be2;margin-left:220px;margin-bottom:5px;position:absolute;margin-top:10px;">No autorizado</h1><br>';
            echo '<a href="../index.php"><button type="button" name="submit" class="btn btn-cuboton btn-block btn-lg" style="background-color:blue;margin-left:550px;margin-top:100px;width:13%; !important;height:30px; color:#ffffff !important;">Iniciar Sesión</button></a>';
            exit();
        } else {
            if ($_SESSION['rol_usuario'] != 3) {
                header('Location: ../../public/'.$val_04.'.php');
                //header('Location: ../../public/dashboard_v1.php');
            } else {
                header('Location: ../../public/dashboard_aliado.php');
            }
        }
    } else {
       // header('Location: ../../index.php?code=' . $resultJSON['code'] . '&msg=Usuario o contraseña inválidos');
       $code = $resultJSON['code'];
       $msg = $resultJSON['message']; // Codificar el mensaje para que sea seguro en la URL
      $redirectUrl = '../../index.php?code=' . $code . '&msg=' . $msg;
      header('Location: ' . $redirectUrl);
      if($code = ""){
        $code = 201;
        $msg = urlencode('Usuario o contraseña inválidos'); // Codificar el mensaje para que sea seguro en la URL
        $redirectUrl = '../../index.php?code=' . $code . '&msg=' . $msg;
        header('Location: ' . $redirectUrl);
      }
    }

?>
