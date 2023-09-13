<?php
//PRODUCCION
$app->get('/v20/operacion/obtenermiembro/{codigo}', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $val01      = $request->getAttribute('codigo');

    if (isset($val01)) {
        $sql00  = "SELECT ZIGMIECOD, ZIGMIECOR, email_verification_link, ZIGMIENOM
                   FROM ZIGMIE WHERE ZIGMIECOR  =?";

        try {
            $connMSSQL  = getConnectionMSSQLv2();
            $stmtMSSQL00 = $connMSSQL->prepare($sql00);
            $stmtMSSQL00->execute([$val01]);

            while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
                $result01 = array();
                $detalle00      = array(
                    'codigo'                      => $rowMSSQL00['ZIGMIECOD'],
                    'correo'                      => $rowMSSQL00['ZIGMIECOR'],
                    'link'                    => $rowMSSQL00['email_verification_link'],
                    'nombre'                    => $rowMSSQL00['ZIGMIENOM']

                );

                $result00[]     = $detalle00;
            }
            $stmtMSSQL00->closeCursor();
            $stmtMSSQL00 = null;
            if (isset($result00)) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'codigo'                    => '',
                    'correo'                    => '',
                    'link'                  => ''

                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algÃºn campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL  = null;

    return $json;
});

$app->get('/v10/prefijo', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $sql00      = "SELECT 
            a.CelLBId       AS      prefijo_codigo, 
            a.CelLB         AS      prefijo_numero, 
            a.CelLBTipo     AS      prefijo_tipo 
            FROM PrefCelLB a
            ORDER BY a.CelLBTipo";

    try {
        $connMSSQL  = getConnectionMSSQLv1();

        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute();

        while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
            $detalle        = array(
                'prefijo_codigo'            => $rowMSSQL00['prefijo_codigo'],
                'prefijo_numero'            => $rowMSSQL00['prefijo_numero'],
                'prefijo_tipo'              => strtoupper(trim($rowMSSQL00['prefijo_tipo']))
            );

            $result[]       = $detalle;
        }

        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;

        if (isset($result)) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        } else {
            $detalle = array(
                'prefijo_codigo'            => '',
                'prefijo_numero'            => '',
                'prefijo_tipo'              => ''
            );

            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL  = null;

    return $json;
});

$app->get('/v20/prefijo', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $sql00      = "SELECT 
            a.CelLBId       AS      prefijo_codigo, 
            a.CelLB         AS      prefijo_numero, 
            a.CelLBTipo     AS      prefijo_tipo 
            FROM PrefCelLB a
            ORDER BY a.CelLBTipo";

    try {
        $connMSSQL  = getConnectionMSSQLv2();

        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute();

        while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
            $detalle        = array(
                'prefijo_codigo'            => $rowMSSQL00['prefijo_codigo'],
                'prefijo_numero'            => $rowMSSQL00['prefijo_numero'],
                'prefijo_tipo'              => strtoupper(trim($rowMSSQL00['prefijo_tipo']))
            );

            $result[]       = $detalle;
        }

        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;

        if (isset($result)) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        } else {
            $detalle = array(
                'prefijo_codigo'            => '',
                'prefijo_numero'            => '',
                'prefijo_tipo'              => ''
            );

            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL  = null;

    return $json;
});

//
$app->get('/v20/operacion/usuarios', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $sql00 = "SELECT ROW_NUMBER() over (ORDER BY M.ZIGMIENOM, M.ZIGMIEAPE ASC) as CORRELATIVO, M.ZIGMIECOD,
                    M.ZIGMIENOM || ' ' || M.ZIGMIEAPE AS NOMBRES,
                    M.ZIGMIEDOC,
                    M.ZIGMIECOR,
                    M.ZIGMIECEL,
                    R.CLIROLNAME, R.CLIROLID
            FROM ZIGMIE M
            INNER JOIN CLIROL R ON R.CLIROLID=M.ZIGMIEROL;";

    try {
        $connMSSQL = getConnectionMSSQLv1();
        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute();

        $result00 = array();
        while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
            $detalle00 = array(
                'correlativo'      => $rowMSSQL00['correlativo'],
                'codigo'           => $rowMSSQL00['zigmiecod'],
                'nombre_usuario'   => $rowMSSQL00['nombres'],
                'numero_documento' => $rowMSSQL00['zigmiedoc'],
                'correo'           => $rowMSSQL00['zigmiecor'],
                'celular'          => $rowMSSQL00['zigmiecel'],
                'nombre_rol'       => $rowMSSQL00['clirolname'],
                'codigo_rol'       => $rowMSSQL00['clirolid']
            );
            $result00[] = $detalle00;
        }

        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;

        if (!empty($result00)) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

              // Imprimir en el log
    error_log("Resultado del SELECT: " . print_r($result00, true));
        } else {
            $detalle = array(
                'correlativo'     => '',
                'codigo'          => '',
                'nombre_usuario'  => '',
                'numero_documento' => '',
                'correo'          => '',
                'nombre_rol'      => '',
                'codigo_rol'      => ''
            );

            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e->getMessage()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }
    $connMSSQL = null;
    return $json;
});


