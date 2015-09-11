<?php

function obtenerPosiciones() {
    $conectActual = conectar();

    $sql = "SELECT idPosicion, tituloPosicion, nombrePosicionUrl, archivoPosicion
            FROM posicion
            WHERE estadoPosicion = 'A'
            ORDER BY fechaCargaPosicion DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $posiciones = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($posiciones, $result);
    }

    return $posiciones;
}

function obtenerEtiquetasPosicion() {
    $conectActual = conectar();

    $sql = "SELECT * 
            FROM posicion_etiqueta 
            LEFT JOIN etiqueta ON (posicion_etiqueta.idEtiqueta = etiqueta.idEtiqueta)
            WHERE estadoPosicionEtiqueta = 'A'
            ORDER BY etiqueta.nombreEtiqueta ";
    $stmt = mysqli_query($conectActual, $sql);

    $posiciones = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($posiciones, $result);
    }

    return $posiciones;
}

function obtenerAreaPorPosicionPorId($idPosicion) {
    $conectActual = conectar();

    $sql = "SELECT ap.idArea
            FROM posicion as p
            INNER JOIN area_posicion as ap ON (ap.idPosicion = p.idPosicion)
            WHERE p.idPosicion = ?
            AND p.estadoPosicion = 'A'
            AND ap.estadoAreaPosicion = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPosicion);
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

function obtenerDatosPosicionPorId($idPosicion) {
    $conectActual = conectar();

    $sql = "SELECT p.idPosicion, p.tituloPosicion, p.nombrePosicionUrl, p.archivoPosicion, ap.idArea
            FROM posicion as p
            LEFT JOIN area_posicion as ap ON (ap.idPosicion = p.idPosicion)
            WHERE p.idPosicion = ?
            AND p.estadoPosicion = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPosicion);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPosicion, $tituloPosicion, $nombrePosicionUrl, $archivoPosicion, $idArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idPosicion' => $idPosicion,
            'tituloPosicion' => $tituloPosicion,
            'nombrePosicionUrl' => $nombrePosicionUrl,
            'archivoPosicion' => $archivoPosicion,
            'idArea' => $idArea
        );
    } else {
        $result = array(
            'idPosicion' => false,
            'tituloPosicion' => false,
            'nombrePosicionUrl' => false,
            'archivoPosicion' => false,
            'idArea' => false
        );
    }

    return $result;
}

function obtenerPosicionPorNombreUrl($nombrePosicionUrl) {
    $conectActual = conectar();

    $sql = "SELECT idPosicion, tituloPosicion, nombrePosicionUrl, archivoPosicion
            FROM posicion
            WHERE nombrePosicionUrl = ?
            AND estadoPosicion = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombrePosicionUrl);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPosicion, $tituloPosicion, $nombrePosicionUrl, $archivoPosicion);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idPosicion' => $idPosicion,
            'tituloPosicion' => $tituloPosicion,
            'nombrePosicionUrl' => $nombrePosicionUrl,
            'archivoPosicion' => $archivoPosicion,
        );
    } else {
        $result = array(
            'idPosicion' => false,
            'tituloPosicion' => false,
            'nombrePosicionUrl' => false,
            'archivoPosicion' => false,
        );
    }

    return $result;
}

function obtenerEtiquetasPorIdPosicion($idPosicion) {
    $conectActual = conectar();

    $sql = "SELECT e.nombreEtiqueta, e.nombreEtiquetaUrl 
            FROM posicion as p
            INNER JOIN posicion_etiqueta as pe ON (pe.idPosicion = p.idPosicion)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = pe.idEtiqueta)
            WHERE p.idPosicion = ?
            AND p.estadoPosicion = 'A'
            AND pe.estadoPosicionEtiqueta = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPosicion);
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

