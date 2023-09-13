<?php
require 'class/function/curl_api.php';
require 'class/function/function.php';
//require '../class/session/session_system.php';

$headerTitle    = 'Registro de Clientes';
$headerSubTitle = 'Registro';
$solicitudJSON = get_curl('operacion/estados');
$solicitudJSONS = get_curl('operacion/paises');

///ese codigo debe ejecutarse aqui
if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];

	$solicitudJSON2 = get_curl('operacion/ciudades/' . $codigo);

// Configurar la respuesta como JSON

}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Api Crud, Registro de Usuarios.">
    <meta name="author" content="Aldo Arévalo - https://github.com/Aldoarevalo">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN TOASTR STYLE ================== -->
    <link href="assets/plugins/toastr/build/toastr.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
    <!-- ================== END TOASTR STYLE ================== -->

    <link href="assets/img/logo/icono.png" type="image/vnd.microsoft.icon" rel="shortcut icon" />

    <!-- Global site tag (gtag.js) - Google reCAPTCHA -->
    

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169858561-1"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
   
<!-- Enlaces a las librerías y estilos -->


    <script src="assets/plugins/toastr/toastr.js"></script>
  


    <style type="text/css">
        .ocultar {
            display: none;
        }

        .mostrar {
            display: block;
        }
        .action-button {
            background-color: #00cc00;
            color: #fff;
            border: none;
            width: 150px;
            height: 40px;
            margin-top: -20px;
        }
        .custom-card-body {
        background-color: #f8f9fa; /* Cambia el color de fondo a tu elección */
        padding: 2rem; /* Ajusta el espaciado interno según sea necesario */
        min-height: 160vh; /* Establece la altura mínima al 100% de la ventana gráfica */
    display: flex;
    flex-direction: column; /* Coloca los elementos hijos en columna */
    justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
    max-width: 950px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
    margin: 0 auto; /* Centra horizontalmente el card en la página */
    /* ...otros estilos... */
    }
    .custom-register-header {
        text-align: center; /* Centra el texto horizontalmente */
        font-size: 20px; /* Cambia el tamaño de fuente a tu elección */
        margin-bottom: 0px;
    }
    .custom-resp-body {
        background-color: #f8f9fa; /* Cambia el color de fondo a tu elección */
        padding: 1rem; /* Ajusta el espaciado interno según sea necesario */
        min-height: 0vh; /* Establece la altura mínima al 100% de la ventana gráfica */
    display: flex;
    flex-direction: column; /* Coloca los elementos hijos en columna */
    justify-content: space-between; /* Distribuye el espacio verticalmente entre los elementos hijos */
    max-width: 800px; /* Establece el ancho máximo del card a 800px (o el valor que prefieras) */
    margin: 0 auto; /* Centra horizontalmente el card en la página */
    color: red;
    overflow: hidden; /* Oculta el contenido que exceda el espacio de la tarjeta */
    font-size: 16px;
    /*margin-top: -20px; /* Ajusta el margen superior negativo para acercar más el contenido hacia arriba */
    margin-bottom: 0px;
    /* ...otros estilos... */
    }
    .register-content input[type="text"] {
        /*height: calc(1.5em + .875rem + 2px);*/ /* Puedes ajustar este valor según tus necesidades */
       /* font-family: Arial Black;
    font-size: 12px;  */
    font-weight: bold; 
    font-family: Arial, Helvetica, sans-serif;
    }
    .label-bold {
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
    }
    
    .text-left {
        text-align: left;
    }
    </style>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);

        }

        gtag('js', new Date());
        gtag('config', 'UA-169858561-1');
    </script>



    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" >
    </script>
<script src="https://www.google.com/recaptcha/api.js?render=6Le-8qUZAAAAAEPIXn1wZTCHu1SA7iFkxXuyM_UH"></script>

    <title>Api Crud | Registro de Usuario</title>
     <!-- <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">-->
