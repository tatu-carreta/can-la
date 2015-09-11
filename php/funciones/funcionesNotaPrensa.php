<?php

function obtenerNotasPrensa() {
    $conectActual = conectar();

    $sql = "SELECT idNotaPrensa, tituloNotaPrensa, notaPrensaUrl, imagenNotaPrensa, imagenSlideNotaPrensa, 
            fechaNotaPrensa, descripcionNotaPrensa, cuerpoNotaPrensa, destacadoNotaPrensa
            FROM notaprensa
            WHERE estadoNotaPrensa = 'A'
            ORDER BY fechaNotaPrensa DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $notas = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($notas, $result);
    }

    return $notas;
}

function obtenerNotasSlide() {
    $conectActual = conectar();

    $sql = "SELECT idNotaPrensa, tituloNotaPrensa, notaPrensaUrl, imagenNotaPrensa, imagenSlideNotaPrensa, fechaNotaPrensa, descripcionNotaPrensa, destacadoNotaPrensa
            FROM notaprensa
            WHERE estadoNotaPrensa = 'A'
            AND destacadoNotaPrensa = 't'
            ORDER BY fechaNotaPrensa DESC
            LIMIT 0,2";
    $stmt = mysqli_query($conectActual, $sql);

    $notas = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($notas, $result);
    }

    return $notas;
}

function destacarNotaPrensa($imagenNoticia, $idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE notaprensa SET imagenSlideNotaPrensa = ?, destacadoNotaPrensa = 't', fechaModificacionNotaPrensa = '" . date("Y-m-d H:i:s") . "' WHERE idNotaPrensa = ? ";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $imagenNoticia, $idNoticia);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'si', $imagenNoticia, $idNoticia);
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

function quitarDestacadoNotaPrensa($idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE notaprensa SET destacadoNotaPrensa = '', fechaModificacionNotaPrensa = '" . date("Y-m-d H:i:s") . "' WHERE idNotaPrensa = ? ";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idNoticia);
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

function obtenerAreaPorNotaPrensaPorId($idNotaPrensa) {
    $conectActual = conectar();

    $sql = "SELECT an.idArea
            FROM notaprensa as n
            INNER JOIN area_notaprensa as an ON (an.idNotaPrensa = n.idNotaPrensa)
            WHERE n.idNotaPrensa = ?
            AND n.estadoNotaPrensa = 'A'
            AND an.estadoAreaNotaPrensa = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idArea' => $idArea,
        );
    } else {
        $result = array(
            'idArea' => false,
        );
    }

    return $result;
}

function obtenerDatosNotaPrensaPorId($idNotaPrensa) {
    $conectActual = conectar();

    $sql = "SELECT np.idNotaPrensa, np.tituloNotaPrensa, np.notaPrensaUrl, np.imagenNotaPrensa, np.imagenSlideNotaPrensa, 
            np.fechaNotaPrensa, np.descripcionNotaPrensa, np.cuerpoNotaPrensa, np.destacadoNotaPrensa, anp.idArea
            FROM notaprensa as np
            LEFT JOIN area_notaprensa as anp ON (anp.idNotaPrensa = np.idNotaPrensa)
            WHERE np.idNotaPrensa = ?
            AND np.estadoNotaPrensa = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNotaPrensa, $tituloNotaPrensa, $notaPrensaUrl, $imagenNotaPrensa, $imagenSlideNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $destacadoNotaPrensa, $idArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idNotaPrensa' => $idNotaPrensa,
            'tituloNotaPrensa' => $tituloNotaPrensa,
            'notaPrensaUrl' => $notaPrensaUrl,
            'imagenNotaPrensa' => $imagenNotaPrensa,
            'imagenSlideNotaPrensa' => $imagenSlideNotaPrensa,
            'fechaNotaPrensa' => $fechaNotaPrensa,
            'descripcionNotaPrensa' => $descripcionNotaPrensa,
            'cuerpoNotaPrensa' => $cuerpoNotaPrensa,
            'destacadoNotaPrensa' => $destacadoNotaPrensa,
            'idArea' => $idArea
        );
    } else {
        $result = array(
            'idNotaPrensa' => false,
            'tituloNotaPrensa' => false,
            'notaPrensaUrl' => false,
            'imagenNotaPrensa' => false,
            'imagenSlideNotaPrensa' => false,
            'fechaNotaPrensa' => false,
            'descripcionNotaPrensa' => false,
            'cuerpoNotaPrensa' => false,
            'destacadoNotaPrensa' => false,
            'idArea' => false
        );
    }

    return $result;
}

