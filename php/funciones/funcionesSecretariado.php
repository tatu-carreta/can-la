<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function listadoSecretariado() {
    $conectActual = conectar();

    $sql = "SELECT idSecretariado, nombreSecretariado, imagenSecretariado, cargoSecretariado, textoSecretariado
            FROM secretariado
            WHERE estadoSecretariado = 'A'
            ORDER BY ordenSecretariado";
    $stmt = mysqli_query($conectActual, $sql);

    $dataArray = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($dataArray, $result);
    }

    return $dataArray;
}

function realizarAgregacionSecretariado($nombreSecretariado, $cargoSecretariado, $textoSecretariado, $imagen, $tipoSecretariado) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;
        if ($orderArray = obtenerOrdenAInsertar()) {
            $orden = $orderArray[0]['ordenSecretariado'] + 1;
        } else {
            $orden = 1;
        }
        //echo ("orden: " . $orden);
        /* Inserción de Minorista */
        $sql = "INSERT INTO secretariado (imagenSecretariado, textoSecretariado, nombreSecretariado, cargoSecretariado, fechaCargaSecretariado, fechaModificacionSecretariado, estadoSecretariado, ordenSecretariado, tipoSecretariado)
                VALUES(?,?,?,?,'" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','A',?,?)";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssis', $imagen, $textoSecretariado, $nombreSecretariado, $cargoSecretariado, $orden, $tipoSecretariado);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssis', $imagen, $textoSecretariado, $nombreSecretariado, $cargoSecretariado, $orden, $tipoSecretariado);
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

function obtenerSecretariadoPorId($idSecretariado) {
    $conectActual = conectar();
    $sql = "SELECT idSecretariado, nombreSecretariado, imagenSecretariado, cargoSecretariado, textoSecretariado
            FROM secretariado
            WHERE estadoSecretariado = 'A' 
            AND idSecretariado = ? 
            LIMIT 1";

    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idSecretariado);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idSecretariado, $nombreSecretariado, $imagenSecretariado, $cargoSecretariado, $textoSecretariado);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idSecretariado' => $idSecretariado,
            'nombreSecretariado' => $nombreSecretariado,
            'imagenSecretariado' => $imagenSecretariado,
            'cargoSecretariado' => $cargoSecretariado,
            'textoSecretariado' => $textoSecretariado
        );
    } else {
        $result = array(
            'idSecretariado' => false,
            'nombreSecretariado' => false,
            'imagenSecretariado' => false,
            'cargoSecretariado' => false,
            'textoSecretariado' => false,
        );
    }

    return $result;
}

function obtenerOrdenAInsertar() {
    $conectActual = conectar();

    $sql = "SELECT ordenSecretariado
            FROM secretariado
            WHERE estadoSecretariado = 'A'
            ORDER BY ordenSecretariado
            DESC
            LIMIT 1";

    $stmt = mysqli_query($conectActual, $sql);

    $dataArray = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($dataArray, $result);
    }

    return $dataArray;
}

/*
 * FUNCIÓN DE ELIMINACIÓN DEL SECRETARIADO
 */

function realizarBaja($id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE secretariado SET fechaBajaSecretariado = '" . date("Y-m-d H:i:s") . "', estadoSecretariado = 'B' 
                WHERE idSecretariado = ?";
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

function eliminarImagen($id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */

        $sql = "UPDATE secretariado SET imagenSecretariado = NULL 
                WHERE idSecretariado = ?";
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

function realizarModificacion($nombre, $cargo, $texto, $id, $filename) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            $sql = "UPDATE secretariado 
            SET textoSecretariado = ?, nombreSecretariado = ?, 
            cargoSecretariado = ?, fechaModificacionSecretariado = '" . date("Y-m-d H:i:s") . "'
            WHERE idSecretariado = ?";
            $stmt = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($stmt, 'sssi', $texto, $nombre, $cargo, $id);
        } else {
            $sql = "UPDATE secretariado 
            SET imagenSecretariado = ?, textoSecretariado = ?, nombreSecretariado = ?, 
            cargoSecretariado = ?, fechaModificacionSecretariado = '" . date("Y-m-d H:i:s") . "'
            WHERE idSecretariado = ?";
            $stmt = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssi', $filename, $texto, $nombre, $cargo, $id);
        }


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