//
$app->get('/v20/operacion/roles', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $sql00 = "SELECT M.CLIROLID,
                            M.CLIROLNAME
                    FROM public.CLIROL M";
    try {
        $connMSSQL  = getConnectionMSSQLv2();
        $stmtMSSQL00 = $connMSSQL->prepare($sql00);
        $stmtMSSQL00->execute();
        while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
            $result01 = array();
            $detalle00      = array(
                'codigo'                                => $rowMSSQL00['clirolid'],
                'nombre_rol'                        => $rowMSSQL00['clirolname']
            );
            $result00[]     = $detalle00;
        }
        $stmtMSSQL00->closeCursor();
        $stmtMSSQL00 = null;
        if (isset($result00)) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        } else {
            $detalle = array(
                'codigo'                      => '',
                'nombre_rol'                  => ''
            );

            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } catch (PDOException $e) {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
    $connMSSQL  = null;
    return $json;
});

// 
$app->get('/v20/operacion/obtenerUsuario/{codigo}', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $val01      = $request->getAttribute('codigo');

    if (isset($val01)) {
        $sql00  = "SELECT ZIGMIECOD,ZIGMIENOM,ZIGMIEAPE,ZIGMIEDOC,ZIGMIECOR,ZIGMIECEL,ZIGMIEROL, ZIGMIEFNA
                       FROM ZIGMIE WHERE ZIGMIECOD=?";

        try {
            $connMSSQL  = getConnectionMSSQLv2();
            $stmtMSSQL00 = $connMSSQL->prepare($sql00);
            $stmtMSSQL00->execute([$val01]);

            while ($rowMSSQL00 = $stmtMSSQL00->fetch()) {
                $result01 = array();
                $detalle00      = array(
                    'codigo'                      => $rowMSSQL00['zigmiecod'],
                    'nombre'                      => $rowMSSQL00['zigmienom'],
                    'apellido'                    => $rowMSSQL00['zigmieape'],
                    'nro_documento'               => $rowMSSQL00['zigmiedoc'],
                    'correo'                      => $rowMSSQL00['zigmiecor'],
                    'celular'                     => $rowMSSQL00['zigmiecel'],
                    'rol'                         => $rowMSSQL00['zigmierol'],
                    'nacimiento'                  => $rowMSSQL00['zigmiefna']
                );

                $result00[]     = $detalle00;
            }
            $stmtMSSQL00->closeCursor();
            $stmtMSSQL00 = null;
            if (isset($result00)) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success SELECT', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'codigo'                    => '',
                    'nombre'                    => '',
                    'apellido'                  => '',
                    'nro_documento'             => '',
                    'correo'                    => '',
                    'celular'                   => '',
                    'rol'                       => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error SELECT: ' . $e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algÃºn campo esta vacio.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL  = null;

    return $json;
});




$app->get('/v20/operacion/paises', function ($request) {
    require __DIR__ . '/../src/connect.php';
    require __DIR__ . '/archivo.php';

    try {
        $resultados_api = get_countries();
        $response = json_decode($resultados_api, true);
        error_log("Contenido de \$response: " . json_encode($response));

        // Verificar si el código en la respuesta es "200"

        
        if (!empty($response)) {
            foreach ($response as $pais) {
                $code = isset($pais['code']) ? $pais['code'] : 'No se pudo obtener el código';
                $descripcion = isset($pais['desc']) ? $pais['desc'] : 'No se pudo obtener la descripción';
        
                $response1[] = array(
                    'code' => $code,
                    'descripcion' => $descripcion
                );
            }
            // Construir la respuesta JSON con los datos de la API
            error_log("imprimiendo desde la api");
            error_log("Contenido de \$response1: " . json_encode($response1));
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success', 'data' => $response1), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            echo $json; // Imprimir la respuesta JSON con los datos de la API
            
            $connMSSQL = getConnectionMSSQLv1();
           // var_dump("conectado",$connMSSQL);
            // Crea la tabla si no existe
            /*$sqlCreateTable = "CREATE TABLE IF NOT EXISTS dominios.public.paises (
                country_code VARCHAR(2) PRIMARY KEY,
                descripcion VARCHAR(255),
                last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $connMSSQL->exec($sqlCreateTable);*/

            // Realizar otras operaciones (por ejemplo, insertar en la base de datos)
          //  $connMSSQL = getConnectionMSSQLv1();
          foreach ($response1 as $pais) {
            $sqlInsert = "CALL public.insertar_pais(:country_code, :descripcion)";
            $stmt = $connMSSQL->prepare($sqlInsert);
            $stmt->bindParam(':country_code', $pais['code']);
            $stmt->bindParam(':descripcion', $pais['descripcion']);
            $stmt->execute();
        }
        
            
            // Cerrar la conexión a la base de datos
            $connMSSQL = null;
        } else {
            // La API no devolvió datos o devolvió un código distinto de 200
            // Intenta obtener los datos de la tabla en la base de datos

            // Realizar una llamada al procedimiento almacenado para obtener los datos de la tabla
            $connMSSQL = getConnectionMSSQLv1();
            $sqlCallProcedure = "select * from obtener_paises()";
            $stmt = $connMSSQL->prepare($sqlCallProcedure);
            $stmt->execute();
            $resultados_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($resultados_bd)) {
                // Construir la respuesta JSON con los datos de la tabla
                error_log("imprimiendo desde la bd");

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success', 'data' => $resultados_bd), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                echo $json; // Imprimir la respuesta JSON con los datos de la tabla
            
            } else {
                // Construir una respuesta con código 204 si no hay datos en la tabla
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'no_content', 'message' => 'No data available'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
                echo $json; // Imprimir la respuesta JSON con código 204
            }

            // Cerrar la conexión a la base de datos
            $connMSSQL = null;
        }
    } catch (PDOException $e) {
        // Manejo de errores en la base de datos
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 500, 'status' => 'error', 'message' => 'Database error: ' . $e->getMessage()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        echo $json;
    } 
});