</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div class="card-body px-sm-5 py-5 custom-card-body">
    <div id="page-container" class="fade  mx-auto max-w-800">
        <!-- begin register -->
        <div class="register register-with-news-feed">
       

            <!-- begin right-content -->
            <div class="center-content">
                <div id="msg"></div>

                <!-- Mensajes de Verificación -->


                <!-- begin register-header -->
                <h1 class="register-header custom-register-header" style="margin-top: 8px;">
                    Registrate
                    <small>Registrá tu Dominio hoy</small>
                </h1>
                <!-- end register-header -->
                 <div id="respuesta" class="card-body col-md-6 custom-resp-body" style="margin: auto;"> 

</div>
                <!-- begin register-content -->
                <div class="register-content custom-card-body">
                    <form id="formMiembro"  class="margin-bottom-0" >
                        <div class="form-group">
                            <input type="hidden" id="workCodigo" name="workCodigo" class="form-control" placeholder="Codigo" value="0" required readonly>
                            <input type="hidden" id="workModo" name="workModo" class="form-control" placeholder="Modo" value="C" required readonly>
                            <input type="hidden" id="workPage" name="workPage" class="form-control" placeholder="Pagina" value="registro" required readonly>
                            <input type="hidden" id="workCaptcha" name="workCaptcha" class="form-control" placeholder="reCaptcha" value="" required readonly>
                        </div>

                        <div class="row row-space-10 justify-content-center"  style="margin-top: 1px;">
    <div class="col-md-5 m-b-10  label-bold text-left">
    <label for="val_02" class="label-bold text-left">Nombres</label>
        <input type="text" id="val_02" name="val_02" class="form-control label-bold" placeholder="Nombre" required />
    </div>
    <div class="col-md-5 m-b-10 label-bold text-left">
    <label for="val_03" class="label-bold text-left">Apellidos</label>
        <input type="text" id="val_03" name="val_03" class="form-control label-bold" placeholder="Apellido" required />
    </div>
</div>

<div class="row row-space-10 justify-content-center" style="text-aling:left;">
    <div class="col-md-5 m-b-10 text-left" style="text-aling:left;">
    <label for="pais"class="label-bold tetx-left"  style="text-aling:left;">Pais</label>
        <select id="pais" name="pais" class="form-control label-bold" required onchange="mostrarValor(this.options[this.selectedIndex].innerHTML, this.value)">
        <option class="form-control label-bold tetxt-center" value="" <?php echo ''; ?>>Selecciona tu Pais</option>

<?php
if ($solicitudJSONS != null || $solicitudJSONS != "") {
    foreach ($solicitudJSONS['data'] as $key => $value) {
        if (isset($value['code'])) {
?>
            <option class="form-control label-bold tetxt-center"value="<?php echo $value['code']; ?>"><?php echo $value['descripcion']; ?></option>
<?php
        }
    }
}
?>
        </select>
    </div>
    <div class="col-md-5 m-b-10 label-bold " style="text-aling:left">
    <label for="ciudad"  class="label-bold text-center">Ciudad</label>
    <select id="ciudad" name="ciudad" class="form-control label-bold tetxt-center" required readonly false>
    <option class="form-control label-bold tetxt-center" value="" <?php echo ''; ?>>Selecciona una Ciudad</option>

<?php

////llenar a partir de lo que contenga el campo codigo
if ($solicitudJSONS != null || $solicitudJSONS != "") {
    foreach ($solicitudJSONS['data'] as $key => $value) {
        if (isset($value['codigo'])) {
?>
            <option class="form-control label-bold tetxt-center"value="<?php echo $value['codigo']; ?>"><?php echo $value['ciudad']; ?></option>
<?php
        }
    }
}
?>
                                </select>
    </div>
   
</div>

<script>

    var mostrarValor = function(foo, bar) {
    // Mostrar los valores en los campos
    document.getElementById('comida').value = foo;
    document.getElementById('codigo').value = bar;
  
      // Llenar el combo de ciudad con "Selecciona una Ciudad" y seleccionarlo
    var ciudadCombo = document.getElementById('ciudad');
    ciudadCombo.innerHTML = '<option value="">Selecciona una Ciudad</option>';
    ciudadCombo.value = ""; // Vaciar la selección

    // Llamar a la función para realizar la solicitud AJAX
    obtenerCiudadSeleccionada(bar);
};

