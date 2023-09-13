<?php
if (!isset($_SESSION)) {
    session_start();
}

ob_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require '../../class/function/curl_api.php';
require '../../class/function/function.php';
//require '../class/session/session_system.php';

$headerTitle    = 'Lista de Paises y Estados';
$headerSubTitle = '';
$solicitudJSON = get_curl('operacion/estados');
$solicitudJSONS = get_curl('operacion/paises');

///ese codigo debe ejecutarse aqui
if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];

	$solicitudJSON2 = get_curl('operacion/ciudades/' . $codigo);

// Configurar la respuesta como JSON
header("Content-Type: application/json; charset=utf-8");

if ($solicitudJSON2 !== null) {
    echo json_encode($solicitudJSON2);
} else {
    // Si no hay datos, responder con un JSON vacío o un mensaje de error
    echo json_encode(array('code' => 204, 'status' => 'no_data', 'message' => 'No se encontraron datos'));
}
} else {
// Si no se proporcionó el parámetro 'codigo', responder con un JSON de error
echo json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Parámetro "codigo" no proporcionado'));

}

?>