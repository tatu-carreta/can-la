<?php

function obtenerDatosAlianzaPorId($idAlianza) {
    $conectActual = conectar();

    $sql = "SELECT idAlianza, logoAlianza, nombreAlianza, urlAlianza, categoriaAlianza
            FROM alianza
            WHERE estadoAlianza = 'A'
            AND idAlianza = ?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idAlianza);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idAlianza, $logoAlianza, $nombreAlianza, $urlAlianza, $categoriaAlianza);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idAlianza' => $idAlianza,
            'logoAlianza' => $logoAlianza,
            'nombreAlianza' => $nombreAlianza,
            'urlAlianza' => $urlAlianza,
            'categoriaAlianza' => $categoriaAlianza
        );
    } else {
        $result = array(
            'idAlianza' => false,
            'logoAlianza' => false,
            'nombreAlianza' => false,
            'urlAlianza' => false,
            'categoriaAlianza' => false
        );
    }

    return $result;
}

function obtenerDatosAlianzasPorCategoria($categoria) {
    $conectActual = conectar();

    $sql = "SELECT idAlianza, logoAlianza, nombreAlianza, urlAlianza, categoriaAlianza
            FROM alianza
            WHERE estadoAlianza = 'A'
            AND categoriaAlianza = ?
            ORDER BY nombreAlianza";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $categoria);
    mysqli_stmt_execute($stmt);

    $alianzas = array();
    mysqli_stmt_bind_result($stmt, $idAlianza, $logoAlianza, $nombreAlianza, $urlAlianza, $categoriaAlianza);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while ($row = mysqli_stmt_fetch($stmt)) {


            $dataAlianza = array(
                'idAlianza' => $idAlianza,
                'logoAlianza' => $logoAlianza,
                'nombreAlianza' => $nombreAlianza,
                'urlAlianza' => $urlAlianza,
                'categoriaAlianza' => $categoriaAlianza
            );

            array_push($alianzas, $dataAlianza);
        }

        return $alianzas;
    }
}

function realizarAgregacionAlianza($nombreAlianza, $urlAlianza, $categoriaAlianza, $filename) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO alianza (logoAlianza, nombreAlianza, urlAlianza, categoriaAlianza, fechaCargaAlianza, fechaModificacionAlianza, estadoAlianza)
                VALUES(?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $filename, $nombreAlianza, $urlAlianza, $categoriaAlianza);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'sssi', $filename, $nombreAlianza, $urlAlianza, $categoriaAlianza);
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

function realizarModificacionAlianza($nombreAlianza, $urlAlianza, $filename, $categoriaAlianza, $idAlianza) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            /* Obtener archivo */
            $sql = "SELECT logoAlianza
                FROM alianza 
                WHERE idAlianza = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idAlianza);
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

        /* Inserción de Minorista */
        $sql = "UPDATE alianza 
                SET logoAlianza = ?, nombreAlianza = ?, urlAlianza = ?, 
                categoriaAlianza = ?, fechaModificacionAlianza = '" . date("Y-m-d H:i:s") . "'
                WHERE idAlianza = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $filename, $nombreAlianza, $urlAlianza, $categoriaAlianza, $idAlianza);
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

function realizarBajaAlianza($idAlianza) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE alianza SET fechaBajaAlianza = '" . date("Y-m-d H:i:s") . "', estadoAlianza = 'B' 
                WHERE idAlianza = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idAlianza);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idAlianza);
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

function realizarBajaArchivoAlianza($idAlianza) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE alianza SET logoAlianza = NULL, fechaModificacionAlianza = '" . date("Y-m-d H:i:s") . "'
                WHERE idAlianza = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idAlianza);
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
