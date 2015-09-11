<?php

function obtenerEventos() {
    $conectActual = conectar();

    $sql = "SELECT idEvento, tituloEvento, nombreEventoUrl, lugarEvento, fechaInicioEvento, fechaFinEvento, 
            imagenEvento, descripcionEvento, cuerpoEvento, destacadoEvento
            FROM evento
            WHERE estadoEvento = 'A'
            ORDER BY fechaInicioEvento DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $eventos = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($eventos, $result);
    }

    return $eventos;
}

function obtenerEventosHome() {
    $conectActual = conectar();

    $sql = "SELECT idEvento, tituloEvento, nombreEventoUrl, lugarEvento, fechaInicioEvento, fechaFinEvento, 
            imagenEvento, descripcionEvento, cuerpoEvento, destacadoEvento
            FROM evento
            WHERE estadoEvento = 'A'
            ORDER BY fechaInicioEvento DESC
            LIMIT 0,2";
    $stmt = mysqli_query($conectActual, $sql);

    $eventos = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($eventos, $result);
    }

    return $eventos;
}

function obtenerEventosSlide() {
    $conectActual = conectar();

    $sql = "SELECT idEvento, tituloEvento, nombreEventoUrl, imagenEvento, imagenSlideEvento, lugarEvento, fechaInicioEvento, descripcionEvento, destacadoEvento
            FROM evento
            WHERE estadoEvento = 'A'
            AND destacadoEvento = 't'
            ORDER BY fechaInicioEvento DESC
            LIMIT 0,2";
    $stmt = mysqli_query($conectActual, $sql);

    $eventos = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($eventos, $result);
    }

    return $eventos;
}

function obtenerEventoPorNombreUrl($nombreEventoUrl) {
    $conectActual = conectar();

    $sql = "SELECT idEvento, tituloEvento, nombreEventoUrl, lugarEvento, imagenEvento, imagenSlideEvento,
            fechaInicioEvento, fechaFinEvento, descripcionEvento, cuerpoEvento, destacadoEvento
            FROM evento
            WHERE nombreEventoUrl = ?
            AND estadoEvento = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreEventoUrl);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idEvento, $tituloEvento, $nombreEventoUrl, $lugarEvento, $imagenEvento, $imagenSlideEvento, $fechaInicioEvento, $fechaFinEvento, $descripcionEvento, $cuerpoEvento, $destacadoEvento);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idEvento' => $idEvento,
            'tituloEvento' => $tituloEvento,
            'nombreEventoUrl' => $nombreEventoUrl,
            'lugarEvento' => $lugarEvento,
            'imagenEvento' => $imagenEvento,
            'imagenSlideEvento' => $imagenSlideEvento,
            'fechaInicioEvento' => $fechaInicioEvento,
            'fechaFinEvento' => $fechaFinEvento,
            'descripcionEvento' => $descripcionEvento,
            'cuerpoEvento' => $cuerpoEvento,
            'destacadoEvento' => $destacadoEvento
        );
    } else {
        $result = array(
            'idEvento' => false,
            'tituloEvento' => false,
            'nombreEventoUrl' => false,
            'lugarEvento' => false,
            'imagenEvento' => false,
            'imagenSlideEvento' => false,
            'fechaInicioEvento' => false,
            'fechaFinEvento' => false,
            'descripcionEvento' => false,
            'cuerpoEvento' => false,
            'destacadoEvento' => false
        );
    }

    return $result;
}

function obtenerImagenesPorIdEvento($idEvento) {
    $conectActual = conectar();

    $sql = "SELECT idImagenEvento, nombreImagenEvento, idEvento
            FROM imagen_evento
            WHERE idEvento = ?
            AND estadoImagenEvento = 'A'
            ORDER BY fechaCargaImagenEvento";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idEvento);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idImagenEvento, $nombreImagenEvento, $idEvento);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idImagenEvento' => $idImagenEvento,
                'nombreImagenEvento' => $nombreImagenEvento,
                'idEvento' => $idEvento,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerVideosPorIdEvento($idEvento) {
    $conectActual = conectar();

    $sql = "SELECT idVideoEvento, nombreVideoEvento, idEvento
            FROM video_evento
            WHERE idEvento = ?
            AND estadoVideoEvento = 'A'
            ORDER BY fechaCargaVideoEvento";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idEvento);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idVideoEvento, $nombreVideoEvento, $idEvento);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idVideoEvento' => $idVideoEvento,
                'nombreVideoEvento' => $nombreVideoEvento,
                'idEvento' => $idEvento,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerArchivosPorIdEvento($idEvento) {
    $conectActual = conectar();

    $sql = "SELECT idArchivoEvento, nombreArchivoEvento, tituloArchivoEvento
            FROM archivo_evento
            WHERE idEvento = ?
            AND estadoArchivoEvento = 'A'
            ORDER BY fechaCargaArchivoEvento";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idEvento);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idArchivoEvento, $nombreArchivoEvento, $tituloArchivoEvento);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idArchivoEvento' => $idArchivoEvento,
                'nombreArchivoEvento' => $nombreArchivoEvento,
                'tituloArchivoEvento' => $tituloArchivoEvento,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerDatosEventoPorId($idEvento) {
    $conectActual = conectar();

    $sql = "SELECT idEvento, tituloEvento, nombreEventoUrl, lugarEvento, fechaInicioEvento, fechaFinEvento, imagenEvento, imagenSlideEvento, descripcionEvento, cuerpoEvento, destacadoEvento
            FROM evento
            WHERE idEvento = ?
            AND estadoEvento = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idEvento);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idEvento, $tituloEvento, $nombreEventoUrl, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $imagenEvento, $imagenSlideEvento, $descripcionEvento, $cuerpoEvento, $destacadoEvento);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idEvento' => $idEvento,
            'tituloEvento' => $tituloEvento,
            'nombreEventoUrl' => $nombreEventoUrl,
            'lugarEvento' => $lugarEvento,
            'fechaInicioEvento' => $fechaInicioEvento,
            'fechaFinEvento' => $fechaFinEvento,
            'imagenEvento' => $imagenEvento,
            'imagenSlideEvento' => $imagenSlideEvento,
            'descripcionEvento' => $descripcionEvento,
            'cuerpoEvento' => $cuerpoEvento,
            'destacadoEvento' => $destacadoEvento,
        );
    } else {
        $result = array(
            'idEvento' => false,
            'tituloEvento' => false,
            'nombreEventoUrl' => false,
            'lugarEvento' => false,
            'fechaInicioEvento' => false,
            'fechaFinEvento' => false,
            'imagenEvento' => false,
            'imagenSlideEvento' => false,
            'descripcionEvento' => false,
            'cuerpoEvento' => false,
            'destacadoEvento' => false,
        );
    }

    return $result;
}

