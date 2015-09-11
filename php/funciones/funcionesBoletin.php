<?php

function obtenerBoletines() {
    $conectActual = conectar();

    $sql = "SELECT idBoletin, tituloBoletin, archivoBoletin
            FROM boletin
            WHERE estadoBoletin = 'A'
            ORDER BY fechaCargaBoletin DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $boletines = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($boletines, $result);
    }

    return $boletines;
}

function obtenerDatosBoletinPorId($idBoletin) {
    $conectActual = conectar();

    $sql = "SELECT idBoletin, tituloBoletin, archivoBoletin
            FROM boletin
            WHERE idBoletin = ?
            AND estadoBoletin = 'A'
            ORDER BY fechaCargaBoletin DESC";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idBoletin);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idBoletin, $tituloBoletin, $archivoBoletin);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idBoletin' => $idBoletin,
            'tituloBoletin' => $tituloBoletin,
            'archivoBoletin' => $archivoBoletin
        );
    } else {
        $result = array(
            'idBoletin' => false,
            'tituloBoletin' => false,
            'archivoBoletin' => false
        );
    }

    return $result;
}

function realizarAgregacionBoletin($tituloBoletin, $filename) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO boletin (tituloBoletin, archivoBoletin, fechaCargaBoletin, fechaModificacionBoletin, estadoBoletin)
                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $tituloBoletin, $filename);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ss', $tituloBoletin, $filename);
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

function realizarModificacionBoletin($tituloBoletin, $filename, $idBoletin) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            /* Obtener archivo */
            $sql = "SELECT archivoBoletin
                FROM boletin 
                WHERE idBoletin = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idBoletin);
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
        $sql = "UPDATE boletin 
                SET tituloBoletin = ?, archivoBoletin = ?,
                fechaModificacionBoletin = '" . date("Y-m-d H:i:s") . "'
                WHERE idBoletin = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $tituloBoletin, $filename, $idBoletin);
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

function realizarBajaArchivoBoletin($idBoletin) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE boletin SET archivoBoletin = NULL, fechaModificacionBoletin = '" . date("Y-m-d H:i:s") . "'
                WHERE idBoletin = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idBoletin);
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

function realizarBajaBoletin($idBoletin) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE boletin SET fechaBajaBoletin = '" . date("Y-m-d H:i:s") . "', estadoBoletin = 'B' 
                WHERE idBoletin = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idBoletin);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idBoletin);
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
