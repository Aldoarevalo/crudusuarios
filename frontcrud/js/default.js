

function changeTextToInt(elem) {
	changeCharAlfa(elem);
	formatNumber(elem);
}

function changeCharEspecial(elem){
    var inpText     = document.getElementById(elem);
    inpReplace      = inpText.value.replace(' ', '').replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '').replace(' ', '');
    inpText.value   = inpReplace;
}

function changeCharAlfa(elem){
    var inpText     = document.getElementById(elem);
    inpReplace      = inpText.value.replace(/[a-zA-Z]/g, '').replace(' ', '').replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '').replace(' ', '');
    inpText.value   = inpReplace;
}

function formatNumber(elem) {
    var intNumber   = document.getElementById(elem);
	intNumber.value = round(intNumber.value);
}

function loadINPUT(elem) {
    var inputIN     = document.getElementById(elem);
	var inputOUT    = document.getElementById('list_'+elem);
	
	if (elem == 'var_102') {
		inputOUT.value  = inputIN.value + ' meses';
	} else {
		inputOUT.value  = inputIN.value;
	}

	if (elem == 'var_203') {
		var inputOUT			= document.getElementById('div_'+elem);
		inputOUT.style.display	= '';
	}
}

function checkCondiccion(elem) {
	/*var acceptCond = document.getElementById(elem).checked;
    if (acceptCond == false) {
        alert('Para completar el registro, favor acepté los términos y condiciones.');
    }*/
}

function cantChar(elem, cant) {
    var inputIN = document.getElementById(elem);
    var inputCAN= inputIN.value.length;

    if (inputCAN < cant) {
        alert('Ingrese un numero de celular correcto.');
        inputIN.value = '';
    }
}

// Calculo pago
function calcpago(){
	var var_101 = document.getElementById("var_101").value;
	var var_1011= var_101.replace(/[.]/g, '');
	var var_102 = document.getElementById("var_102");
	var var_104 = document.getElementById("var_104");
	var var_1041= document.getElementById("list_var_104");
	var var_105 = document.getElementById("var_105");

	if (var_102.value == 0) {
		var_102.value = 6;
	}

	var tasa	= getTasa(6900, var_1011, var_102.value);

//	if (tasa == 0){
//		var_102.value = 12;
//		alert('Favor ingrese un plazo distinto al que esta ingresando.');
//	}

	if (tasa == 0){
		var_104.value	= round(getPayment(var_1011, var_102.value, var_105.value));
		var_1041.value	= var_104.value;
		}

	var_105.value = tasa;

    if (var_1011 > 0 && var_102.value > 0 && var_105.value > 0) {
		var_104.value	= round(getPayment(var_1011, var_102.value, var_105.value));
		var_1041.value	= var_104.value;
        //getAmortization(var_101, var_102, var_105.value);
    }
///////aqui deberia empezar la funcion


monto = document.getElementById('var_101').value;

cantidad = document.getElementById('var_102').value;
montominimo = document.getElementById('montominimo').value;
plazominimo = document.getElementById('plazominimo').value;
plazomaximo = document.getElementById('plazomaximo').value;
console.log('entro')

console.log(monto)

console.log(cantidad)



if (var_1011 == montominimo && cantidad >= 11 ) {
	var_102.value = 6;
	var_1011.value = 1000000;
	swal("Ups", "Con" + monto + " de guaranies solo está permitida hasta 10 cuotas")

	return false;

}



if (var_1011 == 20000001 && cantidad >= 25) {
	var_102.value = 24;
	var_1011.value = 20000000;

	swal("Ups", "Sólo está permitida hasta 20.000.000 de guaranies y un máximo de 24 cuotas")

	return false;

}

if (var_1011 == 20000000 && cantidad >= 25) {
var_102.value = 24;
var_1011.value = 20000000;
	swal("Ups", "Con" + monto + " de guaranies solo está permitida hasta 24 cuotas")

	return false;

}



if (var_1011 >= 20000001) {
	var_102.value = 6;
	var_1011.value = 20000000;
	swal("Ups", "El Monto Máximo es de 20.000.000 de guaranies")

	return false;

}





if (cantidad <= plazominimo - 1 ) {

var_102.value = 6;
var_104.value	= round(getPayment(var_1011, var_102.value, var_105.value));
		var_1041.value	= var_104.value;
	swal("Ups", "El plazo Minimo es de " + plazominimo + " cuotas")

	return false;

}



if (cantidad >= (plazomaximo - 1 + 2)) {

var_102.value = 6;
var_104.value	= round(getPayment(var_1011, var_102.value, var_105.value));
		var_1041.value	= var_104.value;
	swal("Ups", "La cantidad Máxima es de " + plazomaximo + "Cuotas y mí­nimo de " + plazominimo + " Cuotas")

	return false;

}

if (var_1011 <= montominimo - 1 ) {

	swal("Ups", "El monto minimo es de" + montominimo )

	return false;

}

return true;

}

// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribuir este script libremente, pero mantenga este aviso en su sitio
function numbersonly(myfield, e, dec){
	var key;
	var keychar;
        
	if (window.event)
		key = window.event.keyCode;
	else if (e)
		key = e.which;
	else
		return true;
	keychar = String.fromCharCode(key);
        
	// teclas de control
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
		return true;
	// numeros
	else if ((("0123456789").indexOf(keychar) > -1))
		return true;
	// salto de punto decimal
	else if (dec && (keychar == ".")){
		myfield.form.elements[dec].focus();
		return false;
	}
	else
		return false;
}
    
// Author Paul Baggethun
function getAmortization(a,n,p){
	var i=0;
	var sATline="";
	var oAmortizationDiv = document.getElementById("amortizationtable");
	var rows = parseInt(n) + 2;
	if(rows > 30) rows = 30;
	oAmortizationDiv.innerHTML = '<textarea class="form-control" id="amortizationdata" rows="'+rows+'" cols="64" readonly="readonly"></textarea>'; 
	var oAmortizationTable = document.getElementById("amortizationdata");
	oAmortizationTable.style.display="block";
	var sCR=String.fromCharCode(13);
	var sTab=String.fromCharCode(27);
        
	/* Calcula la amortizacion y escribe en el textarea **/
	var payment = getPayment(a,n,p);
	oAmortizationTable.value = sCR + "Pago Mensual = " + round(payment) + sCR + sCR;
	oAmortizationTable.value = "";
	oAmortizationTable.value += "Mes     Capital       Interes       Pago Mensual  Saldo de      " + sCR;
	oAmortizationTable.value += "                                    (Cuota)       Deuda         " + sCR;
	oAmortizationTable.value += "----------------------------------------------------------------" + sCR;
	var balance=a;
	var interest = 0.0;
	var principal=0.0;
	var totalinterest=0.0;
	for (i=1;i<=n;i++) {
		interest = balance*p/1200;
		totalinterest += interest;
		principal = payment-interest;
		balance -= principal;
		//Mes
		sATline = i.toString();
            
		//Capital
		sATline += getSpaces(8-sATline.length);
		sATline += round(principal);
            
		//Interes
		sATline += getSpaces(22-sATline.length);
		sATline += round(interest);
            
		//Pago Mensual
		sATline += getSpaces(36-sATline.length);
		sATline += round(payment);
            
		//Saldo de Deuda
		sATline += getSpaces(50-sATline.length);
		sATline += round(balance);
            
		if(i < n)
			sATline += sCR;
        oAmortizationTable.value += sATline; 
		oAmortizationTable.style.display="block";
    }
 
    oAmortizationTable.value +=
    "\n"+
    "\n"+
    "\n"+
    "\n"+
    "La información resultado de esta simulación es solamente referencial y no implica compromiso o vínculo jurídico, legal o comercial para con ZONAMIGOS."+
    "\n"+
    "La aprobación del crédito está sujeta a la verificación y cumplimiento de los requisitos y documentos que se soliciten."+
    "\n"+
    "Los valores de las cuotas son aproximadas (no incluyen impuestos, seguro de vida y gastos administrativos)."+
    "\n"+
    "Para obtener los valores finales de las cuotas y demás gastos, consulta con un ejecutivo de cuenta de ZONAMIGOS.";
	oAmortizationTable.style.display="block";

}
    
function getSpaces(n) {
	var i=0; 
	var sSpaces="";
	for (i=0;i<n;i++) {
		sSpaces += " ";
	}
	return sSpaces;
}
    
function getPayment(a,n,p) {
	/* Calcula el pago mensual de una tasa de porcentaje anual,  el plazo del prÃƒÂ©amo en meses y la cantidad del prÃƒÂ©amo. **/
	var acc=0;
	var base = 1 + p/1200;
	for (i=1;i<=n;i++) 
	{
		acc += Math.pow(base,-i);
	}
	return a/acc;
}
    
function round(n){
	return thousandSeparator(Math.round(n), '.');
}
    
function thousandSeparator(n,sep) {
	var sRegExp = new RegExp('(-?[0-9]+)([0-9]{3})'),
	sValue=n+"";
        
	if (sep === undefined) {
		sep=',';
	}
	while(sRegExp.test(sValue)) {
		sValue = sValue.replace(sRegExp, '$1'+sep+'$2');
	}
	return sValue;
}
    
function thousandSeparatorChange(oField, sep) {
	var str = replaceAll(oField.value, ".", "");
	oField.value = thousandSeparator(str, sep);
}
    
function zeroremove(oField){
	if (oField.value == "0"){
		oField.value = "";
	}
}
    
function replaceAll( text, busca, reemplaza ){
	while (text.toString().indexOf(busca) != -1)
		text = text.toString().replace(busca,reemplaza);
	return text;
}

function selectPrefijo (inputLoad) {
	var xJSON   	= getPrefijo(2);
	var selPrefijo	= document.getElementById(inputLoad);
	
	if (selPrefijo) { // Verificar si selPrefijo no es null
        while (selPrefijo.length > 0) {
            selPrefijo.remove(0);
        }

        // Resto del código para agregar opciones al select
    }
    
    xJSON.forEach(element => {
		var option      = document.createElement('option');
		option.value    = '0'+ element.prefijo_numero;
		option.text     = '0'+ element.prefijo_numero;                    
		selPrefijo.add(option, null);
    });
}