function realizarAgregacionEvento($tituloEvento, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $descripcionEvento, $cuerpoEvento, $imagenEvento) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $nombreEventoUrl = strtolower(urlAmigable($tituloEvento));

        /* Inserción de Minorista */
        $sql = "INSERT INTO evento (tituloEvento, nombreEventoUrl, lugarEvento, fechaInicioEvento, fechaFinEvento, imagenEvento, 
                descripcionEvento, cuerpoEvento, fechaCargaEvento, fechaModificacionEvento, estadoEvento)
                VALUES(?,?,?,?,?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $tituloEvento, $nombreEventoUrl, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $imagenEvento, $descripcionEvento, $cuerpoEvento);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Obtener idNotaPrensa */
        $idEvento = mysqli_insert_id($conectActual);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssssss', $tituloEvento, $nombreEventoUrl, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $imagenEvento, $descripcionEvento, $cuerpoEvento);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function realizarModificacionEvento($tituloEvento, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $descripcionEvento, $cuerpoEvento, $imagenEvento, $idEvento) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $nombreEventoUrl = strtolower(urlAmigable($tituloEvento));

        if (is_null($imagenEvento)) {
            /* Obtener archivo */
            $sql = "SELECT imagenEvento
                    FROM evento 
                    WHERE idEvento = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idEvento);
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $archivo);

            mysqli_stmt_store_result($query);

            if (mysqli_stmt_num_rows($query) > 0) {
                $row = mysqli_stmt_fetch($query);

                $imagenEvento = $archivo;
            } else {
                $imagenEvento = NULL;
            }
        }

        /* Inserción de Minorista */
        $sql = "UPDATE evento SET tituloEvento = ?, nombreEventoUrl = ?, lugarEvento = ?, fechaInicioEvento = ?, fechaFinEvento = ?, 
                imagenEvento = ?, descripcionEvento = ?, cuerpoEvento = ?, fechaModificacionEvento = '" . date("Y-m-d H:i:s") . "', estadoEvento = 'A'
                WHERE idEvento = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $tituloEvento, $nombreEventoUrl, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $imagenEvento, $descripcionEvento, $cuerpoEvento, $idEvento);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }

        mysqli_stmt_close($stmt);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function realizarBajaArchivoEvento($idEvento) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE evento SET imagenEvento = NULL, fechaModificacionEvento = '" . date("Y-m-d H:i:s") . "'
                WHERE idEvento = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idEvento);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        return -1;
    }
}

function realizarBajaArchivo($idArchivo, $carpeta) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $sql = "UPDATE archivo_" . $carpeta . " SET fechaBajaArchivoEvento = '" . date("Y-m-d H:i:s") . "', estadoArchivoEvento = 'B' WHERE idArchivoEvento = ?";


        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idArchivo);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idArchivo);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function realizarBajaEvento($idEvento) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE evento SET fechaBajaEvento = '" . date("Y-m-d H:i:s") . "', estadoEvento = 'B' 
                WHERE idEvento = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idEvento);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idEvento);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function destacarEvento($imagen, $id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE evento SET imagenSlideEvento = ?, destacadoEvento = 't', fechaModificacionEvento = '" . date("Y-m-d H:i:s") . "' WHERE idEvento = ? ";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $imagen, $id);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'si', $imagen, $id);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function quitarDestacadoEvento($id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE evento SET destacadoEvento = '', fechaModificacionEvento = '" . date("Y-m-d H:i:s") . "' WHERE idEvento = ? ";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $id);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

?>