function obtenerCiudadSeleccionada(codigo) {
    if (codigo !== "") {
        fetch("class/crud/ciudades.php?codigo=" + encodeURIComponent(codigo))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                var comboCiudades = document.getElementById('ciudad');
                comboCiudades.innerHTML = '';  // Limpia las opciones actuales
                
                if (data.code === 200 && data.data.length > 0) {
                    data.data.forEach(function(ciudad) {
                        var option = document.createElement('option');
                        option.value = ciudad.codigo;
                        option.text = ciudad.ciudad;
                        option.style.fontFamily = 'Arial, Helvetica, sans-serif'; // Aplica el estilo de fuente
                        option.style.fontWeight = 'bold'; // Texto en negrita
                        comboCiudades.appendChild(option);
                    });

                    // Habilita el combo una vez que se han agregado las opciones
                    comboCiudades.disabled = false;
                } else {
                    comboCiudades.disabled = true; // Si no hay opciones válidas, mantén el combo deshabilitado
                }
            })
            .catch(error => {
                // Manejar errores
            });
    }
}

</script>



<input type="hidden" name="comida" id="comida" value="" readonly false />
<input type="hidden" name="codigo" id="codigo" value="" readonly false/>
<input type="hidden" name="codigociudad" id="codigociudad" value="" readonly false/>

                            <div class="row row-space-10">
                                <div class="col-md-10 m-b-10 mx-auto label-bold">
                                <label for="barrio" class="label-bold text-center">Dirección</label>
                                    <input type="text" id="barrio" name="barrio" class="form-control label-bold" placeholder="Dirección Particular"  required />
                                </div>
                            </div>

                            <div class="row row-space-10 justify-content-center">
                            <div class="col-md-5 m-b-10">
                            <label for="val_04"  class="label-bold text-center">Documento</label>
                                    <input type="text" id="val_04" name="val_04" class="form-control label-bold" placeholder="Documento" onblur="changeCharEspecial(this.id);" required />
                                </div>
                                
                                <div class="col-md-5 m-b-10">
                                <label for="val_06"  class="label-bold text-center">Fecha de Nacimiento</label>
                                    <input type="text" id="val_06" name="val_06" class="form-control label-bold text-left" placeholder="Fecha Nacimiento" onfocus="(this.type = 'date')" max="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . "- 18 year")); ?>" required />
                                </div>
                            </div>

                            <div class="row row-space-10 justify-content-center">
                            <div class="col-md-5 m-b-10">
                            <label for="val_04"  class="label-bold text-center">Còdigo</label>
                                <select id="val_05_1" name="val_05_1" class="form-control label-bold">
                                <option class="form-control label-bold" value="0981">0981</option><option value="0982">0982</option><option value="0983">0983</option><option value="0984">0984</option><option value="0985">0985</option><option value="0986">0986</option><option value="0987">0987</option><option value="0971">0971</option><option value="0972">0972</option><option value="0973">0973</option><option value="0974">0974</option><option value="0975">0975</option><option value="0976">0976</option><option value="0977">0977</option><option value="0991">0991</option><option value="0992">0992</option><option value="0993">0993</option><option value="0994">0994</option><option value="0995">0995</option><option value="0996">0996</option><option value="0997">0997</option><option value="0961">0961</option><option value="0962">0962</option><option value="0963">0963</option><option value="0964">0964</option><option value="0965">0965</option><option value="0966">0966</option><option value="0967">0967</option><option value="0224">0224</option><option value="0251">0251</option><option value="0994">0994</option><option value="0529">0529</option><option value="0529">0529</option><option value="0492">0492</option><option value="0318">0318</option><option value="0525">0525</option><option value="0973">0973</option><option value="0631">0631</option><option value="0631">0631</option><option value="0631">0631</option><option value="0294">0294</option><option value="0512">0512</option><option value="0514">0514</option><option value="0519">0519</option><option value="0531">0531</option><option value="0531">0531</option>
                            </select>
                                </div>
                                <div class="col-md-5 m-b-10 ">
                                <label for="val_04"  class="label-bold text-center">Celular</label>
                                    <input type="text" id="val_05" name="val_05" class="form-control label-bold" placeholder="Celular" 
                                       required />
                                </div>
                            </div>
                            <div class="container" style="margin-bottom: 10px;">
    <div class="row">
        <div class="col-md-6 mx-auto label-bold">
        <label for="val_04" class="label-bold text-left">Email</label>
            <div class="input-group">
           
                <div class="input-group-prepend">
                
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>            
                <input type="email" id="val_07" name="val_07" class="form-control label-bold" placeholder="Email para su cuenta" required />
            </div>
        </div>
    </div>
