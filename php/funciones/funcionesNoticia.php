<?php

function obtenerNoticias() {
    $conectActual = conectar();

    $sql = "SELECT idNoticia, tituloNoticia, nombreNoticiaUrl, fuenteNoticia, imagenNoticia, imagenSlideNoticia, 
            fechaNoticia, descripcionNoticia, cuerpoNoticia, destacadoNoticia
            FROM noticia
            WHERE estadoNoticia = 'A'
            ORDER BY fechaNoticia DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $noticias = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($noticias, $result);
    }

    return $noticias;
}

function obtenerNoticiasHome() {
    $conectActual = conectar();

    $sql = "SELECT idNoticia, tituloNoticia, nombreNoticiaUrl, fuenteNoticia, imagenNoticia, imagenSlideNoticia, 
            fechaNoticia, descripcionNoticia, cuerpoNoticia, destacadoNoticia
            FROM noticia
            WHERE estadoNoticia = 'A'
            ORDER BY fechaNoticia DESC
            LIMIT 0,12";
    $stmt = mysqli_query($conectActual, $sql);

    $noticias = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($noticias, $result);
    }

    return $noticias;
}

function obtenerNoticiasSlide() {
    $conectActual = conectar();

    $sql = "SELECT idNoticia, tituloNoticia, nombreNoticiaUrl, fuenteNoticia, imagenNoticia, imagenSlideNoticia, fechaNoticia, descripcionNoticia, destacadoNoticia
            FROM noticia
            WHERE estadoNoticia = 'A'
            AND destacadoNoticia = 't'
            ORDER BY fechaNoticia DESC
            LIMIT 0,2";
    $stmt = mysqli_query($conectActual, $sql);

    $noticias = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($noticias, $result);
    }

    return $noticias;
}

function obtenerAreaPorNoticiaPorId($idNoticia) {
    $conectActual = conectar();

    $sql = "SELECT an.idArea
            FROM noticia as n
            INNER JOIN area_noticia as an ON (an.idNoticia = n.idNoticia)
            WHERE n.idNoticia = ?
            AND n.estadoNoticia = 'A'
            AND an.estadoAreaNoticia = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
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

function obtenerDatosNoticiaPorId($idNoticia) {
    $conectActual = conectar();

    $sql = "SELECT n.idNoticia, n.tituloNoticia, n.nombreNoticiaUrl, n.fuenteNoticia, n.imagenNoticia, n.imagenSlideNoticia, 
            n.fechaNoticia, n.descripcionNoticia, n.cuerpoNoticia, n.destacadoNoticia, an.idArea
            FROM noticia as n
            LEFT JOIN area_noticia as an ON (an.idNoticia = n.idNoticia)
            WHERE n.idNoticia = ?
            AND n.estadoNoticia = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNoticia, $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $imagenSlideNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $destacadoNoticia, $idArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idNoticia' => $idNoticia,
            'tituloNoticia' => $tituloNoticia,
            'nombreNoticiaUrl' => $nombreNoticiaUrl,
            'fuenteNoticia' => $fuenteNoticia,
            'imagenNoticia' => $imagenNoticia,
            'imagenSlideNoticia' => $imagenSlideNoticia,
            'fechaNoticia' => $fechaNoticia,
            'descripcionNoticia' => $descripcionNoticia,
            'cuerpoNoticia' => $cuerpoNoticia,
            'destacadoNoticia' => $destacadoNoticia,
            'idArea' => $idArea
        );
    } else {
        $result = array(
            'idNoticia' => false,
            'tituloNoticia' => false,
            'nombreNoticiaUrl' => false,
            'fuenteNoticia' => false,
            'imagenNoticia' => false,
            'imagenSlideNoticia' => false,
            'fechaNoticia' => false,
            'descripcionNoticia' => false,
            'cuerpoNoticia' => false,
            'destacadoNoticia' => false,
            'idArea' => false
        );
    }

    return $result;
}

function obtenerNoticiaPorNombreUrl($nombreNoticiaUrl) {
    $conectActual = conectar();

    $sql = "SELECT idNoticia, tituloNoticia, nombreNoticiaUrl, fuenteNoticia, imagenNoticia, imagenSlideNoticia, 
            fechaNoticia, descripcionNoticia, cuerpoNoticia, destacadoNoticia
            FROM noticia
            WHERE nombreNoticiaUrl = ?
            AND estadoNoticia = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreNoticiaUrl);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNoticia, $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $imagenSlideNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $destacadoNoticia);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idNoticia' => $idNoticia,
            'tituloNoticia' => $tituloNoticia,
            'nombreNoticiaUrl' => $nombreNoticiaUrl,
            'fuenteNoticia' => $fuenteNoticia,
            'imagenNoticia' => $imagenNoticia,
            'imagenSlideNoticia' => $imagenSlideNoticia,
            'fechaNoticia' => $fechaNoticia,
            'descripcionNoticia' => $descripcionNoticia,
            'cuerpoNoticia' => $cuerpoNoticia,
            'destacadoNoticia' => $destacadoNoticia,
        );
    } else {
        $result = array(
            'idNoticia' => false,
            'tituloNoticia' => false,
            'nombreNoticiaUrl' => false,
            'fuenteNoticia' => false,
            'imagenNoticia' => false,
            'imagenSlideNoticia' => false,
            'fechaNoticia' => false,
            'descripcionNoticia' => false,
            'cuerpoNoticia' => false,
            'destacadoNoticia' => false,
        );
    }

    return $result;
}

