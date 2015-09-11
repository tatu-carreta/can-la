<?php

function obtenerAreas() {
    $conectActual = conectar();

    $sql = "SELECT idArea, nombreArea, nombreAreaUrl, imagenArea, descripcionArea
            FROM area
            WHERE estadoArea = 'A'
            ORDER BY ordenArea ASC";
    $stmt = mysqli_query($conectActual, $sql);

    $areas = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($areas, $result);
    }

    return $areas;
}

function obtenerAreaPorNombreUrl($nombreAreaUrl) {
    $conectActual = conectar();

    $sql = "SELECT idArea, nombreArea, nombreAreaUrl, imagenArea, descripcionArea
            FROM area
            WHERE nombreAreaUrl = ?
            AND estadoArea = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nombreAreaUrl);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idArea, $nombreArea, $nombreAreaUrl, $imagenArea, $descripcionArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idArea' => $idArea,
            'nombreArea' => $nombreArea,
            'nombreAreaUrl' => $nombreAreaUrl,
            'imagenArea' => $imagenArea,
            'descripcionArea' => $descripcionArea
        );
    } else {
        $result = array(
            'idArea' => false,
            'nombreArea' => false,
            'nombreAreaUrl' => false,
            'imagenArea' => false,
            'descripcionArea' => false
        );
    }

    return $result;
}

function obtenerDatosAreaPorId($idArea) {
    $conectActual = conectar();

    $sql = "SELECT idArea, nombreArea, nombreAreaUrl, imagenArea, descripcionArea
            FROM area
            WHERE idArea = ?
            AND estadoArea = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idArea);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idArea, $nombreArea, $nombreAreaUrl, $imagenArea, $descripcionArea);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idArea' => $idArea,
            'nombreArea' => $nombreArea,
            'nombreAreaUrl' => $nombreAreaUrl,
            'imagenArea' => $imagenArea,
            'descripcionArea' => $descripcionArea
        );
    } else {
        $result = array(
            'idArea' => false,
            'nombreArea' => false,
            'nombreAreaUrl' => false,
            'imagenArea' => false,
            'descripcionArea' => false
        );
    }

    return $result;
}

function obtenerNoticiasPorIdAreaLimitado($idArea, $inicio, $fin) {
    $conectActual = conectar();

    $sql = "SELECT n.idNoticia, n.tituloNoticia, n.nombreNoticiaUrl, n.fuenteNoticia, n.imagenNoticia, n.imagenSlideNoticia, n.fechaNoticia, 
            n.descripcionNoticia, n.cuerpoNoticia, n.destacadoNoticia
            FROM noticia as n
            INNER JOIN area_noticia as an ON (an.idNoticia = n.idNoticia)
            WHERE an.idArea = ?
            AND n.estadoNoticia = 'A'
            AND an.estadoAreaNoticia = 'A'
            ORDER BY n.fechaNoticia DESC
            LIMIT ?,?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $idArea, $inicio, $fin);
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

function obtenerNotasPrensaPorIdAreaLimitado($idArea, $inicio, $fin) {
    $conectActual = conectar();

    $sql = "SELECT np.idNotaPrensa, np.tituloNotaPrensa, np.notaPrensaUrl, np.imagenNotaPrensa, np.imagenSlideNotaPrensa, np.fechaNotaPrensa, 
            np.descripcionNotaPrensa, np.cuerpoNotaPrensa, np.destacadoNotaPrensa
            FROM notaprensa as np
            INNER JOIN area_notaprensa as anp ON (anp.idNotaPrensa = np.idNotaPrensa)
            WHERE anp.idArea = ?
            AND np.estadoNotaPrensa = 'A'
            AND anp.estadoAreaNotaPrensa = 'A'
            ORDER BY np.fechaNotaPrensa DESC
            LIMIT ?,?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $idArea, $inicio, $fin);
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