</div>




<div class="container" style="margin-bottom:10px;">
    <div class="row">
        <div class="col-md-6 mx-auto label-bold">
        <label for="val_04" class="label-bold text-left">contraseña</label>
            <div class="input-group">
      
                <div class="input-group-prepend">
             
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="val_08" name="val_08" type="Password" class="form-control unicase-form-control label-bold" placeholder="Contraseña para su cuenta" required minlength="4" onblur="verificarPasswords(this.id);">
                <div class="input-group-append">
         
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-bottom: 10px">
    <div class="row">
        <div class="col-md-6 mx-auto label-bold">
        <label for="val_04" class="label-bold text-left">Confirmar contraseña</label>
            <div class="input-group">
            
                <div class="input-group-prepend">
                
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="confirmar" name="confirmar" type="Password" class="form-control unicase-form-control label-bold" placeholder="Contrasena para su cuenta" required minlength="4" onblur="verificarPasswords(this.id);">
                <div class="input-group-append">
             
                    <button id="show_password1" class="btn btn-primary" type="button" onclick="mostrarPassword1()"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
            </div>
            <div id="error" class="alert alert-danger ocultar label-bold" role="alert">
                Por favor verifica que las credenciales coincidan !
            </div>
            <div id="ok" class="alert alert-success ocultar label-bold" role="alert">
                Las credenciales coinciden !
            </div>
        </div>
    </div>
</div>


                         

                            <div class="text-center"> <!-- Contenedor principal centrado -->
    <div class="checkbox checkbox-css">
        <div class="checkbox checkbox-css m-b-40">
            <input type="checkbox" id="val_09" name="val_09" value="" required>
            <label for="val_09" class="label-bold text-left">
                Al hacer clic en registrarse acepta nuestra <a href="" target="_blank">Pol&iacute;tica de Privacidad, t&eacute;rminos y condiciones.</a>
            </label>
        </div>
    </div>
    
    <label class="label-bold text-left">
        No tienes una cuenta de correo a&uacute;n? Podes darte de alta en algunos de estas cuentas.
    </label>
    <div class="row m-b-15 justify-content-center"> <!-- Centra los elementos de la fila -->
        <div class="col-md-6 text-center col-mb-6">
            <a href="https://accounts.google.com/signup/v2/webcreateaccount?flowName=GlifWebSignIn&flowEntry=SignUp" target="_blank" class="btn btn-sm btn-social btn-google">
                <span class="fab fa-google label-bold"></span> Crear en Google
            </a>
            <a href="https://signup.live.com/?lic=1" target="_blank" class="btn btn-sm btn-social btn-microsoft ml-2">
                <span class="fab fa-windows label-bold"></span> Crear en Hotmail
            </a>
        </div>
    </div>
</div>

<div class="register-buttons text-center mt-5"> <!-- Centra los elementos de registro y botón -->
    <button type="button" id="btnEnviar" name="btnEnviar" value="Submit" class="action-button label-bold">Registrate</button>
</div>

<div class="m-t-30 text-center label-bold"> <!-- Centra el enlace de inicio de sesión -->
    Ya tienes una Cuenta? <a href="index.php"> Inicia tu sesión.</a>
