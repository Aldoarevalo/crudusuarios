<?php
	require '../class/session/session_system.php';
	require '../class/function/curl_api.php';
	require '../class/function/function.php';
	//<!-- Formulario Agregado 26/09/2020 - Mario Vázquez -->
	$headerTitle	= 'Cambio de Contraseña';
	$headerSubTitle = '';
?>
<?php
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
<?php
    	include '../include/header.php';
?>

		<style>
			.header .navbar-nav > li {
				position: initial;
			}
		</style>
	</head>

	<body>
		<!-- begin #page-loader -->
		<div id="page-loader" class="fade show">
			<span class="spinner"></span>
		</div>
		<!-- end #page-loader -->
		
		<!-- begin #page-container -->
		<div id="page-container" class="fade page-sidebar-minified page-sidebar-fixed page-header-fixed">
<?php
    	include '../include/menu.php';
?>

			
		
			<!-- begin #content -->
			<div id="content" class="content">

				<form id="formCambio" action="../class/crud/cambiocontrasena.php" method="POST" onsubmit="return validarFormulario()"  class="margin-bottom-0">

				<!-- begin row -->
				<div class="row row-space-10 m-b-20" style="font-size:1.5rem; color:#fff;">
					
					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->					

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
						<input type="password" id="contrasena" name="contrasena"  class="form-control form-control-lg inverse-mode" placeholder="Ingrese su actual contraseña" required />
					</div>
					<!-- end col-3 -->

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->
				</div>

				<div class="row row-space-10 m-b-20" style="font-size:1.5rem; color:#fff;">	
					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
						<input type="password" id="nuevacontrasena" name="nuevacontrasena"  class="form-control form-control-lg inverse-mode" placeholder="Ingrese su nueva contraseña" required minlength="8" />
					</div>
					<!-- end col-4 -->

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

				</div>
				<!-- end row -->
				
				<div class="row row-space-10 m-b-20" style="font-size:1.5rem; color:#fff;">	
					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
						<input type="password" id="repetircontrasena" name="repetircontrasena"  class="form-control form-control-lg inverse-mode" placeholder="Repetir su nueva contraseña" required minlength="8" />
					</div>
					<!-- end col-4 -->

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

				</div>
				<!-- end row -->

				<div class="row row-space-10 m-b-20" style="font-size:1.5rem; color:#fff;">	
					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
						<button type="submit" class="btn btn-cuboton btn-block btn-lg">Cambiar Contraseña</button>
					</div>
					<!-- end col-4 -->

					<!-- begin col-4 -->
					<div class="col-xl-4 col-sm-4" style="margin-bottom:5px;">
					</div>
					<!-- end col-4 -->	

				</div>
				<!-- end row -->

				</form>
			</div>
			<!-- end #content -->

			<!-- begin #floating-action-button -->
	
			<!-- end #floating-action-button -->

<?php
    	include '../include/development.php';
?>

		</div>
		<!-- end page container -->
		
<?php
    	include '../include/footer.php';
?>
		<script src="../js/api.js"></script>

		<script>
			//localStorage.clear();
			var codCliente	= '<?php echo $usu_00; ?>';
			var silder01	= document.getElementById('sliderDesktop');
			var silder02	= document.getElementById('sliderMovile');
			$('#nuevacontrasena').tooltip({'trigger':'focus', 'title': 'La contraseña debe tener al menos 8 caracteres, y contener al menos una letra mayúscula, una minúscula y un número.'});
			
			/*if (screen.width > 600) {
				silder01.style.display	= '';
				silder02.style.display	= 'none';
			} else {
				silder01.style.display	= 'none';
				silder02.style.display	= '';
			}*/

			<?php
				if ($codeRest == 200) {
			?>
						$(function() {
							toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
						});
			<?php
			}
				if ($codeRest == 401 || $codeRest == 204 || $codeRest == 201) {
			?>
						$(function() {
							toastr.error('<?php echo $msgRest; ?>', 'Error!');
						});
			<?php
				}
			?>

			function validarFormulario() {
				var contrasena = document.forms["formCambio"]["contrasena"].value;
				if (contrasena == "") {
					alert("Tiene que ingresar su contraseña actual.");
					return false;
				}

				var nuevacontrasena = document.forms["formCambio"]["nuevacontrasena"].value;
				if (nuevacontrasena == "") {
					alert("Tiene que ingresar su nueva contraseña.");
					return false;
				}

				var repetircontrasena = document.forms["formCambio"]["repetircontrasena"].value;
				if (repetircontrasena == "") {
					alert("Tiene que reingresar su nueva contraseña.");
					return false;
				}

				if(nuevacontrasena!=repetircontrasena)
				{
					alert("La nueva contraseña y su confirmación deben ser iguales.");
					return false;
				}

				var upperCase= new RegExp('[A-Z]');
				var lowerCase= new RegExp('[a-z]');
				var numbers = new RegExp('[0-9]');
				if(!nuevacontrasena.match(upperCase))
				{
					alert("La nueva contraseña debe tener al menos una letra mayúscula.");
					return false;
				}
				if(!nuevacontrasena.match(lowerCase))
				{
					alert("La nueva contraseña debe tener al menos una letra minúscula.");
					return false;
				}
				if(!nuevacontrasena.match(numbers))
				{
					alert("La nueva contraseña debe tener al menos una número.");
					return false;
				}
				return true;
			}

		</script>
		
	</body>
</html>