function obtenerPosicionesPorIdAreaLimitado($idArea, $inicio, $fin) {
    $conectActual = conectar();

    $sql = "SELECT p.idPosicion, p.tituloPosicion, p.nombrePosicionUrl, p.archivoPosicion
            FROM posicion as p
            INNER JOIN area_posicion as ap ON (ap.idPosicion = p.idPosicion)
            WHERE ap.idArea = ?
            AND p.estadoPosicion = 'A'
            AND ap.estadoAreaPosicion = 'A'
            ORDER BY p.fechaCargaPosicion DESC
            LIMIT ?,?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $idArea, $inicio, $fin);
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

function obtenerPublicacionesPorIdAreaLimitado($idArea, $inicio, $fin) {
    $conectActual = conectar();

    $sql = "SELECT p.idPublicacionCanla, p.tituloPublicacionCanla, p.nombrePublicacionCanlaUrl, p.archivoPublicacionCanla
            FROM publicacioncanla as p
            INNER JOIN area_publicacioncanla as ap ON (ap.idPublicacionCanla = p.idPublicacionCanla)
            WHERE ap.idArea = ?
            AND p.estadoPublicacionCanla = 'A'
            AND ap.estadoAreaPublicacionCanla = 'A'
            ORDER BY p.fechaCargaPublicacionCanla DESC
            LIMIT ?,?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $idArea, $inicio, $fin);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idPublicacionCanla, $tituloPublicacionCanla, $nombrePublicacionCanlaUrl, $archivoPublicacionCanlaUrl);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idPublicacionCanla' => $idPublicacionCanla,
                'tituloPublicacionCanla' => $tituloPublicacionCanla,
                'nombrePublicacionCanlaUrl' => $nombrePublicacionCanlaUrl,
                'archivoPublicacionCanlaUrl' => $archivoPublicacionCanlaUrl,
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function realizarAgregacionArea($nombreArea, $descripcionArea, $filename) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Obtener ordenArea */
        $sql = "SELECT MAX(ordenArea) as ordenArea
                FROM area 
                WHERE estadoArea = 'A'";
        $query = mysqli_query($conectActual, $sql);

        if (mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_assoc($query);

            $orden = $result['ordenArea'] + 1;
        } else {
            $orden = 1;
        }

        $nombreAreaUrl = strtolower(urlAmigable($nombreArea));

        /* Inserción de Minorista */
        $sql = "INSERT INTO area (nombreArea, nombreAreaUrl, imagenArea, descripcionArea, fechaCargaArea, fechaModificacionArea, ordenArea, estadoArea)
                VALUES(?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "',?,'A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nombreArea, $nombreAreaUrl, $filename, $descripcionArea, $orden);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssi', $nombreArea, $nombreAreaUrl, $filename, $descripcionArea, $orden);
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

function realizarModificacionArea($nombreArea, $descripcionArea, $filename, $idArea) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            /* Obtener archivo */
            $sql = "SELECT imagenArea
                FROM area 
                WHERE idArea = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idArea);
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

        $nombreAreaUrl = strtolower(urlAmigable($nombreArea));

        /* Inserción de Minorista */
        $sql = "UPDATE area 
                SET nombreArea = ?, nombreAreaUrl = ?, imagenArea = ?, descripcionArea = ?, 
                fechaModificacionArea = '" . date("Y-m-d H:i:s") . "'
                WHERE idArea = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nombreArea, $nombreAreaUrl, $filename, $descripcionArea, $idArea);
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

function realizarBajaArea($idArea) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE area SET fechaBajaArea = '" . date("Y-m-d H:i:s") . "', estadoArea = 'B' 
                WHERE idArea = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idArea);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idArea);
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

function realizarBajaArchivoArea($idArea) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE area SET imagenArea = NULL, fechaModificacionArea = '" . date("Y-m-d H:i:s") . "'
                WHERE idArea = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idArea);
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

function modificarOrdenAreas($i, $idCategoria) {
    $conectActual = conectar();
    try {
        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $sql = "UPDATE area SET orden = ? WHERE idCategoria = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $i, $idArea);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        return $res;

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
