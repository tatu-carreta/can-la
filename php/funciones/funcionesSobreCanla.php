<?php

/*
 * FUNCIONES DE BÚSQUEDA SOBRE CANLA
 */

function obtenerDatosSobreCanlaPorId($idSobreCanla) {
    $conectActual = conectar();

    $sql = "SELECT idSobreCanla, cuerpoSobreCanla, tipoSobreCanla
            FROM sobrecanla
            WHERE idSobreCanla = ?
            AND estadoSobreCanla = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idSobreCanla);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idSobreCanla, $cuerpoSobreCanla, $tipoSobreCanla);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idSobreCanla' => $idSobreCanla,
            'cuerpoSobreCanla' => $cuerpoSobreCanla,
            'tipoSobreCanla' => $tipoSobreCanla
        );
    } else {
        $result = array(
            'idSobreCanla' => false,
            'cuerpoSobreCanla' => false,
            'tipoSobreCanla' => false
        );
    }

    return $result;
}

function obtenerDatosSobreCanlaPorTipo($tipoSobreCanla) {
    $conectActual = conectar();

    $sql = "SELECT idSobreCanla, cuerpoSobreCanla
            FROM sobrecanla
            WHERE tipoSobreCanla = ?
            AND estadoSobreCanla = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $tipoSobreCanla);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idSobreCanla, $cuerpoSobreCanla);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idSobreCanla' => $idSobreCanla,
            'cuerpoSobreCanla' => $cuerpoSobreCanla
        );
    } else {
        $result = array(
            'idSobreCanla' => false,
            'cuerpoSobreCanla' => false
        );
    }

    return $result;
}

/*
 * FUNCION DE AGREGACION DE LOS 4 TIPOS DE SOBRE CANLA
 */

function realizarAgregacionSobreCanla($cuerpoSobreCanla, $tipoSobreCanla) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO sobrecanla (cuerpoSobreCanla, tipoSobreCanla, fechaCargaSobreCanla, fechaModificacionSobreCanla, estadoSobreCanla)
                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $cuerpoSobreCanla, $tipoSobreCanla);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ss', $cuerpoSobreCanla, $tipoSobreCanla);
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
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_commit($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

/*
 * FUNCIÓN DE MODIFICACIÓN DE LOS 4 SOBRE CANLA
 */

function realizarModificacionSobreCanla($cuerpoSobreCanla, $idSobreCanla) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE sobrecanla SET cuerpoSobreCanla = ?, fechaModificacionSobreCanla = '" . date("Y-m-d H:i:s") . "'
                WHERE idSobreCanla = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $cuerpoSobreCanla, $idSobreCanla);
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

/*
 * FUNCIÓN DE ELIMINACIÓN DE LOS 4 SOBRE CANLA
 */

function realizarBajaSobreCanla($idSobreCanla) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE sobrecanla SET fechaBajaSobreCanla = '" . date("Y-m-d H:i:s") . "', estadoSobreCanla = 'B' 
                WHERE idSobreCanla = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idSobreCanla);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idSobreCanla);
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
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_commit($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

?>
