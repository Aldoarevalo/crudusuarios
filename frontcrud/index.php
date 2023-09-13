<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['registro_01'])) {
    $val_01 = strtolower(trim($_SESSION['registro_01']));
} else {
    $val_01 = "";
}

unset($_SESSION['login_01']);
unset($_SESSION['login_02']);
unset($_SESSION['login_03']);
unset($_SESSION['login_04']);
unset($_SESSION['seg_01']);
unset($_SESSION['expire']);
session_unset();
session_destroy();

if (isset($_GET['code'])) {
    $codeRest = $_GET['code'];
    $msgRest = $_GET['msg'];
} else {
    $codeRest = 0;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Api Crud.">
    <meta name="author" content="Aldo Arévalo - https://">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- App CSS -->
    <link href="assets/css/default/app.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="assets/plugins/toastr/build/toastr.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="assets/img/logo/icono.png" type="image/vnd.microsoft.icon" rel="shortcut icon">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-209707015-1"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script>
       window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-209707015-1');
    </script>

    <style type="text/css">
        .custom-card-bodylogin {
            background-color: #e9ecef; /* Cambia el color de fondo a tu elección */
            padding: 2rem; /* Ajusta el espaciado interno según sea necesario */
            min-height: 100vh; /* Establece la altura mínima al 100% de la ventana gráfica */
            display: flex;
            flex-direction: column; /* Coloca los elementos hijos en columna */
            justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
            max-width: 800px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
            margin: 0 auto; /* Centra horizontalmente el card en la página */
            /* ...otros estilos... */
        }

        .custom-card-bodylogin1 {
            background-color:  #f8f9fa; /* Cambia el color de fondo a tu elección  #e9ecef */
            padding: 2rem; /* Ajusta el espaciado interno según sea necesario */
            min-height: 0vh; /* Establece la altura mínima al 100% de la ventana gráfica */
            display: flex;
            flex-direction: column; /* Coloca los elementos hijos en columna */
            justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
            max-width: 600px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
            margin: 0 auto;
            margin-top: 20px; /* Centra horizontalmente el card en la página */
            /* ...otros estilos... */
        }

        .logo-index {
            /* Estilos para centrar la imagen del logo */
            display: block;
            margin: 0 auto;
        }

        .label-bold {
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }
		
		.rotate-image {
    animation: rotateHorizontal 5s linear infinite; /* Animación horizontal durante 5 segundos */
	margin-bottom:20px;
}

@keyframes rotateHorizontal {
    from {
        transform: rotateY(0deg); /* Rotación inicial horizontal */
    }
    to {
        transform: rotateY(360deg); /* Rotación final horizontal */
    }
}
.custom-resp-body {
    background-color: #f8f9fa; /* Cambia el color de fondo a tu elección */
    padding: 0; /* Elimina el espaciado interno */
    min-height: 0; /* Establece la altura mínima a 0 */
    display: flex;
    flex-direction: column; /* Coloca los elementos hijos en columna */
    justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
    max-width: 600px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
    margin: 0 auto; /* Centra horizontalmente el card en la página */
    color: red;
    overflow: hidden; /* Oculta el contenido que exceda el espacio de la tarjeta */
    margin-bottom: 0; /* Elimina el margen inferior */
    border: none; /* Elimina cualquier borde si lo hay */
}
    </style>

    <title>Api Crud | </title>
</head>

<body class="pace-top" onpageshow="if (event.persisted) noBack();">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

	<div id="page-container">
        <div class="card-body px-sm-5 py-5 custom-card-bodylogins label-bold">
            <div class="login-header">
                <div class="brand label-bold text-center">
                    <img class="logo-index rotate-image" src="assets/img/logo/favicon.png" alt="Logo">
					<small class="label-bold" style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: black;font-size: 18px;">Inicio de Sesión Api Crud</small>

                </div>
            </div>
            <div class="card-body px-sm-5 py-5 custom-card-bodylogin1">
            <div id="respuesta" class="card-body col-md-6 custom-resp-body" > 
</div>
                <form class="margin-bottom-0" style="margin-top:10px;" id="loginform" method="post" action="class/session/session_index.php?tipo=1">
                    <div class="form-group m-b-20" >
					
            <div class="input-group">
					<div class="input-group-prepend">
                
				<span class="input-group-text"><i class="fas fa-user"></i></span>
			</div> 
                        <input type="email" id="val_01" name="val_01" value="<?php echo $val_01; ?>" autocomplete="username"
                            class="form-control form-control-lg inverse-mode" placeholder="Ingrese su cuenta" required />
                    </div>
					</div>
					
                    <div class="form-group m-b-20">
					<div class="input-group">

					<div class="input-group-prepend">
             
			 <span class="input-group-text"><i class="fas fa-key"></i></span>
		 </div>
		
            <input type="password" id="val_02" name="val_02" autocomplete="current-password"class="form-control form-control-lg inverse-mode" placeholder="Ingrese su contraseña" required />
			<div class="input-group-append">
         
		 <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
	 </div>	
		</div>
					</div>

                    <div class="login-buttons" style="margin-bottom:30px;">
                        <button type="submit" class="btn btn-cuboton btn-block btn-lg">Iniciar</button>
                    </div>
                    <div class="m-t-20" style="margin-bottom:30px;">
                        ¿Aún no eres miembro? <a href="registro.php">Regístrate</a> para convertir tu sueño en realidad.
                    </div>
                    <div class="m-t-20" style="text-align: center; margin-bottom:30px;">
                        ¿Has olvidado tu contraseña? Haz clic <a href="recuperar.php">aquí</a> para recuperarla.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts al final del body para mejorar el rendimiento -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/theme/default.min.js"></script>
    <script src="assets/plugins/toastr/build/toastr.min.js"></script>

    <script>
        // Función para ocultar el mensaje de respuesta después de un tiempo determinado
    function hideResponseMessage() {
        var respuestaDiv = document.getElementById("respuesta");
        respuestaDiv.textContent = ""; // Limpia el contenido del div
    }
        localStorage.clear();
        const $respuesta = document.querySelector("#respuesta");
        <?php
        if ($codeRest == 200) {
        ?>
        $(function () {
            toastr.success('<?php echo $msgRest; ?>', 'Inicio de Sesión Correcto!');
            $respuesta.textContent = "Inicio de Sesiòn Correcto!.";
            setTimeout(hideResponseMessage, 9000);
        });
        <?php
        }

        if ($codeRest == 500) {
        ?>
        $(function () {
            toastr.error('<?php echo $msgRest; ?>', 'Error interno en el servidor!');
            $respuesta.textContent = "Error Interno en e Servidor.";
            setTimeout(hideResponseMessage, 5000);
        });
        <?php
        }
        ?>

        <?php
        if ($codeRest == 401) {
        ?>
        $(function () {
            toastr.warning('<?php echo $msgRest; ?>', 'Contraseña incorrecta.');
            $respuesta.textContent = "Contraseña incorrecta.";
            setTimeout(hideResponseMessage, 5000);
        });
        <?php
        }
        ?>

<?php
        if ($codeRest == 404) {
        ?>
        $(function () {
            toastr.warning('<?php echo $msgRest; ?>', 'Usuario no encontrado.');
            $respuesta.textContent = "Usuario no encontrado.";
            setTimeout(hideResponseMessage, 5000);
        });
        <?php
        }
        ?>



<?php
        if ($codeRest == 202) {
        ?>
        $(function () {
            toastr.warning('<?php echo $msgRest; ?>', 'Usuario no encontrado.');
            $respuesta.textContent = "Usuario no Encontrado.";
            setTimeout(hideResponseMessage, 5000);
        });
        <?php
        }
        ?>

<?php
        if ($codeRest == 201) {
        ?>
        $(function () {
            toastr.warning('<?php echo $msgRest; ?>', 'Usuario o contraseña inválidos.');
            $respuesta.textContent = "Usuario o contraseña inválidos.";
            setTimeout(hideResponseMessage, 5000);
        });
        <?php
        }
        ?>

    </script>
    <script type="text/javascript">
        window.onload = function () {
            noBack();
        }

        function noBack() {
            window.history.forward();
        }
		function mostrarPassword() {
            var cambio = document.getElementById("val_02");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>
</body>

</html>