function obtenerEtiquetasPorIdNotaPrensa($idNotaPrensa) {
    $conectActual = conectar();

    $sql = "SELECT e.nombreEtiqueta, e.nombreEtiquetaUrl
            FROM notaprensa as np
            INNER JOIN notaprensa_etiqueta as npe ON (npe.idNotaPrensa = np.idNotaprensa)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = npe.idEtiqueta)
            WHERE np.idNotaPrensa = ?
            AND np.estadoNotaPrensa = 'A'
            AND npe.estadoNotaPrensaEtiqueta = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $nombreEtiqueta, $nombreEtiquetaUrl);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'nombreEtiqueta' => $nombreEtiqueta,
                'nombreEtiquetaUrl' => $nombreEtiquetaUrl
            );

            array_push($result, $row);
        }
    }
    return $result;
}

function obtenerImagenesPorIdNotaPrensa($idNotaPrensa) {
    $conectActual = conectar();

    $sql = "SELECT idImagenNotaPrensa, nombreImagenNotaPrensa, idNotaPrensa
            FROM imagen_notaprensa
            WHERE idNotaPrensa = ?
            AND estadoImagenNotaPrensa = 'A'
            ORDER BY fechaCargaImagenNotaPrensa";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idImagenNotaPrensa, $nombreImagenNotaPrensa, $idNotaPrensa);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idImagenNotaPrensa' => $idImagenNotaPrensa,
                'nombreImagenNotaPrensa' => $nombreImagenNotaPrensa,
                'idNotaPrensa' => $idNotaPrensa,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerVideosPorIdNotaPrensa($idNotaPrensa) {
    $conectActual = conectar();

    $sql = "SELECT idVideoNotaPrensa, nombreVideoNotaPrensa, idNotaPrensa
            FROM video_notaprensa
            WHERE idNotaPrensa = ?
            AND estadoVideoNotaPrensa = 'A'
            ORDER BY fechaCargaVideoNotaPrensa";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idVideoNotaPrensa, $nombreVideoNotaPrensa, $idNotaPrensa);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idVideoNotaPrensa' => $idVideoNotaPrensa,
                'nombreVideoNotaPrensa' => $nombreVideoNotaPrensa,
                'idNotaPrensa' => $idNotaPrensa,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerNotasPrensaPorEtiqueta($nombreEtiqueta) {
    $conectActual = conectar();

    $sql = "SELECT np.idNotaPrensa, np.tituloNotaPrensa, np.notaPrensaUrl, np.imagenNotaPrensa, np.imagenSlideNotaPrensa, np.fechaNotaPrensa, 
            np.descripcionNotaPrensa, np.cuerpoNotaPrensa, np.destacadoNotaPrensa
            FROM notaprensa as np
            INNER JOIN notaprensa_etiqueta as npe ON (npe.idNotaPrensa = np.idNotaPrensa)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = npe.idEtiqueta)
            WHERE e.nombreEtiquetaUrl = ?
            AND np.estadoNotaPrensa = 'A'
            AND npe.estadoNotaPrensaEtiqueta = 'A'
            ORDER BY np.fechaNotaPrensa DESC";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreEtiqueta);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNotaPrensa, $tituloNotaPrensa, $notaPrensaUrl, $imagenNotaPrensa, $imagenSlideNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $destacadoNotaPrensa);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idNotaPrensa' => $idNotaPrensa,
                'tituloNotaPrensa' => $tituloNotaPrensa,
                'notaPrensaUrl' => $notaPrensaUrl,
                'imagenNotaPrensa' => $imagenNotaPrensa,
                'imagenSlideNotaPrensa' => $imagenSlideNotaPrensa,
                'fechaNotaPrensa' => $fechaNotaPrensa,
                'descripcionNotaPrensa' => $descripcionNotaPrensa,
                'cuerpoNotaPrensa' => $cuerpoNotaPrensa,
                'destacadoNotaPrensa' => $destacadoNotaPrensa,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerNotaPrensaPorNombreUrl($notaPrensaUrl) {
    $conectActual = conectar();

    $sql = "SELECT idNotaPrensa, tituloNotaPrensa, notaPrensaUrl, imagenNotaPrensa, imagenSlideNotaPrensa, 
            fechaNotaPrensa, descripcionNotaPrensa, cuerpoNotaPrensa, destacadoNotaPrensa
            FROM notaprensa
            WHERE notaPrensaUrl = ?
            AND estadoNotaPrensa = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $notaPrensaUrl);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNotaPrensa, $tituloNotaPrensa, $notaPrensaUrl, $imagenNotaPrensa, $imagenSlideNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $destacadoNotaPrensa);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idNotaPrensa' => $idNotaPrensa,
            'tituloNotaPrensa' => $tituloNotaPrensa,
            'notaPrensaUrl' => $notaPrensaUrl,
            'imagenNotaPrensa' => $imagenNotaPrensa,
            'imagenSlideNotaPrensa' => $imagenSlideNotaPrensa,
            'fechaNotaPrensa' => $fechaNotaPrensa,
            'descripcionNotaPrensa' => $descripcionNotaPrensa,
            'cuerpoNotaPrensa' => $cuerpoNotaPrensa,
            'destacadoNotaPrensa' => $destacadoNotaPrensa,
        );
    } else {
        $result = array(
            'idNotaPrensa' => false,
            'tituloNotaPrensa' => false,
            'notaPrensaUrl' => false,
            'imagenNotaPrensa' => false,
            'imagenSlideNotaPrensa' => false,
            'fechaNotaPrensa' => false,
            'descripcionNotaPrensa' => false,
            'cuerpoNotaPrensa' => false,
            'destacadoNotaPrensa' => false,
        );
    }

    return $result;
}

