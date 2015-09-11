<?php

function obtenerPublicaciones() {
    $conectActual = conectar();

    $sql = "SELECT idPublicacionCanla, tituloPublicacionCanla, nombrePublicacionCanlaUrl, archivoPublicacionCanla
            FROM publicacioncanla
            WHERE estadoPublicacionCanla = 'A'
            ORDER BY fechaCargaPublicacionCanla DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $otrasPublicaciones = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($otrasPublicaciones, $result);
    }

    return $otrasPublicaciones;
}

function obtenerDatosPublicacionCanlaPorId($idPublicacionCanla) {
    $conectActual = conectar();

    $sql = "SELECT idPublicacionCanla, tituloPublicacionCanla, nombrePublicacionCanlaUrl, archivoPublicacionCanla
            FROM publicacioncanla
            WHERE idPublicacionCanla = ?
            AND estadoPublicacionCanla = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPublicacionCanla);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPublicacionCanla, $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $archivoPublicacionCanla);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idPublicacionCanla' => $idPublicacionCanla,
            'tituloPublicacionCanla' => $tituloPublicacionCanla,
            'nombrePublicacionCanlaUrl' => $nombrePublicacionCanlaUrl,
            'archivoPublicacionCanla' => $archivoPublicacionCanla
        );
    } else {
        $result = array(
            'idPublicacionCanla' => false,
            'tituloPublicacionCanla' => false,
            'nombrePublicacionCanlaUrl' => false,
            'archivoPublicacionCanla' => false
        );
    }

    return $result;
}

function obtenerAreaPorPublicacionCanlaPorId($idPublicacionCanla) {
    $conectActual = conectar();

    $sql = "SELECT ap.idArea
            FROM publicacioncanla as p
            INNER JOIN area_publicacioncanla as ap ON (ap.idPublicacionCanla = p.idPublicacionCanla)
            WHERE p.idPublicacionCanla = ?
            AND p.estadoPublicacionCanla = 'A'
            AND ap.estadoAreaPublicacionCanla = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPublicacionCanla);
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

function realizarBajaPublicacionCanla($idPublicacionCanla) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE publicacioncanla SET fechaBajaPublicacionCanla = '" . date("Y-m-d H:i:s") . "', estadoPublicacionCanla = 'B' 
                WHERE idPublicacionCanla = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idPublicacionCanla);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idPublicacionCanla);
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

function obtenerEtiquetasPorIdPublicacionCanla($idPublicacionCanla) {
    $conectActual = conectar();

    $sql = "SELECT e.nombreEtiqueta, e.nombreEtiquetaUrl 
            FROM publicacioncanla as p
            INNER JOIN publicacioncanla_etiqueta as pe ON (pe.idPublicacionCanla = p.idPublicacionCanla)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = pe.idEtiqueta)
            WHERE p.idPublicacionCanla = ?
            AND p.estadoPublicacionCanla = 'A'
            AND pe.estadoPublicacionCanlaEtiqueta = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPublicacionCanla);
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

