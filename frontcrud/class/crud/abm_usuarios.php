<?php
if(!isset($_SESSION)){
    session_start();
}

ob_start();

require '../../class/function/curl_api.php';
require '../../class/function/function.php';

$accion=trim($_POST['accion']);
$codigo=trim($_POST['codigo']);
$nombre  = $_POST['nombre'];
$apellido  = $_POST['apellido'];
$documento  = $_POST['documento'];
$correo  = $_POST['correo'];
$contrasena  = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];
$nacimiento  = $_POST['nacimiento'];
$celular  = $_POST['celular'];
$ip  = $_SERVER['REMOTE_ADDR'];
$sexo ="";

$dataJSON = json_encode(
    array(
        'accion'         => $accion,
        'codigo'         => $codigo,
        'nombre'         => ucwords(strtolower(trim($nombre))),
        'apellido'         => ucwords(strtolower(trim($apellido))),
        'documento'         => strtoupper(trim($documento)),
        'email'         => trim($correo),
        'celular'         =>  trim($celular),
        'rol'         => $rol,
        'contrasena'         => trim($contrasena),
        'nacimiento'          => strtoupper(trim($nacimiento )),
        'ip'          => strtoupper(trim($ip)),
        'sexo'          => strtoupper(trim($sexo))
    ));



$result	= post_curl('operacion/usuarios', $dataJSON);

//var_dump($result);
//die();

$result                 = json_decode($result, true);
$msg                    = str_replace("\n", ' ', $result['message']);



if ($result['code'] == 200) {
    if($menu==0) header('Location: ../../admin/lista_usuarios.php');
    else header('Location: ../../admin/lista_usuarios.php?menu='.$menu);
} else {
    header('Location: ../../admin/lista_usuarios.php');
}



ob_end_flush();
?>
