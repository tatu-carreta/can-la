<?php

function obtenerOtrasPublicaciones() {
    $conectActual = conectar();

    $sql = "SELECT idOtraPublicacion, tituloOtraPublicacion, descripcionOtraPublicacion, urlOtraPublicacion
            FROM otrapublicacion
            WHERE estadoOtraPublicacion = 'A'
            ORDER BY fechaCargaOtraPublicacion DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $otrasPublicaciones = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($otrasPublicaciones, $result);
    }

    return $otrasPublicaciones;
}

function obtenerDatosOtraPublicacionPorId($idOtraPublicacion) {
    $conectActual = conectar();

    $sql = "SELECT idOtraPublicacion, tituloOtraPublicacion, descripcionOtraPublicacion, urlOtraPublicacion
            FROM otrapublicacion
            WHERE idOtraPublicacion = ?
            AND estadoOtraPublicacion = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idOtraPublicacion);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idOtraPublicacion, $tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idOtraPublicacion' => $idOtraPublicacion,
            'tituloOtraPublicacion' => $tituloOtraPublicacion,
            'descripcionOtraPublicacion' => $descripcionOtraPublicacion,
            'urlOtraPublicacion' => $urlOtraPublicacion
        );
    } else {
        $result = array(
            'idOtraPublicacion' => false,
            'tituloOtraPublicacion' => false,
            'descripcionOtraPublicacion' => false,
            'urlOtraPublicacion' => false
        );
    }

    return $result;
}

function realizarAgregacionOtraPublicacion($tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO otrapublicacion (tituloOtraPublicacion, descripcionOtraPublicacion, urlOtraPublicacion, fechaCargaOtraPublicacion, 
                fechaModificacionOtraPublicacion, estadoOtraPublicacion)
                VALUES(?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'sss', $tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion);
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

function realizarModificacionOtraPublicacion($tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion, $idOtraPublicacion) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE otrapublicacion 
                SET tituloOtraPublicacion = ?, descripcionOtraPublicacion = ?,
                urlOtraPublicacion = ?, fechaModificacionOtraPublicacion = '" . date("Y-m-d H:i:s") . "'
                WHERE idOtraPublicacion = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion, $idOtraPublicacion);
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

function realizarBajaOtraPublicacion($idOtraPublicacion) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE otrapublicacion SET fechaBajaOtraPublicacion = '" . date("Y-m-d H:i:s") . "', estadoOtraPublicacion = 'B' 
                WHERE idOtraPublicacion = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idOtraPublicacion);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idOtraPublicacion);
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