function realizarAgregacionNotaPrensa($tituloNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $descripcionNotaPrensa, $idArea, $filenameImagen) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $notaPrensaUrl = strtolower(urlAmigable($tituloNotaPrensa));

        /* Inserción de Minorista */
        $sql = "INSERT INTO notaprensa (tituloNotaPrensa, notaPrensaUrl, imagenNotaPrensa, fechaNotaPrensa, 
                descripcionNotaPrensa, cuerpoNotaPrensa, fechaCargaNotaPrensa, fechaModificacionNotaPrensa, estadoNotaPrensa)
                VALUES(?,?,?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $tituloNotaPrensa, $notaPrensaUrl, $filenameImagen, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Obtener idNotaPrensa */
        $idNotaPrensa = mysqli_insert_id($conectActual);

        if (!is_null($idArea)) {
            /* Inserción de Minorista */
            $sql2 = "INSERT INTO area_notaprensa (idArea, idNotaPrensa, estadoAreaNotaPrensa)
                VALUES(?,?,'A')";
            $stmt4 = mysqli_prepare($conectActual, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
            if (!mysqli_stmt_execute($stmt4)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt4);
        }

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssss', $tituloNotaPrensa, $notaPrensaUrl, $filenameImagen, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Obtener idNotaPrensa */
        $idNotaPrensa = mysqli_insert_id($conectMirror);

        if (!is_null($idArea)) {
            $stmt4 = mysqli_prepare($conectMirror, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
            if (!mysqli_stmt_execute($stmt4)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt4);
        }

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return $idNotaPrensa;
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

function realizarModificacionNotaPrensa($tituloNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $descripcionNotaPrensa, $idArea, $filenameImagen, $idNotaPrensa) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $notaPrensaUrl = strtolower(urlAmigable($tituloNotaPrensa));

        if (is_null($filenameImagen)) {
            /* Obtener archivo */
            $sql = "SELECT imagenNotaPrensa
                    FROM notaprensa 
                    WHERE idNotaPrensa = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idNotaPrensa);
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $archivo);

            mysqli_stmt_store_result($query);

            if (mysqli_stmt_num_rows($query) > 0) {
                $row = mysqli_stmt_fetch($query);

                $filenameImagen = $archivo;
            } else {
                $filenameImagen = NULL;
            }
        }

        /* Inserción de Minorista */
        $sql = "UPDATE notaprensa SET tituloNotaPrensa = ?, notaPrensaUrl = ?, imagenNotaPrensa = ?, fechaNotaPrensa = ?, 
                descripcionNotaPrensa = ?, cuerpoNotaPrensa = ?, fechaModificacionNotaPrensa = '" . date("Y-m-d H:i:s") . "', estadoNotaPrensa = 'A'
                WHERE idNotaPrensa = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssi', $tituloNotaPrensa, $notaPrensaUrl, $filenameImagen, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $idNotaPrensa);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }

        mysqli_stmt_close($stmt);

        if (!is_null($idArea)) {
            /* Obtener area correspondiente */
            $sqlArea = "SELECT anp.idAreaNotaPrensa, anp.idArea
                    FROM notaprensa as np
                    INNER JOIN area_notaprensa as anp ON (anp.idNotaPrensa = np.idNotaPrensa)
                    WHERE np.idNotaPrensa = ?
                    AND np.estadoNotaPrensa = 'A'
                    AND anp.estadoAreaNotaPrensa = 'A'";
            $stmtArea = mysqli_prepare($conectActual, $sqlArea);
            mysqli_stmt_bind_param($stmtArea, 'i', $idNotaPrensa);
            mysqli_stmt_execute($stmtArea);

            mysqli_stmt_bind_result($stmtArea, $idAreaConsulta, $idAreaCorrespondiente);

            mysqli_stmt_store_result($stmtArea);

            if (mysqli_stmt_num_rows($stmtArea) > 0) {
                $row = mysqli_stmt_fetch($stmtArea);

                if ($idArea != $idAreaCorrespondiente) {
                    $sql3 = "UPDATE area_notaprensa SET estadoAreaNotaPrensa = 'B' WHERE idAreaNotaPrensa = ?";
                    $stmt3 = mysqli_prepare($conectActual, $sql3);
                    mysqli_stmt_bind_param($stmt3, 'i', $idAreaConsulta);
                    if (!mysqli_stmt_execute($stmt3)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt3);

                    $stmt3 = mysqli_prepare($conectMirror, $sql3);
                    mysqli_stmt_bind_param($stmt3, 'i', $idAreaConsulta);
                    if (!mysqli_stmt_execute($stmt3)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt3);

                    /* Inserción de Minorista */
                    $sql2 = "INSERT INTO area_notaprensa (idArea, idNotaPrensa, estadoAreaNotaPrensa)
                        VALUES(?,?,'A')";
                    $stmt4 = mysqli_prepare($conectActual, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt4);

                    $stmt4 = mysqli_prepare($conectMirror, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }
                    mysqli_stmt_close($stmt4);
                }
            } else {
                /* Inserción de Minorista */
                $sql2 = "INSERT INTO area_notaprensa (idArea, idNotaPrensa, estadoAreaNotaPrensa)
                        VALUES(?,?,'A')";
                $stmt4 = mysqli_prepare($conectActual, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
                if (!mysqli_stmt_execute($stmt4)) {
                    $estadoConsulta = FALSE;
                }

                mysqli_stmt_close($stmt4);

                $stmt4 = mysqli_prepare($conectMirror, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNotaPrensa);
                if (!mysqli_stmt_execute($stmt4)) {
                    $estadoConsulta = FALSE;
                }
                mysqli_stmt_close($stmt4);
            }
        }


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

function realizarBajaArchivoNotaPrensa($idNotaPrensa) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE notaprensa SET imagenNotaPrensa = NULL, fechaModificacionNotaPrensa = '" . date("Y-m-d H:i:s") . "'
                WHERE idNotaPrensa = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
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

function realizarBajaNotaPrensa($idNotaPrensa) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE notaprensa SET fechaBajaNotaPrensa = '" . date("Y-m-d H:i:s") . "', estadoNotaPrensa = 'B' 
                WHERE idNotaPrensa = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idNotaPrensa);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idNotaPrensa);
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
