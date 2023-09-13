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
$btnEnviar.addEventListener("click", (event) => {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    $respuesta.textContent = "Cargando...";

    // Realizar la validación de los campos antes de enviar
    const errorMessage = validarCampos();
if (errorMessage) {
    // Mostrar mensaje de error si la validación falla
    $respuesta.textContent = errorMessage;
    return false;
}

    // Crear el objeto JSON con los datos del formulario
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

    console.log("Datos del formulario:", data);

    // Codificarlo como JSON
    const datosCodificados = JSON.stringify(data);

    // Enviarlos
    fetch("registro.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: datosCodificados
})
.then(response => response.json())
.then(data => {
    console.log("Valor de data.code:", data.code);
    
    if (data.code === 200) {
        console.log("Registro exitoso");
        toastr.success("Registro exitoso.", data.message);
        $respuesta.textContent = "Registro Exitoso. " + data.message; // Corregido aquí
    } else {
        console.error(data.code); 
        console.log("Error en el registro", data.message);
        toastr.error("Error en el registro. " + data.message, "Error"); // Corregido aquí
        console.error("Error en la petición:", data.code);
        $respuesta.textContent = "Error en el registro. " + data.message; // Corregido aquí
    }
})
.catch(error => {
    console.error("Error en la petición:", error);
    $respuesta.textContent = "Ocurrió un error al procesar la solicitud.";
    toastr.error("Error en la petición, Ocurrió un error al procesar la solicitud." + error, "Error");
    console.error("Error en la petición:", error);
});

});

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
const regexOnlyLetters = /^[A-Za-z�?áÉé�?íÓóÚúÑñ\s]+$/; // Expresión regular que acepta solo letras y espacios
if (nombre.length < 4) {
    return false; // Si el nombre tiene menos de 4 letras, retorna falso
}
return regexOnlyLetters.test(nombre);
}

function mostrarError(message, title) {
toastr.error(message, title, {
    progressBar: true,
    timeOut: 6000, // Duración de la notificación en milisegundos
    positionClass: "toast-top-right" // Posición de la notificación en la pantalla
    // Otros opciones personalizadas aquí
});
}

function validarFecha(fecha) {
// Expresión regular que verifica el formato de fecha en formato yyyy-mm-dd
const regexFecha = /^\d{4}-\d{2}-\d{2}$/;

if (!regexFecha.test(fecha)) {
    return false; // La fecha no tiene el formato adecuado (yyyy-mm-dd)
}

// Convertir la cadena de fecha en un objeto Date y verificar si es válida
const dateObject = new Date(fecha);
return !isNaN(dateObject.getTime());
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
        fetch("http://localhost/apoyo2/zonamigos/class/crud/ciudades.php?codigo=" + encodeURIComponent(codigo))
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

window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);

}

gtag('js', new Date());
gtag('config', 'UA-169858561-1');