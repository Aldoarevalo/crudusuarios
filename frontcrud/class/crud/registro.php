<?php
if (!isset($_SESSION)) {
    session_start();
}

ob_start();

require '../../class/function/curl_api.php';
require '../../class/function/function.php';

header("Access-Control-Allow-Origin: *"); // Cambia * por el dominio permitido si es posible
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer el contenido del cuerpo de la solicitud
    $json_input = file_get_contents('php://input');

    // Decodificar el JSON en un arreglo asociativo
    $datos = json_decode($json_input, true);

    // Imprimir el arreglo como JSON en el log
    error_log("Datos recibidos: " . json_encode($datos));

    $var01  = 1;
    $var02 = ucwords(strtolower(trim($datos['miembro_var02'])));
    $var03 = ucwords(strtolower(trim($datos['miembro_var03'])));
    $var04 = strtoupper(trim($datos['miembro_var04']));
    $var05 = trim($datos['miembro_var05']);
    $var06 = $datos['miembro_var06'];
    $var07 = strtolower(trim($datos['miembro_var07']));
    $var08 = password_hash($datos['miembro_var08'], PASSWORD_DEFAULT);
    $var09 = $datos['miembro_var09'];
    $var10 = strtoupper(trim($datos['miembro_var10']));
    $var11 = strtoupper(trim($datos['miembro_var11']));
    $var12 = strtoupper(trim($datos['miembro_var12']));

    $aud01  = 'WSZIGO';
    $aud02  = date('Y-m-d H:i:s');
    $aud03  = $_SERVER['REMOTE_ADDR'];

    $work01 = $datos['workCodigo'];
    $work02 = $datos['workModo'];
    $work03 = $datos['workPage'];
    $work04 = $datos['workCaptcha'];

    // Resto de tu código...
    // Crear un arreglo asociativo con los valores
    $data = array(
        'miembro_var01'    => $var01,
        'miembro_var02'    => $var02,
        'miembro_var03'    => $var03,
        'miembro_var04'    => $var04,
        'miembro_var05'    => $var05,
        'miembro_var06'    => $var06,
        'miembro_var07'    => $var07,
        'miembro_var08'    => $var08,
        'miembro_var09'    => $var09,
        'miembro_var10'    => $var10,
        'miembro_var11'    => $var11,
        'miembro_var12'    => $var12,
        'auditoria_01'     => $aud01,
        'auditoria_02'     => $aud02,
        'auditoria_03'     => $aud03
    );

    // Convertir el arreglo a formato JSON
    $dataJSON = json_encode($data);

    // Enviar la solicitud a la API y obtener la respuesta
    $result = post_curl('miembrov23', $dataJSON);

    // Verificar si la respuesta contiene datos válidos
    if (!empty($result)) {
        // Decodificar la respuesta JSON
        $responseData = json_decode($result, true);
        error_log("Datos recibidos DE LA API: " . json_encode($result));
        if ($responseData !== null) {
        // Extraer los valores directamente del array decodificado
        $code = isset($responseData['code']) ? $responseData['code'] : 'No se pudo obtener el código';
        $status = isset($responseData['status']) ? $responseData['status'] : 'No se pudo obtener el estado';
        $message = isset($responseData['message']) ? $responseData['message'] : 'No se pudo obtener el mensaje';
        $resultado = isset($responseData['data']['resultado']) ? $responseData['data']['resultado'] : 'No se pudo obtener el resultado';
        $usuario = isset($responseData['data']['usuario']) ? $responseData['data']['usuario'] : 'No se pudo obtener el resultado';
     
            // Resto del código para manejar la respuesta
        $response = array(
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'resultado' => $resultado,
            'usuario' => $usuario,
            
        );

        $jsonResponse = json_encode($response);
        echo $jsonResponse; // Imprimir la respuesta JSON
        error_log("JSON generado: " . $jsonResponse);
    } else {
        // Manejar el caso de respuesta JSON inválida
        $response = array(
            'error' => "La respuesta de la API no pudo ser decodificada como JSON válido."
        );
        echo json_encode($response);
        error_log("Respuesta no decodificada como JSON válido");
    }
} else {
    // Manejar el caso de respuesta vacía
    $response = array(
        'error' => "La respuesta de la API está vacía o no se pudo obtener."
    );
    echo json_encode($response);
    error_log("Respuesta vacía o no obtenida");
}


}
ob_end_flush();
?>


