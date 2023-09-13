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
        
    $result	= post_curl('operacion/eliminarusuario', $dataJSON);

   

    if (!empty($result)) {
        header('Location: ../../admin/lista_usuarios.php');
        $responseData = json_decode($result, true);
        if ($responseData !== null) {
        $code = isset($responseData['code']) ? $responseData['code'] : 'No se pudo obtener el código';

              // Resto del código para manejar la respuesta
        $response = array(
            'code' => $code,
            
            
        );
        $jsonResponse = json_encode($response);
        echo $jsonResponse; // Imprimir la respuesta JSON
        error_log("JSON generado: " . $jsonResponse);
        if ($code === 200) {
            error_log("nuestro codigo desde la api: " . $code); 
        header('Location: ../../admin/lista_usuarios.php');
        
        exit(); // Agregar esta línea
    }
    }
     
    
    
    } else {
        header('Location: ../../admin/editar_usuario.php?codigo='.$codigo);
    }
    
	ob_end_flush();
?>