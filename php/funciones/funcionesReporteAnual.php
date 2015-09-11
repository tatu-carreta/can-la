<?php

function obtenerReportes() {
    $conectActual = conectar();

    $sql = "SELECT idReporteAnual, tituloReporteAnual, imagenReporteAnual, archivoReporteAnual, fechaManualReporteAnual
            FROM reporteanual
            WHERE estadoReporteAnual = 'A'
            ORDER BY fechaCargaReporteAnual DESC";
    $stmt = mysqli_query($conectActual, $sql);

    $reportes = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($reportes, $result);
    }

    return $reportes;
}

function obtenerDatosReporteAnualPorId($idReporteAnual) {
    $conectActual = conectar();

    $sql = "SELECT idReporteAnual, imagenReporteAnual, tituloReporteAnual, archivoReporteAnual, fechaManualReporteAnual
            FROM reporteanual
            WHERE idReporteAnual = ?
            AND estadoReporteAnual = 'A'";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idReporteAnual);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idReporteAnual, $imagenReporteAnual, $tituloReporteAnual, $archivoReporteAnual, $fechaManualReporteAnual);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idReporteAnual' => $idReporteAnual,
            'imagenReporteAnual' => $imagenReporteAnual,
            'tituloReporteAnual' => $tituloReporteAnual,
            'archivoReporteAnual' => $archivoReporteAnual,
            'fechaManualReporteAnual' => $fechaManualReporteAnual
        );
    } else {
        $result = array(
            'idReporteAnual' => false,
            'imagenReporteAnual' => false,
            'tituloReporteAnual' => false,
            'archivoReporteAnual' => false,
            'fechaManualReporteAnual' => false
        );
    }

    return $result;
}

function realizarAgregacionReporteAnual($tituloReporteAnual, $fechaManualReporteAnual, $pdfFile, $pdfImage) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO reporteanual (imagenReporteAnual, tituloReporteAnual, archivoReporteAnual, fechaManualReporteAnual, fechaCargaReporteAnual, fechaModificacionReporteAnual, estadoReporteAnual)
                VALUES(?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A')";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $pdfImage, $tituloReporteAnual, $pdfFile, $fechaManualReporteAnual);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssss', $pdfImage, $tituloReporteAnual, $pdfFile, $fechaManualReporteAnual);
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

function realizarModificacionReporteAnual($tituloReporteAnual, $fechaManualReporteAnual, $filename, $pdfImage, $idReporteAnual) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            /* Obtener archivo */
            $sql = "SELECT archivoReporteAnual
                FROM reporteanual 
                WHERE idReporteAnual = ?";
            $query = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($query, 'i', $idReporteAnual);
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
        $sql = "UPDATE reporteanual 
                SET imagenReporteAnual = ?, tituloReporteAnual = ?, archivoReporteAnual = ?, 
                fechaManualReporteAnual = ?, fechaModificacionReporteAnual = '" . date("Y-m-d H:i:s") . "'
                WHERE idReporteAnual = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $pdfImage, $tituloReporteAnual, $filename, $fechaManualReporteAnual, $idReporteAnual);
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
 * FUNCIÓN DE ELIMINACIÓN DEL REPORTE ANUAL
 */

function realizarBajaReporteAnual($idReporteAnual) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE reporteanual SET fechaBajaReporteAnual = '" . date("Y-m-d H:i:s") . "', estadoReporteAnual = 'B' 
                WHERE idReporteAnual = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idReporteAnual);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idReporteAnual);
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

function realizarBajaArchivoReporteAnual($idReporteAnual) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE reporteanual SET imagenReporteAnual = NULL, archivoReporteAnual = NULL, fechaModificacionReporteAnual = '" . date("Y-m-d H:i:s") . "'
                WHERE idReporteAnual = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idReporteAnual);
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
