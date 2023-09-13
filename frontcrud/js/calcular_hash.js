const crypto = require('crypto');
const fs = require('fs');

const ruta_archivo = 'jquery-3.6.0.min.js';

function calcular_sha384(ruta) {
    const sha384 = crypto.createHash('sha384');
    const stream = fs.createReadStream(ruta);
    
    return new Promise((resolve, reject) => {
        stream.on('data', (data) => {
            sha384.update(data);
        });

        stream.on('end', () => {
            resolve(sha384.digest('hex'));
        });

        stream.on('error', (error) => {
            reject(error);
        });
    });
}

calcular_sha384(ruta_archivo)
    .then((valor_sha384) => {
        console.log(valor_sha384);
    })
    .catch((error) => {
        console.error('Error al calcular el hash:', error);
    });