///sp para obtener una ciudad
$app->get('/v20/operacion/ciudades/{codigo}', function ($request) {
    require __DIR__ . '/../src/connect.php';

    $val01 = $request->getAttribute('codigo');

    if (isset($val01)) {
        try {
            $connMSSQL = getConnectionMSSQLv1();
            $stmtMSSQL = $connMSSQL->prepare("SELECT * FROM obtener_ciudadesone(:codigo)");
            $stmtMSSQL->bindParam(':codigo', $val01, PDO::PARAM_INT);
            $stmtMSSQL->execute();

            $result00 = array();
            while ($rowMSSQL00 = $stmtMSSQL->fetch()) {
                $detalle00 = array(
                    'codigo' => $rowMSSQL00['idciudades'],
                    'ciudad' => $rowMSSQL00['ciudad']
                );
                $result00[] = $detalle00;
            }

            if (!empty($result00)) {
                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 200, 'status' => 'ok', 'message' => 'Success CALL', 'data' => $result00), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            } else {
                $detalle = array(
                    'codigo' => '',
                    'ciudad' => ''
                );

                header("Content-Type: application/json; charset=utf-8");
                $json = json_encode(array('code' => 204, 'status' => 'ok', 'message' => 'No hay registros', 'data' => $detalle), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            }

            $stmtMSSQL->closeCursor();
            $stmtMSSQL = null;
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            $json = json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error CALL: ' . $e->getMessage()), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
        }
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $json = json_encode(array('code' => 400, 'status' => 'error', 'message' => 'Verifique, algún campo está vacío.'), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }

    $connMSSQL = null;

    return $json;
});