</div>


                            <hr />

                            <p class="text-center mb-0 label-bold">
                                Todos los derechos reservados &copy; <?php echo date('Y'); ?>. Creado y desarrollado por <a href="https://github.com/Aldoarevalo" target="_blank">Aldo Arévalo</a>
                            </p>
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
    </div>
    <!-- end page container -->
      <!-- end card class-->
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/theme/default.min.js"></script>
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <script src="assets/js/demo/form-slider-switcher.demo.js"></script>
    <!-- ================== END BASE JS ================== -->




    <script src="js/api.js?<?php echo date('Ymd'); ?>"></script>
    <script src="js/default.js?<?php echo date('Ymd'); ?>"></script>

    <script>
       // selectPrefijo('val_05_1');

        grecaptcha.ready(function() {
            grecaptcha.execute('6Le-8qUZAAAAAEPIXn1wZTCHu1SA7iFkxXuyM_UH', {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('workCaptcha').value = token;
            });

            setInterval(function() {
                grecaptcha.execute('6Le-8qUZAAAAAEPIXn1wZTCHu1SA7iFkxXuyM_UH', {
                    action: 'homepage'
                }).then(function(token) {
                    document.getElementById('workCaptcha').value = token;
                });
            }, 6000);
        });

        function mostrarPassword() {
            var cambio = document.getElementById("val_08");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function mostrarPassword1() {
            var cambio = document.getElementById("confirmar");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function() {
            $('#ShowPassword').click(function() {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
          

    </script>
 
<script>
    const $formulario = document.getElementById("formMiembro");
    const $btnEnviar = document.querySelector("#btnEnviar");
    const $respuesta = document.querySelector("#respuesta");

    // Obtener valores de los campos del formulario
    const $val02 = document.querySelector("#val_02");
    const $val03 = document.querySelector("#val_03");
    const $val04 = document.querySelector("#val_04");
    const $val05_1 = document.querySelector("#val_05_1");
    const $val05 = document.querySelector("#val_05");
    const $val06 = document.querySelector("#val_06");
    const $val07 = document.querySelector("#val_07");
    const $val08 = document.querySelector("#val_08");
    const $val09 = document.querySelector("#val_09");
    const $pais = document.querySelector("#pais");
    const $ciudad = document.querySelector("#ciudad");
    const $barrio = document.querySelector("#barrio");
    const $workCodigo = document.querySelector("#workCodigo");
    const $workModo = document.querySelector("#workModo");
    const $workPage = document.querySelector("#workPage");
    const $workCaptcha = document.querySelector("#workCaptcha");

    // Agregar listener al botón
$btnEnviar.addEventListener("click", async (event) => {
    event.preventDefault(); // Evitar el envio del formulario por defecto
    $respuesta.textContent = "Cargando...";

    // Realizar la validación de los campos antes de enviar
    const errorMessage = validarCampos();
    if (errorMessage) {
        // Mostrar mensaje de error si la validación falla
        $respuesta.textContent = errorMessage;
        return false;
    }

    // Obtener los valores de los campos del formulario
    const data = {
        miembro_var02: $val02.value,
        miembro_var03: $val03.value,
        miembro_var04: $val04.value,
        miembro_var05: $val05_1.value + $val05.value,
        miembro_var06: $val06.value,
        miembro_var07: $val07.value,
        miembro_var08: $val08.value,
        miembro_var09: $val09.value,
        miembro_var11: $pais.value,
        miembro_var10: $ciudad.value,    
        miembro_var12: $barrio.value,
        workCodigo: $workCodigo.value,
        workModo: $workModo.value,
        workPage: $workPage.value,
        workCaptcha: $workCaptcha.value
    };

    try {
        const response = await fetch("class/crud/registro.php", {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/json;charset=utf-8",
                "Accept": "*/*",
                "Accept-Encoding": "gzip, deflate, br"
            },
            body: JSON.stringify(data)
        });

        const responseData = await response.json();
     console.log("Valor de data.code:", responseData.code);
        if (responseData.code === 200) {
            console.log("Registro exitoso");
            toastr.success(responseData.message + "Bienvenido: "+responseData.usuario);
            $respuesta.textContent =  responseData.message + "Bienvenido: "+ responseData.usuario;
            limpiarCampos();

            setTimeout(function() {
            window.location.href = 'index.php';
							
							}, 25000);
            
        } else {
            console.error(responseData.code); 
            console.log("Error en el registro", responseData.message);
            toastr.error("Error. " + responseData.message);
            console.error("Error en la petición:", responseData.code);
            $respuesta.textContent = "Error en el registro. " + responseData.message;
        }
    } catch (error) {
        console.error("Error en la petición:", error);
        $respuesta.textContent = "Ocurrió un error al procesar la solicitud.";
        toastr.error("Error en la petición. Ocurrió un error al procesar la solicitud." + error, "Error");
        console.error("Error en la petición:", error);
    }
});
/// funcion para limpiar campos 
function limpiarCampos() {
    $val02.value = '';
    $val03.value = '';
    $val04.value = '';
    $val05_1.value = '';
    $val05.value = '';
    $val06.value = '';
    $val07.value = '';
    $val08.value = '';
    $val09.value = '';
    $pais.value = '';
    $ciudad.value = '';
    $barrio.value = '';
    /*$workCodigo.value = '';
    $workModo.value = '';
    $workPage.value = '';
    $workCaptcha.value = '';*/
}

    // Función para validar todos los campos
    function validarCampos() {
    let errorMessage = "";

    if ($val02.value === "") {
        errorMessage = "Por favor, completa el campo Nombre.";
        toastr.error("Por favor, completa el campo Nombre.", "Error");
    } else if (!validarNombre($val02.value)) {
        errorMessage = "Por favor, ingresa un nombre válido en el campo Nombre con un caracter minimo de 4 letras.";
        toastr.error("Por favor, ingresa un nombre válido en el campo Nombre con un caracter minimo de 4 letras.", "Error");
    } else if ($val03.value === "") {
        errorMessage = "Por favor, completa el campo Apellido con un caracter minimo de 4 letras.";
        toastr.error("Por favor, completa el campo Apellido con un caracter minimo de 4 letras.", "Error");
    } else if (!validarNombre($val03.value)) {
        errorMessage = "Por favor, ingresa un apellido válido en el campo Apellido con un caracter minimo de 4 letras.";
        toastr.error("Por favor, ingresa un apellido válido en el campo Apellido con un caracter minimo de 4 letras.", "Error");
    } else if ($pais.value === "Selecciona tu Pais" || !$pais.value) {
        errorMessage = "Por favor, selecciona tu Pais.";
        toastr.error("Por favor, selecciona tu Pais.", "Error");
    } else if ($ciudad.value === "Selecciona una Ciudad" || !$ciudad.value) {
        errorMessage = "Por favor, selecciona una Ciudad.";
        toastr.error("Por favor, selecciona una Ciudad.", "Error");
    }else if ($barrio.value === "") {
        errorMessage = "Por favor, completa el campo Barrio.";
        mostrarError("Por favor, Ingresa un Barrio.", "Error");
    }else if ($val04.value === "" || isNaN($val04.value)) {
        errorMessage = "Por favor, ingresa un número válido en el campo Documento.";
        toastr.error("Por favor, ingresa un número válido en el campo Documento.", "Error");
    }else if ($val06.value === "" || !validarFecha($val06.value)) {
        errorMessage = "Por favor, selecciona una Fecha de Nacimiento válida (yyyy-mm-dd).";
        toastr.error("Por favor, selecciona una Fecha de Nacimiento válida (yyyy-mm-dd).", "Error");
    }else if ($val05.value === "" || !validarCelular($val05.value)) {
    errorMessage = "Por favor, ingresa un número válido en el campo Celular.";
    toastr.error("Por favor, ingresa un número válido en el campo Celular.", "Error");
    }  else if ($val07.value === "") {
        errorMessage = "Por favor, completa el campo Email.";
        toastr.error("Por favor, completa el campo Email.", "Error");
    } else if (!validarEmail($val07.value)) {
        errorMessage = "Por favor, ingresa un correo electrónico válido.";
        toastr.error("Por favor, ingresa un correo electrónico válido.", "Error");
    }  else if (!verificarPasswords()) { // Llamar a la función verificarPasswords
        errorMessage = "La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula y un valor numérico.";
        toastr.error("La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula y un valor numérico.", "Error");
    }
     else if (!$val09.checked) { // Verificar si el campo Términos y Condiciones está marcado
        errorMessage = "Por favor, acepta los términos y condiciones.";
        toastr.error("Por favor, acepta los términos y condiciones.", "Error");
    }

    return errorMessage;
}

// Resto del código...

// Función para validar un correo electrónico
function validarEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
}

function validarNombre(nombre) {
    const regexOnlyLetters = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/; // Expresión regular que acepta solo letras y espacios
    if (nombre.length < 4) {
        return false; // Si el nombre tiene menos de 4 letras, retorna falso
    }
    return regexOnlyLetters.test(nombre);
}

function mostrarError(message, title) {
    toastr.error(message, title, {
        progressBar: true,
        timeOut: 5000, // Duración de la notificación en milisegundos
        positionClass: "toast-top-right" // Posición de la notificación en la pantalla
        // Otros opciones personalizadas aquí
    });
}

function validarFecha(fecha) {
    const regexFecha = /^\d{4}-\d{2}-\d{2}$/;

    if (!regexFecha.test(fecha)) {
        return false; // La fecha no tiene el formato adecuado (yyyy-mm-dd)
    }

    const dateParts = fecha.split("-");
    const year = parseInt(dateParts[0]);
    const month = parseInt(dateParts[1]) - 1;
    const day = parseInt(dateParts[2]);

    const dateObject = new Date(year, month, day);

    // Verificar que el año tenga exactamente 4 dígitos y sea mayor a 1900
    return (
        dateObject.getFullYear() === year &&
        dateObject.getMonth() === month &&
        dateObject.getDate() === day &&
        year.toString().length === 4 &&
        year > 1900
    );
}





function validarCelular(celular) {
    if (celular.length !== 6) {
        return false; // Si el celular no tiene exactamente 6 caracteres, retorna falso
    }
    
    const regexOnlyNumbers = /^[0-9]+$/; // Expresión regular que acepta solo números
    
    if (!regexOnlyNumbers.test(celular)) {
        return false; // Si el celular contiene caracteres que no son números, retorna falso
    }

 
    
    return true;
}

function verificarPasswords() {
    // Obtener los valores de los campos de contraseñas
    var pass1 = document.getElementById('val_08');
    var pass2 = document.getElementById('confirmar');
    var errorDiv = document.getElementById("error");
    var okDiv = document.getElementById("ok");

    // Verificar si la contraseña está vacía
    if (!pass1.value || !pass2.value) {
        // Contraseña vacía, mostrar mensaje de error
        errorDiv.textContent = "Por favor, completa el campo Contraseña.";
        errorDiv.classList.remove("ocultar");
        okDiv.classList.add("ocultar");
    } else if (pass1.value !== pass2.value) {
        // Contraseñas no coinciden, mostrar mensaje de error
        errorDiv.textContent = "Las contraseñas no coinciden.";
        errorDiv.classList.remove("ocultar");
        okDiv.classList.add("ocultar");
    } else {
        // Contraseñas coinciden, verificar si cumple con los requisitos
        const regex = /^(?=.*[A-Z])(?=.*\d).{8,16}$/; // Mínimo 8 caracteres, máximo 16 caracteres
        if (regex.test(pass1.value)) {
            // Contraseña válida, ocultar mensaje de error y mostrar mensaje de "ok"
            errorDiv.classList.add("ocultar");
            okDiv.classList.remove("ocultar");
            return true; // Agregamos esta línea para indicar que la contraseña es válida
        } else {
            // Contraseña no cumple con los requisitos, mostrar mensaje de error
            errorDiv.textContent = "La contraseña debe tener entre 8 y 16 caracteres y contener al menos una letra mayúscula y un valor numérico.";
            errorDiv.classList.remove("ocultar");
            okDiv.classList.add("ocultar");
            return false; // Agregamos esta línea para indicar que la contraseña no es válida
        }
    }
}

</script>

</body>

</html>