function obtenerImagenesPorIdNoticia($idNoticia) {
    $conectActual = conectar();

    $sql = "SELECT idImagenNoticia, nombreImagenNoticia, idNoticia
            FROM imagen_noticia
            WHERE idNoticia = ?
            AND estadoImagenNoticia = 'A'
            ORDER BY fechaCargaImagenNoticia";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idImagenNoticia, $nombreImagenNotica, $idNoticia);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idImagenNoticia' => $idImagenNoticia,
                'nombreImagenNoticia' => $nombreImagenNotica,
                'idNoticia' => $idNoticia,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerVideosPorIdNoticia($idNoticia) {
    $conectActual = conectar();

    $sql = "SELECT idVideoNoticia, nombreVideoNoticia, idNoticia
            FROM video_noticia
            WHERE idNoticia = ?
            AND estadoVideoNoticia = 'A'
            ORDER BY fechaCargaVideoNoticia";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idVideoNoticia, $nombreVideoNoticia, $idNoticia);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idVideoNoticia' => $idVideoNoticia,
                'nombreVideoNoticia' => $nombreVideoNoticia,
                'idNoticia' => $idNoticia,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerEtiquetasPorIdNoticia($idNoticia) {
    $conectActual = conectar();

    $sql = "SELECT e.nombreEtiqueta, e.nombreEtiquetaUrl 
            FROM noticia as n
            INNER JOIN noticia_etiqueta as ne ON (ne.idNoticia = n.idNoticia)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = ne.idEtiqueta)
            WHERE n.idNoticia = ?
            AND n.estadoNoticia = 'A'
            AND ne.estadoNoticiaEtiqueta = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
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

function obtenerNoticiasPorEtiqueta($nombreEtiqueta) {
    $conectActual = conectar();

    $sql = "SELECT np.idNoticia, np.tituloNoticia, np.nombreNoticiaUrl, np.fuenteNoticia, np.imagenNoticia, np.imagenSlideNoticia, np.fechaNoticia, 
            np.descripcionNoticia, np.cuerpoNoticia, np.destacadoNoticia
            FROM noticia as np
            INNER JOIN noticia_etiqueta as npe ON (npe.idNoticia = np.idNoticia)
            INNER JOIN etiqueta as e ON (e.idEtiqueta = npe.idEtiqueta)
            WHERE e.nombreEtiquetaUrl = ?
            AND np.estadoNoticia = 'A'
            AND npe.estadoNoticiaEtiqueta = 'A'
            ORDER BY np.fechaNoticia DESC";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreEtiqueta);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idNoticia, $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $imagenSlideNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $destacadoNoticia);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idNoticia' => $idNoticia,
                'tituloNoticia' => $tituloNoticia,
                'nombreNoticiaUrl' => $nombreNoticiaUrl,
                'fuenteNoticia' => $fuenteNoticia,
                'imagenNoticia' => $imagenNoticia,
                'imagenSlideNoticia' => $imagenSlideNoticia,
                'fechaNoticia' => $fechaNoticia,
                'descripcionNoticia' => $descripcionNoticia,
                'cuerpoNoticia' => $cuerpoNoticia,
                'destacadoNoticia' => $destacadoNoticia,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function realizarAgregacionNoticia($tituloNoticia, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $idArea) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $nombreNoticiaUrl = strtolower(urlAmigable($tituloNoticia));

        /* Inserción de Minorista */
        $sql = "INSERT INTO noticia (tituloNoticia, nombreNoticiaUrl, fuenteNoticia, imagenNoticia, fechaNoticia, 
                descripcionNoticia, cuerpoNoticia, fechaCargaNoticia, fechaModificacionNoticia, estadoNoticia)
                VALUES(?,?,?,?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssss', $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        /* Obtener idNotaPrensa */
        $idNoticia = mysqli_insert_id($conectActual);

        if (!is_null($idArea)) {
            /* Inserción de Minorista */
            $sql2 = "INSERT INTO area_noticia (idArea, idNoticia, estadoAreaNoticia)
                VALUES(?,?,'A')";
            $stmt4 = mysqli_prepare($conectActual, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
            if (!mysqli_stmt_execute($stmt4)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt4);
        }

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'sssssss', $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Obtener idNotaPrensa */
        $idNoticia = mysqli_insert_id($conectMirror);

        if (!is_null($idArea)) {
            $stmt4 = mysqli_prepare($conectMirror, $sql2);
            mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
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
            return $idNoticia;
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

function destacarNoticia($imagenNoticia, $idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE noticia SET imagenSlideNoticia = ?, destacadoNoticia = 't', fechaModificacionNoticia = '" . date("Y-m-d H:i:s") . "' WHERE idNoticia = ? ";
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

function quitarDestacadoNoticia($idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE noticia SET destacadoNoticia = '', fechaModificacionNoticia = '" . date("Y-m-d H:i:s") . "' WHERE idNoticia = ? ";
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

function realizarModificacionNoticia($tituloNoticia, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $idArea, $idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $nombreNoticiaUrl = strtolower(urlAmigable($tituloNoticia));

        if (is_null($imagenNoticia)) {
            /* Obtener archivo */
            $sql = "SELECT imagenNoticia
                    FROM noticia 
                    WHERE idNoticia = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idNoticia);
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $archivo);

            mysqli_stmt_store_result($query);

            if (mysqli_stmt_num_rows($query) > 0) {
                $row = mysqli_stmt_fetch($query);

                $imagenNoticia = $archivo;
            } else {
                $imagenNoticia = NULL;
            }
        }

        /* Inserción de Minorista */
        $sql = "UPDATE noticia SET tituloNoticia = ?, nombreNoticiaUrl = ?, fuenteNoticia = ?, imagenNoticia = ?, fechaNoticia = ?, 
                descripcionNoticia = ?, cuerpoNoticia = ?, fechaModificacionNoticia = '" . date("Y-m-d H:i:s") . "', estadoNoticia = 'A'
                WHERE idNoticia = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssi', $tituloNoticia, $nombreNoticiaUrl, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $idNoticia);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }

        mysqli_stmt_close($stmt);

        if (!is_null($idArea)) {
            /* Obtener area correspondiente */
            $sqlArea = "SELECT an.idAreaNoticia, an.idArea
                    FROM noticia as n
                    INNER JOIN area_noticia as an ON (an.idNoticia = n.idNoticia)
                    WHERE n.idNoticia = ?
                    AND n.estadoNoticia = 'A'
                    AND an.estadoAreaNoticia = 'A'";
            $stmtArea = mysqli_prepare($conectActual, $sqlArea);
            mysqli_stmt_bind_param($stmtArea, 'i', $idNoticia);
            mysqli_stmt_execute($stmtArea);

            mysqli_stmt_bind_result($stmtArea, $idAreaConsulta, $idAreaCorrespondiente);

            mysqli_stmt_store_result($stmtArea);

            if (mysqli_stmt_num_rows($stmtArea) > 0) {
                $row = mysqli_stmt_fetch($stmtArea);

                if ($idArea != $idAreaCorrespondiente) {
                    $sql3 = "UPDATE area_noticia SET estadoAreaNoticia = 'B' WHERE idAreaNoticia = ?";
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
                    $sql2 = "INSERT INTO area_noticia (idArea, idNoticia, estadoAreaNoticia)
                        VALUES(?,?,'A')";
                    $stmt4 = mysqli_prepare($conectActual, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }

                    mysqli_stmt_close($stmt4);

                    $stmt4 = mysqli_prepare($conectMirror, $sql2);
                    mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
                    if (!mysqli_stmt_execute($stmt4)) {
                        $estadoConsulta = FALSE;
                    }
                    mysqli_stmt_close($stmt4);
                }
            } else {
                /* Inserción de Minorista */
                $sql2 = "INSERT INTO area_noticia (idArea, idNoticia, estadoAreaNoticia)
                        VALUES(?,?,'A')";
                $stmt4 = mysqli_prepare($conectActual, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
                if (!mysqli_stmt_execute($stmt4)) {
                    $estadoConsulta = FALSE;
                }

                mysqli_stmt_close($stmt4);

                $stmt4 = mysqli_prepare($conectMirror, $sql2);
                mysqli_stmt_bind_param($stmt4, 'ii', $idArea, $idNoticia);
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

function realizarBajaArchivoNoticia($idNoticia) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE noticia SET imagenNoticia = NULL, fechaModificacionNoticia = '" . date("Y-m-d H:i:s") . "'
                WHERE idNoticia = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idNoticia);
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

function realizarBajaNoticia($idNoticia) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE noticia SET fechaBajaNoticia = '" . date("Y-m-d H:i:s") . "', estadoNoticia = 'B' 
WHERE idNoticia = ?";
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

?>