function obtenerPublicacionesPorEtiqueta($nombreEtiqueta) {
    $conectActual = conectar();

    $sql = "SELECT p.idPublicacionCanla, p.tituloPublicacionCanla, p.nombrePublicacionCanlaUrl, p.archivoPublicacionCanla
            FROM publicacioncanla as p
            INNER JOIN publicacioncanla_etiqueta as npe ON (npe.idPublicacionCanla = p.idPublicacionCanla)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = npe.idEtiqueta)
            WHERE e.nombreEtiquetaUrl = ?
            AND p.estadoPublicacionCanla = 'A'
            AND npe.estadoPublicacionCanlaEtiqueta = 'A'
            ORDER BY p.fechaCargaPublicacionCanla DESC";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreEtiqueta);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPublicacionCanla, $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $archivoPublicacionCanla);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idPublicacionCanla' => $idPublicacionCanla,
                'tituloPublicacionCanla' => $tituloPublicacionCanla,
                'nombrePublicacionCanlaUrl' => $nombrePublicacionCanlaUrl,
                'archivoPublicacionCanla' => $archivoPublicacionCanla,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function realizarAgregacionPublicacionCanla($tituloPublicacionCanla, $filename, $idArea) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $nombrePublicacionCanlaUrl = strtolower(urlAmigable($tituloPublicacionCanla));
        /* Inserción de Minorista */
        $sql = "INSERT INTO publicacioncanla (tituloPublicacionCanla, nombrePublicacionCanlaUrl, archivoPublicacionCanla, fechaCargaPublicacionCanla,
                fechaModificacionPublicacionCanla, estadoPublicacionCanla)
                VALUES(?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $filename);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Obtener idNotaPrensa */
        $idPublicacionCanla = mysqli_insert_id($conectActual);

        if (!is_null($idArea)) {
            /* Inserción de Minorista */
            $sql2 = "INSERT INTO area_publicacioncanla (idArea, idPublicacionCanla, estadoAreaPublicacionCanla)
                VALUES(?,?,'A')";
            $stmt4 = mysqli_prepare($conectActual, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
            if (!mysqli_stmt_execute($stmt4)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt4);
        }

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'sss', $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $filename);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Obtener idNotaPrensa */
        $idPublicacionCanla = mysqli_insert_id($conectMirror);

        if (!is_null($idArea)) {
            /* Inserción de Minorista */
            $sql2 = "INSERT INTO area_publicacioncanla (idArea, idPublicacionCanla, estadoAreaPublicacionCanla)
                VALUES(?,?,'A')";
            $stmt4 = mysqli_prepare($conectMirror, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
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
            return $idPublicacionCanla;
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

function realizarModificacionPublicacionCanla($tituloPublicacionCanla, $filename, $idArea, $idPublicacionCanla) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            /* Obtener archivo */
            $sql = "SELECT archivoPublicacionCanla
                    FROM publicacioncanla 
                    WHERE idPublicacionCanla = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idPublicacionCanla);
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $archivo);

            mysqli_stmt_store_result($query);

            if (mysqli_stmt_num_rows($query) > 0) {
                $row = mysqli_stmt_fetch($query);

                $filename = $archivo;
            } else {
                $filename = NULL;
            }
        }

        $nombrePublicacionCanlaUrl = strtolower(urlAmigable($tituloPublicacionCanla));

        /* Inserción de Minorista */
        $sql = "UPDATE publicacioncanla 
                SET tituloPublicacionCanla = ?, nombrePublicacionCanlaUrl = ?, archivoPublicacionCanla = ?,
                fechaModificacionPublicacionCanla = '" . date("Y-m-d H:i:s") . "'
                WHERE idPublicacionCanla = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $filename, $idPublicacionCanla);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        if (!is_null($idArea)) {
            /* Obtener area correspondiente */
            $sqlArea = "SELECT ap.idAreaPublicacionCanla, ap.idArea
                    FROM publicacioncanla as p
                    INNER JOIN area_publicacioncanla as ap ON (ap.idPublicacionCanla = p.idPublicacionCanla)
                    WHERE p.idPublicacionCanla = ?
                    AND p.estadoPublicacionCanla = 'A'
                    AND ap.estadoAreaPublicacionCanla = 'A'";
            $stmtArea = mysqli_prepare($conectActual, $sqlArea);
            mysqli_stmt_bind_param($stmtArea, 'i', $idPublicacionCanla);
            mysqli_stmt_execute($stmtArea);

            mysqli_stmt_bind_result($stmtArea, $idAreaConsulta, $idAreaCorrespondiente);

            mysqli_stmt_store_result($stmtArea);


            if (mysqli_stmt_num_rows($stmtArea) > 0) {
                $row = mysqli_stmt_fetch($stmtArea);

                if ($idArea != $idAreaCorrespondiente) {
                    $sql3 = "UPDATE area_publicacioncanla SET estadoAreaPublicacionCanla = 'B' WHERE idAreaPublicacionCanla = ?";
                    $stmt3 = mysqli_prepare($conectActual, $sql3);
                    mysqli_stmt_bind_param($stmt3, 'i', $idAreaConsulta);
                    if (!mysqli_stmt_execute($stmt3)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt3);

                    $stmt5 = mysqli_prepare($conectMirror, $sql3);
                    mysqli_stmt_bind_param($stmt5, 'i', $idAreaConsulta);
                    if (!mysqli_stmt_execute($stmt5)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt5);

                    /* Inserción de Minorista */
                    $sql2 = "INSERT INTO area_publicacioncanla (idArea, idPublicacionCanla, estadoAreaPublicacionCanla)
                        VALUES(?,?,'A')";
                    $stmt4 = mysqli_prepare($conectActual, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt4);

                    $stmt4 = mysqli_prepare($conectMirror, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }
                    mysqli_stmt_close($stmt4);
                }
            } else {
                /* Inserción de Minorista */
                $sql2 = "INSERT INTO area_publicacioncanla (idArea, idPublicacionCanla, estadoAreaPublicacionCanla)
                        VALUES(?,?,'A')";
                $stmt4 = mysqli_prepare($conectActual, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
                if (!mysqli_stmt_execute($stmt4)) {
                    $estadoConsulta = FALSE;
                }

                mysqli_stmt_close($stmt4);

                $stmt4 = mysqli_prepare($conectMirror, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idPublicacionCanla);
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

function realizarBajaArchivoPublicacionCanla($idPublicacionCanla) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE publicacioncanla SET archivoPublicacionCanla = NULL, fechaModificacionPublicacionCanla = '" . date("Y-m-d H:i:s") . "'
                WHERE idPublicacionCanla = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idPublicacionCanla);
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

?>
