
function getDominio(codDominio){
    if (localStorage.getItem('dominioJSON') === null){
        getJSON('dominioJSON', '100/dominio');
    }

    var xJSON = JSON.parse(localStorage.getItem('dominioJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            if (element.tipo_dominio == codDominio) {
                xDATA.push(element);
            }
        });
    }

    return xDATA;
}

function getOpePendiente(codElem){
    if (localStorage.getItem('opePendienteJSON') === null){
        getJSON('opePendienteJSON', 'operacion/pendiente/'+codElem);
    }

    var xJSON = JSON.parse(localStorage.getItem('opePendienteJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getOpeDetalle(codElem){
    if (localStorage.getItem('opeDetalleJSON_'+codElem) === null){
        getJSON('opeDetalleJSON_'+codElem, 'operacion/detalle/'+codElem);
    }

    var xJSON = JSON.parse(localStorage.getItem('opeDetalleJSON_'+codElem));
    var xDATA = [];

    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getTasa(valMoneda, valMonto, valPlazo){
    if (localStorage.getItem('tasaJSON') === null){
        getJSON('tasaJSON', 'operacion/parametros');
    }

    var xJSON = JSON.parse(localStorage.getItem('tasaJSON'));
    var xDATA = 0;

    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            if (valMoneda == element.importe_moneda && valPlazo >= element.plazo_desde && valPlazo <= element.plazo_desde && valMonto >= element.importe_desde && valMonto <= element.importe_hasta) {
                xDATA = element.plazo_tasa;
            }
        });
    }

    return xDATA;
}

function getPrefijo(codElem){
    if (localStorage.getItem('prefijoJSON') === null){
        getJSON('prefijoJSON', 'prefijo');
    }

    var xJSON = JSON.parse(localStorage.getItem('prefijoJSON'));
    var xDATA = [];

    switch (codElem) {
        case 1:
            if (xJSON['code'] == 200){
                xJSON['data'].forEach(element => {
                    if (element.prefijo_tipo == 'TELEFONO') {
                        xDATA.push(element);
                    }
                });
            }

            break;
    
        case 2:
            if (xJSON['code'] == 200){
                xJSON['data'].forEach(element => {
                    if (element.prefijo_tipo == 'CELULAR') {
                        xDATA.push(element);
                    }
                });
            }

            break;

        case 3:
            if (xJSON['code'] == 200){
                xJSON['data'].forEach(element => {
                    xDATA.push(element);
                });
            }

            break;
    }
    
    return xDATA;
}