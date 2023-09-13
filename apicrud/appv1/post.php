<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;



$app->post('/v20/miembrov23', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $ZIGMIEEST = $request->getParsedBody()['miembro_var01'];
    $ZIGMIENOM = ucwords(strtolower(trim($request->getParsedBody()['miembro_var02'])));
    $ZIGMIEAPE = ucwords(strtolower(trim($request->getParsedBody()['miembro_var03'])));
    $ZIGMIEDOC = strtoupper(trim($request->getParsedBody()['miembro_var04']));
    $ZIGMIECEL = trim($request->getParsedBody()['miembro_var05']);
    $ZIGMIEFNA = date('Y-m-d', strtotime($request->getParsedBody()['miembro_var06']));
    $ZIGMIECOR = strtolower(trim($request->getParsedBody()['miembro_var07']));
    $ZIGMIECON = trim($request->getParsedBody()['miembro_var08']);
    $ZIGMIECIUD = strtoupper(trim($request->getParsedBody()['miembro_var10']));
    $ZIGMIEPAIS = strtoupper(trim($request->getParsedBody()['miembro_var11']));
    $ZIGMIEBARRIO = strtoupper(trim($request->getParsedBody()['miembro_var12']));
    $ZIGMIEAUS = strtoupper(trim($request->getParsedBody()['auditoria_01']));
    $ZIGMIEAFH = $request->getParsedBody()['auditoria_02'];
    $ZIGMIEAIP = trim($request->getParsedBody()['auditoria_03']);

    $ZIGMIECORS = strtolower(trim($request->getParsedBody()['miembro_var07']));

    // Resto del código de validación y manipulación de datos...

    try {
        $binary = $ZIGMIECORS;

        $auxYEAR = date('Y') - 18;
        $auxCEL = strlen($ZIGMIECEL);
        
        if (filter_var($ZIGMIECOR, FILTER_VALIDATE_EMAIL)) {
            if ($ZIGMIEFNA <= date('Y-m-d') && $ZIGMIEFNA >= ($auxYEAR - 100) . '-01-01') {
                if (!empty($ZIGMIECON)) {
                    if ($auxCEL == 10) {
                        if (
                            isset($ZIGMIEEST) && isset($ZIGMIENOM) && isset($ZIGMIEAPE) &&
                            isset($ZIGMIEDOC) && isset($ZIGMIEFNA) && isset($ZIGMIECOR) &&
                            isset($ZIGMIECON) && isset($ZIGMIECEL) && isset($ZIGMIECIUD) &&
                            isset($ZIGMIEPAIS) && isset($ZIGMIEBARRIO)
                        ) {
                            $TOKEN = md5(uniqid(rand(), true));
                            $connMSSQL = getConnectionMSSQLv2();
                            
                            // Llamada a la función almacenada insert_miembro
                            $result =    insert_cliente(
                                $ZIGMIEEST, $ZIGMIENOM, $ZIGMIEAPE, $ZIGMIEDOC, $ZIGMIEFNA, $ZIGMIECOR,
                                 $ZIGMIECON, $ZIGMIECEL, $TOKEN, $ZIGMIECIUD, $ZIGMIEPAIS, $ZIGMIEBARRIO,
                                  $ZIGMIEAUS, $ZIGMIEAIP
                            );
                           
                            if ($result === 1) {
                                $TOKEN = md5(uniqid(rand(), true));
                               enviarverificacion($ZIGMIECOR, $TOKEN);
                                
                                $code = 200;
                                $message = 'El registro fue realizado de manera exitosa por favor verifica tu bandeja de entrada para continuar .';
                                $usuario = $ZIGMIENOM;
                                //error_log($usuario);
                                $detalle = array(
                                    'resultado' => 'Por Favor verifique su bandeja de entrada para verificar su correo',
                                    'usuario' => $usuario,
                                );

                                header("Content-Type: application/json; charset=utf-8");
                                $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                            } elseif ($result === 0) {
                                header("Content-Type: application/json; charset=utf-8");
                                $json = json_encode(array('code' => 201, 'status' => 'failure', 'message' => 'YA EXISTE UN USUARIO CON ESTE DOCUMENTO:' . $ZIGMIEDOC . ' Y/O CUENTA: ' . $ZIGMIECOR), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                            } else {
                                // Manejar otro valor de retorno si es necesario
                                header("Content-Type: application/json; charset=utf-8");
                                $json = json_encode(array('code' => 415, 'status' => 'error', 'message' => ' Unsupported Media Type. This happens when you use a content encoding different from application/json.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                            }

                            $connMSSQL = null;
                            return $json;
                        } else {
                            header("Content-Type: application/json; charset=utf-8");
                            $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo está vacío.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                            return $json;
                        }
                    } elseif (strlen($ZIGMIECEL) !== 10) {
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, el número de celular no es válido.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        return $json;
                    } elseif (empty($ZIGMIECON)) {
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, la contraseña no es válida.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        return $json;
                    } elseif ($ZIGMIEFNA_Y < 1950 || $ZIGMIEFNA_Y > date('Y') - 10) {
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, la fecha de nacimiento no es válida.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        return $json;
                    } elseif (!filter_var($ZIGMIECOR, FILTER_VALIDATE_EMAIL)) {
                        header("Content-Type: application/json; charset=utf-8");
                        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, el correo ingresado no es válido.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                        return $json;
                    }
                }
            }
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error MIEMBRO: ' . $e->getMessage(), 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        return $json;
    } finally {
        if (isset($json)) {
            $connMSSQL = null;
            return $json;
        }
    }
});

function insert_cliente($ZIGMIEEST, $ZIGMIENOM, $ZIGMIEAPE, $ZIGMIEDOC, $ZIGMIEFNA, $ZIGMIECOR, $ZIGMIECON, $ZIGMIECEL, $TOKEN, $ZIGMIECIUD, $ZIGMIEPAIS, $ZIGMIEBARRIO, $ZIGMIEAUS, $ZIGMIEAIP) {
    $connMSSQL = getConnectionMSSQLv2();
    error_log("llega aqui");
     try {
    $stmt = $connMSSQL->prepare('SELECT insert_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

    // Bind parameters
    $stmt->bindParam(1, $ZIGMIEEST, PDO::PARAM_STR);
    $stmt->bindParam(2, $ZIGMIENOM, PDO::PARAM_STR);
    $stmt->bindParam(3, $ZIGMIEAPE, PDO::PARAM_STR);
    $stmt->bindParam(4, $ZIGMIEDOC, PDO::PARAM_STR);
    $stmt->bindParam(5, $ZIGMIEFNA, PDO::PARAM_STR);
    $stmt->bindParam(6, $ZIGMIECOR, PDO::PARAM_STR);
    $stmt->bindParam(7, $ZIGMIECON, PDO::PARAM_STR);
    $stmt->bindParam(8, $ZIGMIECEL, PDO::PARAM_STR);
    $stmt->bindParam(9, $TOKEN, PDO::PARAM_STR);
    $stmt->bindParam(10, $ZIGMIECIUD, PDO::PARAM_STR);
    $stmt->bindParam(11, $ZIGMIEPAIS, PDO::PARAM_STR);
    $stmt->bindParam(12, $ZIGMIEBARRIO, PDO::PARAM_STR);
    $stmt->bindParam(13, $ZIGMIEAUS, PDO::PARAM_STR);
    $stmt->bindParam(14, $ZIGMIEAIP, PDO::PARAM_STR);

    $stmt->execute();

    // Capturar el valor de retorno de la función almacenada
    $result = $stmt->fetchColumn();

    // Cierre de recursos y retorno de resultado
    $stmt->closeCursor();
    $connMSSQL = null;

    return $result;
} catch (PDOException $e) {
    // Manejar errores de la base de datos
    error_log("Error en insert_cliente: " . $e->getMessage());
    return null; // O algún valor que indique un error
}
}



function enviarverificacion($ZIGMIECORS, $TOKEN)
{

    require '../vendor/phpmailerT/class.phpmailer.php';
    $mail = new PHPMailer();

    try {
        $mail->IsSMTP(); // habilita SMTP
        // $mail->SMTPDebug = 1; // debugging: 1 = errores y mensajes, 2 = s�?�?�?³lo mensajes
        //$mail->SMTPDebug = 1; // debugging: 1 = errores y mensajes, 2 = s�?�?�?³lo mensajes
        //$mail->SMTPDebug = false;
        //$mail->do_debug =0;
        $mail->SMTPAuth = true; // auth habilitada
        $mail->SMTPSecure = 'ssl'; // transferencia segura REQUERIDA para Gmail  testnotificaciones0 //carsa2021


        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "myemail@gmail.com";
        $mail->Password = "";


        $mail->setFrom('mayemail@gmail.com', 'Crud Api');

        $mail->addAddress($ZIGMIECORS);
        //$mail->addAddress('pedrorubeng@gmail.com', $nombreUsuario);
        // Content

        $mail->Subject = 'Gracias por Registrarte en Paraguay Dominos';

        $mensaje = "<html lang='es'>
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        
        <meta name='viewport' content='width=device-width'>
        <link href='http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json' />'
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='robots' content='noindex'>
        <!--<base target='_blank'>--><base href='.' target='_blank'>
        <style type='text/css'>
    body,div[style*='margin: 16px 0'],html{margin:0!important}body,html{padding:0!important;height:100%!important;width:100%!important}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;margin:0 auto!important}table table table{table-layout:auto}img{-ms-interpolation-mode:bicubic}.yshortcuts a{border-bottom:none!important}.mobile-link--footer a,a[x-apple-data-detectors]{color:inherit!important;text-decoration:underline!important}@media screen and (max-width:600px){.center-on-narrow,.stack-column-center{text-align:center!important}.stack-column-half{width:50%!important;display:inline-block!important}.center-on-narrow,.fluid,.fluid-centered{margin-left:auto!important;margin-right:auto!important}table{table-layout:fixed!important}.email-container{width:100%!important}.fluid,.fluid-centered{max-width:100%!important;height:auto!important}.stack-column,.stack-column-center,.stack-column-full-width{display:block!important;width:100%!important;max-width:100%!important;direction:ltr!important}.center-on-narrow{display:block!important;float:none!important}table.center-on-narrow{display:inline-block!important}.stack-column-full-width .eddie-wrapper{width:100%}}
        </style>
        <title></title>
        <meta property='og:title' content=''>
        <meta property='og:description' content=''>
    </head>
    
    <body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
    <div style='display: none; max-height: 0px; overflow: hidden; color: white'>
    
    </div>
    
    
    
    <!-- begin header --> 
        <table align='center' valign='middle'>
            <tbody><tr>
                    <td align='right' valign='middle' style='font-family: Helvetica,sans-serif; font-size: 13px; color: #aaa; padding: 10px 0px; text-align: right;'>
                        <a style='font-family: Helvetica,sans-serif; font-size: 13px; color: #aaa; text-decoration: none' href='https://api.myperfit.com/v2/shares/zonamigos/campaigns/a36a0d50211f5a159e9b95d5dd80104ec78f1368e5b99f6bf2a2b5bd758e2b81/21/contents/21/preview'>ver online</a>
                    </td>
                        <td width='50' align='center' valign='middle' style='font-family: Helvetica,sans-serif; font-size: 13px; color: #aaa; padding: 10px 0px;'></td>
    
                    <td align='left' valign='middle' style='font-family: Helvetica,sans-serif; font-size: 13px; color: #aaa; padding: 10px 0px; text-align: left;'>
                        <a style='font-family: Helvetica,sans-serif; font-size: 13px; color: #aaa;text-decoration: none' href='https://api.myperfit.com/v2/shares/zonamigos/campaigns/a36a0d50211f5a159e9b95d5dd80104ec78f1368e5b99f6bf2a2b5bd758e2b81/21/contents/21/preview'>compartir</a>
                    </td>
            </tr>
        </tbody></table>
    <!-- end header --> 
    
    <table cellspacing='0' cellpadding='0' border='0' width='100%' style='font-family: Helvetica, Arial, sans-serif; width: 100%; padding: 20px; background-color: rgb(251, 220, 238); background-image: none;'> 
     <tbody> 
      <tr> 
       <td align='center'> 
        <table class='email-container' width='643'> 
         <tbody> 
          <tr> 
           <td> 
            <div class='eddie-page'> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);'> 
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'> 
                 <div align='center' style='border: 0px solid transparent;color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.7; Margin: 0px 25px 10px; max-height: none; max-width: none; padding: 0px; text-decoration: none;'></div> 
                 <div align='center' style='border: 0px solid transparent;color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.7; Margin: 0px 25px 10px; max-height: none; max-width: none; padding: 0px; text-decoration: none;'> 
                  <div> 
                   <br> 
                  </div> 
                 </div></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);'> 
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'><a href='https://api.myperfit.com/v2/shares/zonamigos/campaigns/a36a0d50211f5a159e9b95d5dd80104ec78f1368e5b99f6bf2a2b5bd758e2b81/21/contents/21/$%7Bstore.domain%7D' data-interests='' style='text-decoration: none;' class=''>
                    <img alt='' src='https://i.postimg.cc/grmBd9BY/logo-zonamigos-01-2.png' height='auto' width='250'class='fluid' style='border: 0px solid transparent;height: auto; width: 250px; color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none; min-height: 10px;'></a></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0'border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);' class=''> 
                <td valign='top' class='stack-column' style='width: 100%; overflow: hidden;'> 
                 <div align='center' style='border: 0px solid transparent;color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 33px; font-weight: normal; line-height: 1.35; Margin: 25px 20px 15px; max-height: none; max-width: none; padding: 0px; text-decoration: none;' class=''> 
                  <span style='color: rgb(200, 43, 136);'>
                    <font size='6'>
                        <b>Confirmaci&oacute;n de Correo</b>
                    </font>
                    
                    <b>Electr&oacute;nico</b></span> 
                 </div></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);' class=''> 
                <td valign='top' class='stack-column' style='width: 100%; overflow: hidden;'> 
                 <div align='center' style=': 0px solid transparent;color: rgb(75, 75, 75); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.35; Margin: 15px; max-height: none; max-width: none; padding: 0px; text-decoration: none;' class='> 
                  <span style='color: #4B4B4B;'>
                      <span style='font-size: medium; '><b>Gracias por registrarte a nuestra comunidad!</b></span></span> 
                  <div> 
                   <span style='color: #4B4B4B;'><span style='font-size: medium; '><b><br></b></span></span> 
                  </div> 
                  <div> 
                   <b><font size='3'>Estamos contentos de poder estar cerca tuyo para ayudarte a lograr tus metas y a cumplir tus sue&ntilde;os, a trav&eacute;s&nbsp;de</font><span style='background-color: transparent; font-size: medium;'>&nbsp;una plataforma de beneficios que tenemos para ofrecerte.</span></b> 
                  </div> 
                  <div> 
                   <span style='color: #4B4B4B;'><span style='font-size: medium; '><br></span></span> 
                  </div> 
                 </div></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);' class=''> 
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'> 
                 <div class='eddie-wrapper' style='display: inline-block; Margin: 20px 0px 20px 20px'> 
                 <!--<a href='https://apoyo.zonamigos.com.py' text='Hacé click aquí para confirmar ?' style='border-color: rgb(87, 75, 150); border-style: solid; border-width: 0.6em 1em; color: rgb(255, 255, 255); display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 24px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none; background-color: rgb(87, 75, 150); border-radius: 20px;' class='' data-margin='20px 0px 20px 20px' >Hac&eacute; click aqu&iacute; para confirmar </a> -->
                <a href='http://localhost/apoyo2/zonamigos/gustosintereses.php?key=$ZIGMIECORS&token=$TOKEN' text='Hacé click aquí para confirmar ?' style='border-color: rgb(87, 75, 150); border-style: solid; border-width: 0.6em 1em; color: rgb(255, 255, 255); display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 24px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none; background-color: rgb(87, 75, 150); border-radius: 20px;' class='' data-margin='20px 0px 20px 20px' >Hac&eacute; click aqu&iacute; para confirmar </a> 
                 </div></td>
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);'> 
                <td valign='top' class='stack-column' style='width: 100%; overflow: hidden;'> 
                 <div style='border: 0px solid transparent;color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px 25px; max-height: none; max-width: none; padding: 0px; text-decoration: none; background-color: rgb(125, 105, 113); height: 1px;'></div></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(245, 245, 245);'> 
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'> 
                <!-- 
                <div class='eddie-wrapper' style='display: inline-block; Margin: 20px 20px 10px'> 
                  <a href='https://youtu.be/l4MGLnvqyds' data-interests='' style='text-decoration: none;' class=''><img src='https://i.postimg.cc/dkmHdnDP/logo-zonamigos-01-3.png' alt='Logo' width='100' height='auto' class='fluid' style='border: 0px solid transparent;width: 100px; height: auto; color: rgb(0, 0, 0); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none; min-height: 10px;' data-margin='20px 20px 10px'></a> 
                 </div> 
                 -->
                 <div style='border: 0px solid transparent;color: rgb(75, 75, 75); display: block; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.35; Margin: 10px 20px 20px; max-height: none; max-width: none; padding: 0px; text-decoration: none;'> 
                  <span style='color: #4B4B4B;'><i>2021 @ Todos los derechos reservados.</i></span> 
                 </div></td> 
               </tr> 
              </tbody> 
             </table> 
             <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'> 
              <tbody> 
               <tr style='background-color: rgb(255, 255, 255);'> 
           <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'><span class='eddie-wrapper' style=�display: inline-block; Margin: 20px 10px 20px 0px'><a href='http://www.facebook.com/' data-interests='' style='text-decoration: none;' class=''><img src='https://i.postimg.cc/NyXPGQc0/fb-1.png' alt='Facebook' width='40' height='auto' class='fluid' style='border: 0px solid transparent;width: 40px; height: auto; color: rgb(0, 0, 0); display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none;' data-margin='20px 10px 20px 0px'></a></span><span class='eddie-wrapper' style='display: inline-block; Margin: 20px 10px 20px 0px'><a href='http://instagram.com/' data-interests='' style='text-decoration: none;' class=''><img src='https://i.postimg.cc/YLrXxgm4/instagram.png' alt='Instagram' width='40' height='auto' class='fluid' style='border: 0px solid transparent;width: 40px; height: auto; color: rgb(0, 0, 0); display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none;' data-margin='20px 10px 20px 0px'></a></span><span class='eddie-wrapper' style='display: inline-block; Margin: 20px 10px 20px 0px'><a href='https://es.linkedin.com/' data-interests='' style='text-decoration: none;' class=''><img src='https://i.postimg.cc/3NZ6Y3Hr/linkedin.png' alt='LinkedIn' width='40' height='auto' class='fluid' style='border: 0px solid transparent;width: 40px; height: auto; color: rgb(0, 0, 0); display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.35; Margin: 0px; max-height: none; max-width: none; padding: 0px; text-decoration: none;' data-margin='20px 10px 20px 0px'></a></span></td> 
           </tr>  
              </tbody> 
             </table> 
            </div></td> 
          </tr> 
         </tbody> 
        </table></td> 
      </tr> 
     </tbody> 
    </table>
    
    <!-- begin footer --> 
    
        <table cellspacing='0' cellpadding='1' border='0' style='width: 100%;' align='center'>
            <tbody><tr style='background-color: transparent;'>
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;' height='10'></td>
            </tr>
           
            <tr style='background-color: transparent;'>
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'>
                    <span style='color: #777; font-family: Helvetica, Arial, sans-serif; font-size: 13px; font-weight: normal; line-height: 1.5; '>Este mensaje fue enviado a " . $ZIGMIECORS . " por ZONAMIGOS</span>
                </td>
            </tr>
            <tr style='background-color: transparent;'>
                <td valign='top' align='center' class='stack-column' style='width: 100%; overflow: hidden;'>
                    <span style='color: #777; font-family: Helvetica, Arial, sans-serif; font-size: 13px; font-weight: normal; line-height: 1.5; '>Asuncion, Paraguay</span>
                </td>
            </tr>
        </tbody></table> 
    <!-- end footer --> 
    </body></html>";

        $mail->Body = $mensaje;
        $mail->send();
        //echo 'Mensaje ha sido enviado';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


$app->post('/v20/login', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $ZIGMIECOR = strtolower(trim($request->getParsedBody()['login_var02']));
    $ZIGMIECON = trim($request->getParsedBody()['login_var03']);
  
    // Verificar si el usuario existe en la base de datos
    $connPGSQL = getConnectionMSSQLv1(); // Asegúrate de tener una función que obtenga la conexión a PostgreSQL
    $stmt = $connPGSQL->prepare('SELECT sp_verificar_usuario(?)');
    $stmt->bindParam(1, $ZIGMIECOR, PDO::PARAM_STR);
    $stmt->execute();
    $existe = $stmt->fetchColumn();
    $stmt->closeCursor();

    if ($existe === 1) {
        // Obtener información del usuario si las credenciales son válidas
        $stmt = $connPGSQL->prepare('SELECT * FROM sp_obtener_info_usuario(?)');
        $stmt->bindParam(1, $ZIGMIECOR, PDO::PARAM_STR);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (password_verify($ZIGMIECON, $userInfo['miembro_contrasena'])) {
            // Contraseña válida, continuar con el proceso de inicio de sesión
            try {
                // Resto de tu código...

                // Crear el array $detalle con la información del usuario obtenida del SP
                $detalle = array(
                    'login_correo' => $ZIGMIECOR,
                    'login_miembro_codigo' => $userInfo['miembro_codigo'],
                    'login_miembro_nombre' => $userInfo['miembro_nombre'],
                    'login_miembro_apellido' => $userInfo['miembro_apellido'],
                    'login_miembro_documento' => $userInfo['miembro_documento'],
                    'login_flag_recuperacion' => $userInfo['miembro_flag_recuperacion'],
                    'login_miembro_rol' => $userInfo['rol_usuario'],
                    // Agregar otras variables que necesites del SP aquí...
                );
                $ZIGMIECON = password_hash($ZIGMIECON, PASSWORD_DEFAULT);
                // Respuesta exitosa de inicio de sesión
                $code = 200;
                $message = 'LOGIN';
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                return $json;
            } catch (PDOException $e) {
                // Error en el proceso, respuesta de error
                $code = 500; // Código de error interno del servidor
                $message = 'Internal Server Error';
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => $code, 'status' => 'error', 'message' => $message), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                return $json;
            }
        } else {
            // Contraseña incorrecta, respuesta de error
            $code = 401; // Código de error de autenticación no válida
            $message = 'Contraseña incorrecta.';
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => $code, 'status' => 'error', 'message' => $message), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            return $json;
        }
    } else {
        // Usuario no existe, respuesta de error
        $code = 404; // Código de error de recurso no encontrado
        $message = 'Usuario no encontrado.';
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => $code, 'status' => 'error', 'message' => $message), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        return $json;
    }
});

