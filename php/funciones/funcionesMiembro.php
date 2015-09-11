<?php

function obtenerPaises() {
    $conectActual = conectar();

    $sql = "SELECT idPais,nombrePais
            FROM pais ORDER BY nombrePais";
    $stmt = mysqli_query($conectActual, $sql);

    $paises = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($paises, $result);
    }

    return $paises;
}

function obtenerPaisesJson() {
    $conectActual = conectar();

    $sql = "SELECT nombrePais
            FROM pais ORDER BY nombrePais";
    $stmt = mysqli_query($conectActual, $sql);

    $paises = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($paises, $result['nombrePais']);
    }

    return $paises;
}

function obtenerMiembrosPorIdPais($idPais) {
    $conectActual = conectar();

    $sql = "SELECT m.idMiembro, m.logoMiembro, m.nombreMiembro, m.urlMiembro, m.representanteMiembro, m.direccionMiembro, m.descripcionMiembro, m.latitud, m.longitud, p.nombrePais
            FROM miembro as m
            INNER JOIN pais as p ON (p.idPais = m.idPais)
            WHERE m.estadoMiembro = 'A'
            AND m.idPais = ?";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idPais);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idMiembro, $logoMiembro, $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $latitud, $longitud, $nombrePais);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = array(
                'idMiembro' => $idMiembro,
                'logoMiembro' => $logoMiembro,
                'nombreMiembro' => $nombreMiembro,
                'urlMiembro' => $urlMiembro,
                'representanteMiembro' => $representanteMiembro,
                'direccionMiembro' => $direccionMiembro,
                'descripcionMiembro' => $descripcionMiembro,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'nombrePais' => $nombrePais
            );

            array_push($result, $row);
        }
    }

    return $result;
}

function obtenerMiembros() {
    $conectActual = conectar();

    $sql = "SELECT m.idMiembro, m.logoMiembro, m.nombreMiembro, m.urlMiembro, m.representanteMiembro, m.direccionMiembro, m.descripcionMiembro, m.latitud, m.longitud, p.nombrePais
            FROM miembro as m
            INNER JOIN pais as p ON (p.idPais = m.idPais)
            WHERE m.estadoMiembro = 'A'
            ORDER BY m.idPais, m.nombreMiembro";
    $stmt = mysqli_query($conectActual, $sql);

    $miembros = array();

    while ($result = mysqli_fetch_assoc($stmt)) {
        array_push($miembros, $result);
    }

    return $miembros;
}

function obtenerMiembroPorId($idMiembro) {
    $conectActual = conectar();
    $sql = "SELECT idMiembro, logoMiembro, nombreMiembro, urlMiembro, representanteMiembro, direccionMiembro, descripcionMiembro, latitud, longitud, idPais
            FROM miembro
            WHERE idMiembro = ? 
            LIMIT 1";

    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idMiembro);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idMiembro, $logoMiembro, $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $latitud, $longitud, $idPais);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'idMiembro' => $idMiembro,
            'logoMiembro' => $logoMiembro,
            'nombreMiembro' => $nombreMiembro,
            'urlMiembro' => $urlMiembro,
            'representanteMiembro' => $representanteMiembro,
            'direccionMiembro' => $direccionMiembro,
            'descripcionMiembro' => $descripcionMiembro,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'idPais' => $idPais
        );
    } else {
        $result = array(
            'idMiembro' => false,
            'logoMiembro' => false,
            'nombreMiembro' => false,
            'urlMiembro' => false,
            'representanteMiembro' => false,
            'direccionMiembro' => false,
            'descripcionMiembro' => false,
            'latitud' => false,
            'longitud' => false,
            'idPais' => false
        );
    }

    return $result;
}

function realizarAgregacionMiembro($nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $latitud, $longitud, $descripcionMiembro, $filename, $idPais) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "INSERT INTO miembro (logoMiembro, nombreMiembro, urlMiembro, representanteMiembro, direccionMiembro, descripcionMiembro, latitud, longitud, idPais, fechaCargaMiembro, fechaModificacionMiembro, estadoMiembro)
                VALUES(?, ?, ?, ?, ?, ?, '0', '0', ?, '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "', 'A')";
        $stmt = mysqli_prepare($conectActual, $sql);

        mysqli_stmt_bind_param($stmt, 'ssssssi', $filename, $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $idPais);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssssi', $filename, $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $idPais);
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

function realizarModificacionMiembro($nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $latitud, $longitud, $descripcionMiembro, $filename, $idMiembro, $idPais) {
    $conectActual = conectar();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        if (is_null($filename)) {
            $sql = "UPDATE miembro 
            SET nombreMiembro = ?, urlMiembro = ?, 
            representanteMiembro = ?, direccionMiembro = ?, descripcionMiembro = ?, idPais = ?, fechaModificacionMiembro = '" . date("Y-m-d H:i:s") . "'
            WHERE idMiembro = ?";
            $stmt = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($stmt, 'sssssii', $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $idPais, $idMiembro);
        } else {
            $sql = "UPDATE miembro 
            SET logoMiembro = ?, nombreMiembro = ?, urlMiembro = ?, 
            representanteMiembro = ?, direccionMiembro = ?, descripcionMiembro = ?, idPais = ?, fechaModificacionMiembro = '" . date("Y-m-d H:i:s") . "'
            WHERE idMiembro = ?";
            $stmt = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssssii', $filename, $nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $descripcionMiembro, $idPais, $idMiembro);
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

function realizarBajaLogoMiembro($idMiembro) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */

        $sql = "UPDATE miembro SET logoMiembro = NULL 
                WHERE idMiembro = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idMiembro);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idMiembro);
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

function realizarBajaMiembro($idMiembro) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */
        $sql = "UPDATE miembro SET fechaBajaMiembro = '" . date("Y-m-d H:i:s") . "', estadoMiembro = 'B' 
                WHERE idMiembro = ?";
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idMiembro);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idMiembro);
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
