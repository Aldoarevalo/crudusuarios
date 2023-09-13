<?php
if(!isset($_SESSION)){
    session_start();
}

ob_start();

require '../class/function/curl_api.php';
require '../class/function/function.php';

$login = 1;



$listaVencidos = get_curl('operacion/listavencidos');

foreach ($listaVencidos['data'] as $key => $value2) {

    $dataJSON = json_encode(
        array(
            'codigo' => $value2['codigo'],
            'estado' => 6,
            'usuarioAct' => $login
        ));

    $result = post_curl('actualizarcanje', $dataJSON);

}

ob_end_flush();