function obtenerPosicionesPorEtiqueta($nombreEtiqueta) {
    $conectActual = conectar();

    $sql = "SELECT p.idPosicion, p.tituloPosicion, p.nombrePosicionUrl, p.archivoPosicion
            FROM posicion as p
            INNER JOIN posicion_etiqueta as npe ON (npe.idPosicion = p.idPosicion)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = npe.idEtiqueta)
            WHERE e.nombreEtiquetaUrl = ?
            AND p.estadoPosicion = 'A'
            AND npe.estadoPosicionEtiqueta = 'A'
            ORDER BY p.fechaCargaPosicion DESC";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreEtiqueta);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPosicion, $tituloPosicion, $nombrePosicionUrl, $archivoPosicion);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idPosicion' => $idPosicion,
                'tituloPosicion' => $tituloPosicion,
                'nombrePosicionUrl' => $nombrePosicionUrl,
                'archivoPosicion' => $archivoPosicion,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function realizarAgregacionPosicion($tituloPosicion, $archivoPosicion, $idArea) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $nombrePosicionUrl = strtolower(urlAmigable($tituloPosicion));

        /* Inserción de Minorista */
        $sql = "INSERT INTO posicion (tituloPosicion, nombrePosicionUrl, archivoPosicion, fechaCargaPosicion, fechaModificacionPosicion, 
                estadoPosicion)
                VALUES(?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $tituloPosicion, $nombrePosicionUrl, $archivoPosicion);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Obtener idNotaPrensa */
        $idPosicion = mysqli_insert_id($conectActual);

        if (!is_null($idArea)) {
            /* Inserción de Minorista */
            $sql2 = "INSERT INTO area_posicion (idArea, idPosicion, estadoAreaPosicion)
                VALUES(?,?,'A')";
            $stmt4 = mysqli_prepare($conectActual, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
            if (!mysqli_stmt_execute($stmt4)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt4);
        }

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'sss', $tituloPosicion, $nombrePosicionUrl, $archivoPosicion);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Obtener idNotaPrensa */
        $idPosicion = mysqli_insert_id($conectMirror);

        if (!is_null($idArea)) {
            $stmt4 = mysqli_prepare($conectMirror, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
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
            return $idPosicion;
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

function realizarModificacionPosicion($tituloPosicion, $archivoPosicion, $idArea, $idPosicion) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $nombrePosicionUrl = strtolower(urlAmigable($tituloPosicion));

        if (is_null($archivoPosicion)) {
            /* Obtener archivo */
            $sql = "SELECT archivoPosicion
                    FROM posicion 
                    WHERE idPosicion = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idPosicion);
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $archivo);

            mysqli_stmt_store_result($query);

            if (mysqli_stmt_num_rows($query) > 0) {
                $row = mysqli_stmt_fetch($query);

                $archivoPosicion = $archivo;
            } else {
                $archivoPosicion = NULL;
            }
        }

        /* Inserción de Minorista */
        $sql = "UPDATE posicion SET tituloPosicion = ?, nombrePosicionUrl = ?, archivoPosicion = ?, fechaModificacionPosicion = '" . date("Y-m-d H:i:s") . "'
                WHERE idPosicion = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $tituloPosicion, $nombrePosicionUrl, $archivoPosicion, $idPosicion);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }

        mysqli_stmt_close($stmt);

        if (!is_null($idArea)) {
            /* Obtener area correspondiente */
            $sqlArea = "SELECT ap.idAreaPosicion, ap.idArea
                    FROM posicion as p
                    INNER JOIN area_posicion as ap ON (ap.idPosicion = p.idPosicion)
                    WHERE p.idPosicion = ?
                    AND p.estadoPosicion = 'A'
                    AND ap.estadoAreaPosicion = 'A'";
            $stmtArea = mysqli_prepare($conectActual, $sqlArea);
            mysqli_stmt_bind_param($stmtArea, 'i', $idPosicion);
            mysqli_stmt_execute($stmtArea);

            mysqli_stmt_bind_result($stmtArea, $idAreaConsulta, $idAreaCorrespondiente);

            mysqli_stmt_store_result($stmtArea);

            if (mysqli_stmt_num_rows($stmtArea) > 0) {
                $row = mysqli_stmt_fetch($stmtArea);

                if ($idArea != $idAreaCorrespondiente) {
                    $sql3 = "UPDATE area_posicion SET estadoAreaPosicion = 'B' WHERE idAreaPosicion = ?";
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
                    $sql2 = "INSERT INTO area_posicion (idArea, idPosicion, estadoAreaPosicion)
                        VALUES(?,?,'A')";
                    $stmt4 = mysqli_prepare($conectActual, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt4);

                    $stmt4 = mysqli_prepare($conectMirror, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }
                    mysqli_stmt_close($stmt4);
                }
            } else {
                /* Inserción de Minorista */
                $sql2 = "INSERT INTO area_posicion (idArea, idPosicion, estadoAreaPosicion)
                        VALUES(?,?,'A')";
                $stmt4 = mysqli_prepare($conectActual, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
                if (!mysqli_stmt_execute($stmt4)) {
                    $estadoConsulta = FALSE;
                }

                mysqli_stmt_close($stmt4);

                $stmt4 = mysqli_prepare($conectMirror, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPosicion);
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

function realizarBajaPosicion($idPosicion) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE posicion SET fechaBajaPosicion = '" . date("Y-m-d H:i:s") . "', estadoPosicion = 'B' 
                WHERE idPosicion = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idPosicion);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idPosicion);
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

function eliminarArchivo($id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */

        $sql = "UPDATE posiciones SET archivoPosicion = NULL 
                WHERE idPosicion = ?";
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
