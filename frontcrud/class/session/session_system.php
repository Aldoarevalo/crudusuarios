<?php 
    session_start(); 

    // Verificar si la sesión ha expirado o si el usuario no está autenticado
    $usu_00     = $_SESSION['login_00'];
    $usu_01     = $_SESSION['login_01'];
    $usu_02     = $_SESSION['login_02'];
    $usu_03     = $_SESSION['login_03'];
    $usu_04     = $_SESSION['login_04'];

    $seg_01 = $_SESSION['seg_01'];
    $expire = $_SESSION['expire'];

    if ($expire < time() || empty($usu_04)) {
        // Sesión expirada o usuario no autenticado, redirigir al cierre de sesión
        header('Location: ../../class/session/session_logout.php');
        exit();
    } else {
        if (isset($usu_01) && isset($usu_04) && isset($seg_01)) {
            // Configurar la zona horaria y el tiempo de expiración
            setlocale(LC_MONETARY, 'es_PY');
            $_SESSION['expire'] = time() + 33000;

            // Obtener información sobre la URL actual y anterior
            $urlAct = $_SERVER['REQUEST_URI'];
            $urlPat = strtoupper(substr(substr($_SERVER['SCRIPT_FILENAME'], 48), 0, -4));
            $ulrPos = strpos($_SERVER['HTTP_REFERER'], 'public');
            $urlAnt = substr($_SERVER['HTTP_REFERER'], $ulrPos);
            $ulrPos = strpos($urlAnt, '.php?');

            if ($ulrPos > 0) {
                $urlQui = substr($urlAnt, $ulrPos);
                $ulrPos = strlen($urlQui);
                $urlAnt = substr($urlAnt, 0, ($ulrPos * -1));
            }

            // Aquí puedes realizar otras acciones necesarias para la gestión de la sesión
        } else {
            // Usuario no autenticado, redirigir al cierre de sesión
           // header('Location: ../../class/session/session_logout.php');
           

            echo '<h1 style="color:#8a2be2;margin-left:220px;margin-bottom:5px;position:absolute;margin-top:10px;" >No autorizado</h1><br>';
            echo '<a href="../index.php"><button type="button" name="submit" class="btn btn-cuboton btn-block btn-lg" style="background-color:blue;margin-left:550px;margin-top:100px;width:13%; !important;height:30px; color:#ffffff !important;">Iniciar Sesión</button></a>';
    
        
           
        }
    }
?>