$app->post('/v20/recuperacion', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $ZIGLOGCOR = trim($request->getParsedBody()['miembro_var07']);
    $fechaActual = date('Y-m-d');

    if (isset($ZIGLOGCOR)) {
        $sql00 = "SELECT
                a.ZIGMIECOD AS  miembro_codigo,
                a.ZIGMIENOM AS  miembro_nombre,
                a.ZIGMIEAPE AS  miembro_apellido,
                a.ZIGMIEDOC AS  miembro_documento,
                a.ZIGMIEFNA AS  miembro_fecha_nacimiento,
                a.ZIGMIECOR AS  miembro_correo,
                a.ZIGMIECON AS  miembro_contrasena,
                a.ZIGMIECEL AS  miembro_celular
                
                FROM public.ZIGMIE a
                WHERE a.ZIGMIECOR = ?";

        //$sql03  = "INSERT INTO [dbo].[ZIGLOG] (ZIGLOGEST, ZIGLOGFEC, ZIGLOGCOR, ZIGLOGPAS, ZIGLOGDIP, ZIGLOGHOS, ZIGLOGAGE, ZIGLOGREF, ZIGLOGAUS, ZIGLOGAFH, ZIGLOGAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?)";

        try {
            $connMSSQL = getConnectionMSSQLv2();

            $stmtMSSQL00 = $connMSSQL->prepare($sql00);
            //$stmtMSSQL03= $connMSSQL->prepare($sql03);

            $stmtMSSQL00->execute([$ZIGLOGCOR]);
            $row_mssql00 = $stmtMSSQL00->fetch(PDO::FETCH_ASSOC);

            if (!$row_mssql00) {
                $ZIGLOGEST = 'ERROR_USER';
                $code = 201;
                $message = 'No existe un usuario con el email ingresado';
            } else {
                $nuevaContrasena = generaContrasena();
                $contrasenaEncriptada = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
                $nombreUsuario = $row_mssql00["miembro_nombre"];
                $correoUsuario = $row_mssql00["miembro_correo"];

                $sql01 = "UPDATE public.ZIGMIE
							SET ZIGMIECON = ?,
                                ZIGMIERECU=1
							WHERE ZIGMIECOR = ?";

                $stmtMSSQL01 = $connMSSQL->prepare($sql01);
                $stmtMSSQL01->execute([$contrasenaEncriptada, $ZIGLOGCOR]);

                $ZIGLOGEST = 'CORRECTO';
                $code = 200;
                $message = 'Se le ha enviado un correo con su nueva contraseña.';

                $stmtMSSQL01->closeCursor();
                $stmtMSSQL01 = null;

                enviarCorreo($nombreUsuario, $correoUsuario, $nuevaContrasena);

                $code = 200;
                $message = 'Se le ha enviado un correo con su nueva contraseña.';
            }

            $detalle = array(
                'resultado' => 'Recuperación Contraseña',
            );
            //$ZIGLOGPAS = password_hash($ZIGLOGPAS, PASSWORD_DEFAULT);
            //$stmtMSSQL03->execute([$ZIGLOGEST, $ZIGLOGFEC, $ZIGLOGCOR, $ZIGLOGPAS, $ZIGLOGDIP, $ZIGLOGHOS, $ZIGLOGAGE, $ZIGLOGREF, $ZIGLOGAUS, $ZIGLOGAIP]);
            $stmtMSSQL00->closeCursor();
            $stmtMSSQL00 = null;
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error RECUPERAR: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, Ingrese su email para recuperar su contrase�?±a.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL = null;

    return $json;
});

$app->post('/v20/cambiocontrasena', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $login = trim($request->getParsedBody()['correo']);
    $contrasena = trim($request->getParsedBody()['contrasena']);
    $nuevacontrasena = trim($request->getParsedBody()['nuevacontrasena']);
    $fechaActual = date('Y-m-d');

    $sql00 = "SELECT
            a.ZIGMIECOD AS  miembro_codigo,
            a.ZIGMIENOM AS  miembro_nombre,
            a.ZIGMIEAPE AS  miembro_apellido,
            a.ZIGMIEDOC AS  miembro_documento,
            a.ZIGMIEFNA AS  miembro_fecha_nacimiento,
            a.ZIGMIECOR AS  miembro_correo,
            a.ZIGMIECON AS  miembro_contrasena,
            a.ZIGMIECEL AS  miembro_celular
            
            FROM [dbo].[ZIGMIE] a
            WHERE a.ZIGMIECOR = ?";

    //$sql03  = "INSERT INTO [dbo].[ZIGLOG] (ZIGLOGEST, ZIGLOGFEC, ZIGLOGCOR, ZIGLOGPAS, ZIGLOGDIP, ZIGLOGHOS, ZIGLOGAGE, ZIGLOGREF, ZIGLOGAUS, ZIGLOGAFH, ZIGLOGAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?)";

    try {
        $connMSSQL = getConnectionMSSQLv2();
        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute([$login]);
        $row_mssql00 = $stmtMSSQL00->fetch(PDO::FETCH_ASSOC);

        if (password_verify($contrasena, $row_mssql00['miembro_contrasena'])) {
            $sql01 = "UPDATE [dbo].[ZIGMIE]
							SET ZIGMIECON = ?
							WHERE ZIGMIECOR = ?";
            $contrasenaEncriptada = password_hash($nuevacontrasena, PASSWORD_DEFAULT);

            $stmtMSSQL01 = $connMSSQL->prepare($sql01);
            $stmtMSSQL01->execute([$contrasenaEncriptada, $login]);
            $stmtMSSQL01->closeCursor();
            $stmtMSSQL01 = null;
            $ZIGLOGEST = 'CORRECTO';
            $code = 200;
            $message = 'Se realizó el cambio de contraseña de manera exitosa.';
        } else {
            $ZIGLOGEST = 'ERROR_PASS';
            $code = 201;
            $message = 'Error: La contraseña ingresada es incorrecta.';
        }
        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;

        $detalle = array(
            'resultado' => 'Cambio de Contraseña',
        );

        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Cambio de Contrase�?±a: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
    $connMSSQL = null;
    return $json;
});

$app->post('/v20/actualizarcontrasena', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $login = trim($request->getParsedBody()['correo']);
    $nuevacontrasena = trim($request->getParsedBody()['nuevacontrasena']);
    $fechaActual = date('Y-m-d');

    //$sql03  = "INSERT INTO [dbo].[ZIGLOG] (ZIGLOGEST, ZIGLOGFEC, ZIGLOGCOR, ZIGLOGPAS, ZIGLOGDIP, ZIGLOGHOS, ZIGLOGAGE, ZIGLOGREF, ZIGLOGAUS, ZIGLOGAFH, ZIGLOGAIP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?)";

    try {
        $connMSSQL = getConnectionMSSQLv2();
        $sql01 = "UPDATE public.ZIGMIE
                        SET ZIGMIECON = ?,
                            ZIGMIERECU = 0
                        WHERE ZIGMIECOR = ?";
        $contrasenaEncriptada = password_hash($nuevacontrasena, PASSWORD_DEFAULT);

        $stmtMSSQL01 = $connMSSQL->prepare($sql01);
        $stmtMSSQL01->execute([$contrasenaEncriptada, $login]);
        $stmtMSSQL01->closeCursor();
        $stmtMSSQL01 = null;
        $ZIGLOGEST = 'CORRECTO';
        $code = 200;
        $message = 'Se realizó el cambio de contraseña de manera exitosa.';

        $detalle = array(
            'resultado' => 'Cambio de Contraseña',
        );

        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Cambio de Contraseña: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
    $connMSSQL = null;
    return $json;
});

function generaContrasena()
{
    //Se define una cadena de caractares.
    //$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@#!â�??¬%&()";
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena = strlen($cadena);
    //Definimos la variable que va a contener la contrase�?±a
    $pass = "";
    $longitudPass = 10;
    //Creamos la contrase�?±a recorriendo la cadena tantas veces como hayamos indicado
    for ($i = 1; $i <= $longitudPass; $i++) {
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos = rand(0, $longitudCadena - 1);
        //Vamos formando la contrase�?±a con cada car�?¡cter aleatorio.
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}

function enviarCorreo($nombreUsuario, $correoElectronico, $nuevaContrasena)
{
    require '../vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
        //Par�?¡metros de Servidor SMTP
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = 0; //Para que no retorne ning�?ºn valor luego de ejecutarse
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "myemail@gmail.com";
        $mail->Password = "123456";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
       
        //$mail->Password   = 'LLNTkb01vG';
        $mail->setFrom('myemail@gmail.com', 'Api Crud');
        //$mail->setFrom('', '');
        //$mail->addAddress('', $nombreUsuario);          
        //$mail->addAddress('', $nombreUsuario);          
        $mail->addAddress($correoElectronico, $nombreUsuario);
        //$mail->addAddress('pedrorubeng@gmail.com', $nombreUsuario);
        // Content
        $mail->isHTML(true);
        //$mail->Subject = 'Recuperaci&oacute;n de Contrase&ntilde;as - ZONAMIGOS';
        $asunto = 'Recuperaciòn de Contraseñas - Api Crud';
        $mail->Subject = "=?ISO-8859-1?B?" . base64_encode(utf8_decode($asunto)) . "=?=";

        $mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
        $mensaje = $mensaje . "<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> ";
        $mensaje = $mensaje . "<meta name='viewport' content='width=device-width'/><link rel='stylesheet' href='css/simple.css'>";
        $mensaje = $mensaje . "<style type='text/css'>* {margin: 0;padding: 0;font-size: 100%;font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;";
        $mensaje = $mensaje . "line-height: 1.65; }img {max-width: 100%;margin: 0 auto;display: block; }body,.body-wrap {width: 100% !important;height: 100%;background: #efefef;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; }";
        $mensaje = $mensaje . "a {color: #71bc37;text-decoration: none; }.text-center {text-align: center; }.text-right {text-align: right; }.text-left {text-align: left; } ";
        $mensaje = $mensaje . ".button {display: inline-block;color: white;background: #FF4498;border: solid #FF4498;border-width: 10px 20px 8px;font-weight: bold;";
        $mensaje = $mensaje . "border-radius: 4px; }h1, h2, h3, h4, h5, h6 {margin-bottom: 20px;line-height: 1.25; }h1 {font-size: 32px; }h2 {font-size: 28px; }";
        $mensaje = $mensaje . "h3 {font-size: 24px; }h4 {font-size: 20px; }h5 {font-size: 16px; }p, ul, ol {font-size: 16px;font-weight: normal;margin-bottom: 20px; }";
        $mensaje = $mensaje . ".container {display: block !important;clear: both !important;margin: 0 auto !important;max-width: 580px !important; }.container table {";
        $mensaje = $mensaje . "width: 100% !important;border-collapse: collapse; }.container .masthead {padding: 80px 0;background: #5922C1;color: white; }.container .masthead h1 {";
        $mensaje = $mensaje . "margin: 0 auto !important;max-width: 90%;text-transform: uppercase; }.container .content {background: white;padding: 30px 35px; }";
        $mensaje = $mensaje . " .container .content.footer {background: none; }.container .content.footer p {margin-bottom: 0;color: #888;text-align: center;font-size: 14px; }.container .content.footer a {";
        $mensaje = $mensaje . "color: #888;text-decoration: none;font-weight: bold; } </style>";
        $mensaje = $mensaje . "</head><body><table class='body-wrap'><tr><td class='container'><table><tr><td align='center' class='masthead'>";
        $mensaje = $mensaje . "<h1>Restablecimiento de Clave</h1></td></tr><tr><td class='content'><h2>Hola " . $nombreUsuario . ",</h2>";
        $mensaje = $mensaje . "<p>Se ha solicitado el restablecimiento de tu clave de acceso al sistema. A continuaci&oacute;n encontrar&aacute;s los datos para acceder:</p>";
        $mensaje = $mensaje . "<p>Clave de Acceso: <b>" . $nuevaContrasena . "</b></p><p></p>";
        $mensaje = $mensaje . "<p style='font-size: smaller;text-align: justify;'>Si no has solicitado el cambio de clave, alguien lo ha solicitado por ti. En cualquier caso, deber&iacute;as de cambiar la contrase&ntilde;a por una m&aacute;s compleja para aumentar la seguridad.</p> ";
        $mensaje = $mensaje . "<table><tr><td align='center'><p><a href='http://nombre.nombredelsitio.com.py/' class='button'>Accede al Sistema</a></p></td>";
        $mensaje = $mensaje . "</tr></table></td></tr></table></td></tr><tr><td class='container'><table><tr>";
        $mensaje = $mensaje . "<td class='content footer' align='center'><p>Producto creado por <a href='https://tucorreohoy.com' target='_blank'>Aldo Consultora</a>, Alberdi-Asunci&oacute;n.</p>";
        $mensaje = $mensaje . "<p><a href='mailto:mail@tecnology.com.py'>conocenos@tecnology.com.py</a></td></tr></table></td></tr></table></body></html>";

        //$mail->Body    = '<p>Hola '.$nombreUsuario." <br> Hemos generado una nueva contraseña para ti:". $nuevaContrasena ."<br> Para acceder a nuestra plataforma visite el siguiente link: https://tucorreohoy.com.py ";
        $mail->Body = $mensaje;
        $mail->send();
        //echo 'Mensaje ha sido enviado';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

/* Agregado */
$app->post('/v20/operacion/busquedausuarios', function ($request) {
    require __DIR__ . '/../src/connect.php';
    $val01 = $request->getAttribute('cmbPerfil');
    $nombre = trim($request->getParsedBody()['nombre']);
    $rol = $request->getParsedBody()['cmbPerfil'];
    $documento = trim($request->getParsedBody()['documento']);
    $sql00 = "SELECT ROW_NUMBER() over (order by M.ZIGMIENOM,M.ZIGMIEAPE ASC) as CORRELATIVO, M.ZIGMIECOD,
                            M.ZIGMIENOM ||'' || M.ZIGMIEAPE AS NOMBRES,
                            M.ZIGMIEDOC,
                            M.ZIGMIECOR,
                            M.ZIGMIECEL,
                            R.CLIROLNAME, R.CLIROLID
                    FROM ZIGMIE M
                    INNER JOIN CLIROL R ON R.CLIROLID=M.ZIGMIEROL " . " WHERE (R.CLIROLID=" . $rol . " OR 0=" . $rol . ") ";
    $sql00 = $sql00 . " AND (UPPER(M.ZIGMIENOM) LIKE UPPER('%" . $nombre . "%') OR UPPER(M.ZIGMIEAPE) LIKE UPPER('%" . $nombre . "%')) ";
    $sql00 = $sql00 . " AND M.ZIGMIEDOC LIKE '%" . $documento . "%' ";
    //$sql00 = $sql00 . "  ORDER BY M.ZIGMIENOM,M.ZIGMIEAPE ASC;";

    try {
        $connMSSQL = getConnectionMSSQLv2();
        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute();
        while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
            $result01 = array();
            $detalle00 = array(
                'correlativo' => $rowMSSQL00['correlativo'],
                'codigo' => $rowMSSQL00['zigmiecod'],
                'nombre_usuario' => $rowMSSQL00['nombres'],
                'numero_documento' => $rowMSSQL00['zigmiedoc'],
                'correo' => $rowMSSQL00['zigmiecor'],
                'celular' => $rowMSSQL00['zigmiecel'],
                'nombre_rol' => $rowMSSQL00['clirolname'],
                'codigo_rol' => $rowMSSQL00['clirolid']
            );
            $result00[] = $detalle00;
        }

        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;

        if (isset($result00)) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        } else {
            $detalle = array(
                'correlativo' => '',
                'codigo' => '',
                'nombre_usuario' => '',
                'numero_documento' => '',
                'correo' => '',
                'nombre_rol' => '',
                'codigo_rol' => ''
            );

            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
    $connMSSQL = null;
    return $json;
});

/* Agregado  */
$app->post('/v20/actualizarusuario', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $codigo = trim($request->getParsedBody()['codigo']);
    $nombre = trim($request->getParsedBody()['nombre']);
    $apellido = trim($request->getParsedBody()['apellido']);
    $documento = trim($request->getParsedBody()['documento']);
    $correo = trim($request->getParsedBody()['correo']);
    $celular = trim($request->getParsedBody()['celular']);
    $rol = trim($request->getParsedBody()['rol']);
    $usuarioACt = trim($request->getParsedBody()['usuarioAct']);
    $fechaActual = date('Y-m-d');

    try {
        $connMSSQL = getConnectionMSSQLv2();
        $sql01 = "UPDATE public.ZIGMIE
                        SET ZIGMIENOM='" . $nombre . "',ZIGMIEAPE='" . $apellido . "',ZIGMIEDOC='" . $documento . "',
                         ZIGMIECEL='" . $celular . "',ZIGMIEROL=" . $rol . "
                        WHERE ZIGMIECOD =" . $codigo;

        $stmtMSSQL01 = $connMSSQL->prepare($sql01);
        $stmtMSSQL01->execute();
        $stmtMSSQL01->closeCursor();
        $stmtMSSQL01 = null;
        $ZIGLOGEST = 'CORRECTO';
        $code = 200;
        $message = 'Se realizó la actualizació de manera exitosa.';

        $detalle = array(
            'resultado' => 'Edició de Usuario',
        );

        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => $code, 'status' => 'ok', 'message' => $message, 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Edici�?³n de Usuario: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
    $connMSSQL = null;
    return $json;
});



$app->post('/v20/operacion/usuarios', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $accion = trim($request->getParsedBody()['accion']);
    $codigo = trim($request->getParsedBody()['codigo']);
    $ZIGMIEEST  = 1;
    $ZIGMIENOM  = ucwords(strtolower(trim($request->getParsedBody()['nombre'])));
    $ZIGMIEAPE  = ucwords(strtolower(trim($request->getParsedBody()['apellido'])));
    $ZIGMIEDOC  = strtoupper(trim($request->getParsedBody()['documento']));
    $ZIGMIECEL  = trim($request->getParsedBody()['celular']);
    $ZIGMIEFNA  = date('Y-m-d', strtotime($request->getParsedBody()['nacimiento']));
    $ZIGMIEFNA_Y = date('Y', strtotime($ZIGMIEFNA));
    $ZIGMIECOR  = strtolower(trim($request->getParsedBody()['email']));
    $ZIGMIECON  = trim($request->getParsedBody()['contrasena']);
    $ZIGMIEAUS  = 'WSZIGO';
    $rol = trim($request->getParsedBody()['rol']);
    $ZIGMIEAFH  = date("Y-m-d");
    $ZIGMIEAIP  = trim($request->getParsedBody()['ip']);

    $auxYEAR    = date('Y') - 18;
    $auxCEL     = strlen($ZIGMIECEL);


    if (!empty($ZIGMIECON)) {


        /* registro de usuario */
        if ($accion == "insert") {
            $sql00  = "SELECT * FROM public.ZIGMIE WHERE ZIGMIECOR = ? OR ZIGMIEDOC = ?";
            $sql01  = "INSERT INTO public.ZIGMIE (ZIGMIEEST, ZIGMIENOM, ZIGMIEAPE, ZIGMIEDOC, ZIGMIEFNA, ZIGMIECOR, ZIGMIECON, ZIGMIECEL, ZIGMIEAUS, ZIGMIEAFH, ZIGMIEAIP, ZIGMIEROL, ZIGMIENIV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?, ?, ?)";
            try {
                $connMSSQL  = getConnectionMSSQLv1();

                $stmtMSSQL00  = $connMSSQL->prepare($sql00);
                $stmtMSSQL00->execute([$ZIGMIECOR, $ZIGMIEDOC]);
                $row_mssql00 = $stmtMSSQL00->fetch(PDO::FETCH_ASSOC);

                if (!$row_mssql00) {
                    $stmtMSSQL01  = $connMSSQL->prepare($sql01);
                    $stmtMSSQL01->execute([$ZIGMIEEST, $ZIGMIENOM, $ZIGMIEAPE, $ZIGMIEDOC, $ZIGMIEFNA, $ZIGMIECOR, $ZIGMIECON, $ZIGMIECEL, $ZIGMIEAUS, $ZIGMIEAIP, $rol, $rol]);

                    $stmtMSSQL01->closeCursor();

                    $stmtMSSQL01 = null;

                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'MIEMBRO'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    $json = json_encode(array('code' => 201, 'status' => 'failure', 'message' => 'Error YA EXISTE UN USUARIO CON ESTE DOCUMENTO ' . $ZIGMIEDOC . ' Y/O CUENTA ' . $ZIGMIECOR), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                }

                $stmtMSSQL00->closeCursor();

                $stmtMSSQL00 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error MIEMBRO: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        }

        if ($accion == "update") {

            $sql01 = "UPDATE  public.ZIGMIE SET ZIGMIENOM='" . $ZIGMIENOM . "', ZIGMIEAPE='" . $ZIGMIEAPE . "', ZIGMIEDOC='" . $ZIGMIEDOC . "', ZIGMIEFNA='" . $ZIGMIEFNA . "' , ZIGMIECOR='" . $ZIGMIECOR . "', ZIGMIECON='" . $ZIGMIECON . "', ZIGMIECEL='" . $ZIGMIECEL . "', ZIGMIEROL='" . $rol . "'
                    WHERE ZIGMIECOD=" . $codigo;
            try {
                $connMSSQL = getConnectionMSSQLv1();

                $stmtMSSQL01 = $connMSSQL->prepare($sql01);
                $stmtMSSQL01->execute();
                $stmtMSSQL01->closeCursor();

                $stmtMSSQL01 = null;

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'MIEMBRO'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);


                $stmtMSSQL00 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error MIEMBRO: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        }
    } else {
        /*actualizar usuario */

        if ($accion == "update") {

            $sql01 = "UPDATE  public.ZIGMIE SET ZIGMIENOM='" . $ZIGMIENOM . "', ZIGMIEAPE='" . $ZIGMIEAPE . "', ZIGMIEDOC='" . $ZIGMIEDOC . "', ZIGMIEFNA='" . $ZIGMIEFNA . "' , ZIGMIECOR='" . $ZIGMIECOR . "',  ZIGMIECEL='" . $ZIGMIECEL . "', ZIGMIEROL='" . $rol . "'
                    WHERE ZIGMIECOD=" . $codigo;
            try {
                $connMSSQL = getConnectionMSSQLv1();

                $stmtMSSQL01 = $connMSSQL->prepare($sql01);
                $stmtMSSQL01->execute();
                $stmtMSSQL01->closeCursor();

                $stmtMSSQL01 = null;

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'MIEMBRO'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);


                $stmtMSSQL00 = null;
            } catch (PDOException $e) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error MIEMBRO: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        }

        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, la contrase�?±a no es v�?¡lido.', 'data' => NULL), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }


    $connMSSQL  = null;

    return $json;
});

