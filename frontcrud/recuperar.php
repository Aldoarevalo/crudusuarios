<?php
    require 'class/function/curl_api.php';
    require 'class/function/function.php';
    if(!isset($_SESSION)){ 
        session_start(); 
	}

	if (isset($_SESSION['registro_01'])) {
		$val_01 = strtolower(trim($_SESSION['registro_01']));
	} else {
		$val_01 = "";
	}
    unset($_SESSION['seg_01']);
    unset($_SESSION['expire']);
    session_unset();
    session_destroy();

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"  />
		<meta name="description" content="Paraguay Dominios, Registro de Dominios.">
		<meta name="author" content="Aldo Arévalo - http">
		
		<!-- ================== BEGIN BASE CSS STYLE ================== -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
		<link href="assets/css/default/app.min.css" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />
		<!-- ================== END BASE CSS STYLE ================== -->

		<!-- ================== BEGIN TOASTR STYLE ================== -->
		<link href="assets/plugins/toastr/build/toastr.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
		<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		<!-- ================== END TOASTR STYLE ================== -->

		<link href="assets/img/logo/icono.png" type="image/vnd.microsoft.icon" rel="shortcut icon"/>

		<!-- Global site tag (gtag.js) - Google reCAPTCHA -->
		 <script src="https://www.google.com/recaptcha/api.js?render=6Le-8qUZAAAAAEPIXn1wZTCHu1SA7iFkxXuyM_UH"></script> 

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-169858561-1"></script> 

		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){
				dataLayer.push(arguments);
			
			}

			gtag('js', new Date());
			gtag('config', 'UA-169858561-1');
		</script>

<style type="text/css">
        .custom-card-bodylogin {
            background-color: #f8f9fa; /* Cambia el color de fondo a tu elección */
            padding: 2rem; /* Ajusta el espaciado interno según sea necesario */
            min-height: 80vh; /* Establece la altura mínima al 100% de la ventana gráfica */
            display: flex;
            flex-direction: column; /* Coloca los elementos hijos en columna */
            justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
            max-width: 600px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
            margin: 0 auto; /* Centra horizontalmente el card en la página */
            /* ...otros estilos... */
        }.custom-resp-body {
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
	font-size: 15px;
    margin-bottom: 0; /* Elimina el margen inferior */
    border: none; /* Elimina cualquier borde si lo hay */
}
		</style>
		
		<title>Paraguay Dominios | Registro de Dominios</title>
	</head>
	
	<body class="pace-top">
		<!-- begin #page-loader -->
		<div id="page-loader" class="fade show">
			<span class="spinner"></span>
		</div>
		<!-- end #page-loader -->
		
		<!-- begin #page-container -->
		<div id="page-container" class="fade">
			<!-- begin register -->
			<div class="register register-with-news-feed">
				<!-- begin news-feed -->
				

				<!-- end news-feed -->

				<!-- begin right-content -->
				<div class="custom-card-bodylogin">
					<!-- begin register-header -->
					<h1 class="register-header">
						Recuperar contraseña
						<small>Accede</small>
					</h1>
					<!-- end register-header -->
					
					<!-- begin register-content -->
					<div class="custom-card-bodylogin">
						<form id="formMiembro" action="class/crud/recuperacion.php" method="POST" class="margin-bottom-0">
					        <div class="form-group">
                               <input type="hidden" id="workCodigo" name="workCodigo" class="form-control"  placeholder="Codigo" value="0" required readonly>
                               <input type="hidden" id="workModo" name="workModo" class="form-control" placeholder="Modo" value="C" required readonly>
                               <input type="hidden" id="workPage" name="workPage" class="form-control" placeholder="Pagina" value="registro" required readonly>
							   <input type="hidden" id="workCaptcha" name="workCaptcha" class="form-control" placeholder="reCaptcha" value="" required readonly>
                           </div>

							<div class="row m-b-15">
								<div class="col-md-12">
								<div class="input-group">
					<div class="input-group-prepend">
                
				<span class="input-group-text"><i class="fas fa-user"></i></span>
			</div> 
									<input type="email" id="val_07" name="val_07" class="form-control" placeholder="Ingrese su Email para recuperar su contraseña"  required />
								</div>
							</div>
							</div>
							<div class="register-buttons">
								<button type="submit" value="Submit" class="btn btn-cuboton btn-block btn-lg" onclick="checkCondiccion('val_09');">Recuperar</button>
							</div>

							<div class="m-t-30">
								Ya Tienes una Cuenta? <a href="index.php"> Inicia tu sesión.</a>
							</div>

							<hr />
							<p class="text-center mb-0">
								Todos los derechos reservados Paraguay Dominios &copy; <?php echo date('Y'); ?>. Diseñado y desarrollado por <a href="https:" target="_blank">Aldo Arévalo</a>
							</p>

							<div id="respuesta" class="card-body col-md-6 custom-resp-body" > 
                            </div>
						</form>
					</div>
					<!-- end register-content -->
				</div>
				<!-- end right-content -->
			</div>
			<!-- end register -->
		</div>
		<!-- end page container -->
		
		<!-- ================== BEGIN BASE JS ================== -->
		<script src="assets/js/app.min.js"></script>
		<script src="assets/js/theme/default.min.js"></script>
		<script src="assets/plugins/switchery/switchery.min.js"></script>
		<script src="assets/js/demo/form-slider-switcher.demo.js"></script>
		<!-- ================== END BASE JS ================== -->

		<!-- ================== BEGIN TOASTR JS ================== -->
		<script src="assets/plugins/toastr/build/toastr.min.js"></script>
		<!-- ================== END TOASTR JS ================== -->

		<script src="js/api.js"></script>
		<script src="js/default.js"></script>
		
		<script>
      function hideResponseMessage() {
        var respuestaDiv = document.getElementById("respuesta");
        respuestaDiv.textContent = ""; // Limpia el contenido del div
    }
	localStorage.clear();
    const $respuesta = document.querySelector("#respuesta");

			<?php
				if ($codeRest == 200) {
			?>
						$(function() {
							toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
							$respuesta.textContent = "Se le ha enviado un correo con su nueva contraseña!.";
                             setTimeout(hideResponseMessage, 9000);
						});
			<?php
			}
				if ($codeRest == 401 || $codeRest == 204 || $codeRest == 201) {
			?>
						$(function() {
							toastr.error('<?php echo $msgRest; ?>', 'Error!');
							$respuesta.textContent = "Error!.";
                            setTimeout(hideResponseMessage, 9000);
						});
			<?php
				}
			?>

			grecaptcha.ready(function() {
				grecaptcha.execute('6Le-8qUZAAAAAEPIXn1wZTCHu1SA7iFkxXuyM_UH', {action: 'submit'}).then(function(token) {
					var var01	= document.getElementById('workCaptcha');
					var01.value	= token;
				});
			});

			selectPrefijo(2);
		</script>
	</body>
</html>