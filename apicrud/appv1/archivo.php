<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Función para obtener todos los paises nuevamente
function get_countries() {
    $url = 'https://api';
    $headers = [
        'http' => [
            'header' => "X-TOKEN: 123456",
            'method' => 'GET'
        ]
    ];

    $context = stream_context_create($headers);
    $result = @file_get_contents($url, false, $context); // Suprime errores de file_get_contents

    if ($result === false) {
        return false;
    }
    
    $decoded_result = json_decode($result, true);

    if ($decoded_result === null) {
        return false;
    }

    return $result;
}


?>



