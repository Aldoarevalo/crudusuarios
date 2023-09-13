<?php 

if(!isset($_SESSION)){ 

    session_start(); 
	error_reporting(0);
	
}

/*<label >Pais</label>
<select id="" name="" >
<option  value="" <?php echo ''; ?>>Selecciona tu Pais</option>


<?php
if ($solicitudJSONS != null || $solicitudJSONS != "") {
    foreach ($solicitudJSONS['data'] as $key => $value) {
        if (isset($value['extension'])) {
?>
?>
<option class="form-control label-bold tetxt-center"value="<?php echo $value['extension']; ?>"><?php echo $value['extension']; ?></option>
<?php
}
}


</select>*/

?>

<?php /*if ($_SESSION['rol_usuario'] == "4") {
	echo '<h1 style="color:#8a2be2;margin-left:220px;margin-bottom:5px;position:absolute;margin-top:10px;" >Por favor verifica tu cuenta para disfrutar de todos los beneficios</h1><br>';
	echo '<a href="../index.php"><button type="button" name="submit" class="btn btn-cuboton btn-block btn-lg" style="background-color:blue;margin-left:550px;margin-top:100px;width:13%; !important;height:30px; color:#ffffff !important;">Iniciar Sesión</button></a>';

	exit();
}else if($_SESSION['rol_usuario'] == ""){

	echo '<h1 style="color:#8a2be2;margin-left:220px;margin-bottom:5px;position:absolute;margin-top:10px;" >No autorizado</h1><br>';
	echo '<a href="../index.php"><button type="button" name="submit" class="btn btn-cuboton btn-block btn-lg" style="background-color:blue;margin-left:550px;margin-top:100px;width:13%; !important;height:30px; color:#ffffff !important;">Iniciar Sesión</button></a>';

}*/
?>

<?php
    // ... Otro código ...

    if(isset($_SESSION['rol_usuario'])){
        $nombre = ($_SESSION['login_02']);

    } else {
        //$successMsg = "";
    }
?>



<!-- ... Resto de tu código HTML ... -->


<?php

require '../class/function/curl_api.php';

require '../class/function/function.php';

require '../class/session/session_system.php';



$headerTitle	= 'Dashboard';

$headerSubTitle = '';

$solicitudJSONS = get_curl('operacion/extensiones');

//$solicitudJSON	= get_curl('operacion/pendiente/' . $usu_02);

/*$solicitudDesktop	= get_curl('operacion/obtenerBannersActivos/1');

$solicitudMobile	= get_curl('operacion/obtenerBannersActivos/2');*/

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php
			include '../include/header.php';
		?>
<style>
	 .custom-card-body {
        background-color: white; /* Cambia el color de fondo a tu elección */
        padding: 2rem; /* Ajusta el espaciado interno según sea necesario */
        min-height: 80vh; /* Establece la altura mínima al 100% de la ventana gráfica */
    display: flex;
    flex-direction: column; /* Coloca los elementos hijos en columna */
    justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
    max-width: auto; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
    margin: 0 auto; /* Centra horizontalmente el card en la página */
	margin-bottom:0px;
	
    /* ...otros estilos... */
    }/* Estilo para las imágenes debajo de cada grupo */
	.row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .row .col-xl-12 {
            width: 100%;
            margin-bottom: 20px;
        }

        .row h3 {
            font-size: 20px;
            color: #051646;
        }

        .row p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .row label {
            width: 30%;
        }

        .row .input-group {
            width: 70%;
        }

        .row select,
        .row input[type="text"],
        .row button {
           
            font-size: 16px;
			border: 0px solid #333; /* Cambia el color del borde aquí */
            border-radius: 5px;
            margin-right: 0px;
        }

        .row button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
		.input-container {
        border: 1px solid #333; /* Borde alrededor del contenedor */
        border-radius: 5px; /* Borde redondeado */
        display: flex; /* Para que los elementos internos estén en línea */
    }

    .input-container input,
    .input-container select,
    .input-container button {
        border: none; /* Elimina los bordes de los elementos internos */
    }ul.domain_tlds_list li img {
    width: 30px; /* Ajusta el ancho deseado */
    height: 30px; /* Ajusta la altura deseada */
} .custom-resp-body {
        background-color: white; /* Cambia el color de fondo a tu elección */
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
    }/* Estilos para la tabla */
  #resultTable {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
  }

  /* Estilos para las celdas de encabezado */
  #resultTable th {
    background-color: #007bff;
    color: white;
    padding: 10px;
    font-size: 20px;
  }

  /* Estilos para las celdas de datos */
  #resultTable td {
    padding: 8px;
    text-align: center;
    border: 1px solid #ccc;
    color:#6820c6;
    font-size: 16px;
  }

  /* Estilos para filas alternadas */
  #resultTable tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
  }

  /* Estilos para filas pares */
  #resultTable tbody tr:nth-child(even) {
    background-color: #ffffff;
  }

  /* Estilos para el botón */
  #btnConsultar {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
  }/* Estilos para los botones */
.action-button {
  background-color: #007bff; /* Color de fondo azul */
  color: #fff; /* Color del texto blanco */
  border: none;
  padding: 8px 16px; /* Relleno interno */
  margin-right: 10px; /* Margen a la derecha entre botones */
  border-radius: 4px; /* Borde redondeado */
  cursor: pointer; /* Cambiar cursor al pasar el mouse */
}

/* Estilos para el contenedor de botones adicionales */
.botones-adicionales {
  margin-top: 10px; /* Margen superior entre la cabecera y los botones */
  text-align: center; /* Centrar los botones */
}

/* Estilos para los botones adicionales */
.otro-boton, .boton-adicional {
  background-color: #007bff; /* Color de fondo verde para los botones adicionales */
  color: #fff;
  border: none;
  padding: 6px 12px;
  margin: 4px; /* Margen entre los botones adicionales */
  border-radius: 4px;
  cursor: pointer;
}

	</style>
	<script>
   /* $(document).ready(function() {
        // Oculta el formulario al principio
        $("#page-container").hide();

        // Muestra el formulario con efecto "explode"
        $("#page-container").show("explode", { pieces: 16 }, 1000); // Puedes ajustar la duración y el número de piezas según tus preferencias
    });*/
</script>
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript de Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	</head>

	<body>
		<!-- begin #page-loader -->
		<div id="page-loader" class="fade show">
			<span class="spinner"></span>
		</div>
		<!-- end #page-loader -->
  
		<!-- begin #page-container -->
		<div  id="page-container" neme="page-container" class="fade page-sidebar-minified page-sidebar-fixed page-header-fixed">
			<?php
					include '../include/menu.php';
			?>

			<!-- begin #content -->
			<div id="content" class="content col-xl-20 custom-card-body" style="text-align: center;">
      
			
                    <form id="myform" name="myform"  action="" method="post" style="margin-top: 0px;">
					<div class="row">
    <div class="col-xl-12" >
    <h3 id="respuesta" name="respuesta" class="custom-resp-body" style="margin: auto;margin-bottom: 15px;color: red;" ></h3>
	<h3 class="color_051646" style="color: #6820c6;"></h3>
                <p style="color: #6820c6;margin-bottom:25px;">!</p>
             


                    </form>
          
       
    </div>

   
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

		<!-- <script src="../js/api.js"></script>-->
     


		
	</body>
</html>