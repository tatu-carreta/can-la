<?php

function realizarAgregacionEtiqueta($nombreEtiqueta, $nombreEtiquetaUrl, $id, $carpeta) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        $sqlEtiqueta = "SELECT idEtiqueta
                        FROM etiqueta
                        WHERE nombreEtiqueta = ?";
        $stmtEtiqueta = mysqli_prepare($conectActual, $sqlEtiqueta);
        mysqli_stmt_bind_param($stmtEtiqueta, 's', $nombreEtiqueta);
        mysqli_stmt_execute($stmtEtiqueta);

        mysqli_stmt_bind_result($stmtEtiqueta, $idEtiquetaConsulta);

        mysqli_stmt_store_result($stmtEtiqueta);

        if (mysqli_stmt_num_rows($stmtEtiqueta) > 0) {
            $row = mysqli_stmt_fetch($stmtEtiqueta);
            $idEtiqueta = $idEtiquetaConsulta;
        } else {
            /* Inserción de Minorista */
            $sql = "INSERT INTO etiqueta (nombreEtiqueta, nombreEtiquetaUrl, fechaCargaEtiqueta)
                VALUES(?, ?, '" . date("Y-m-d H:i:s") . "')";
            $stmt = mysqli_prepare($conectActual, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $nombreEtiqueta, $nombreEtiquetaUrl);
            if (!mysqli_stmt_execute($stmt)) {
                $estadoConsulta = FALSE;
            }
            mysqli_stmt_close($stmt);

            $stmt2 = mysqli_prepare($conectMirror, $sql);
            mysqli_stmt_bind_param($stmt2, 'ss', $nombreEtiqueta, $nombreEtiquetaUrl);
            if (!mysqli_stmt_execute($stmt2)) {
                $estadoConsulta = FALSE;
               
            }
            mysqli_stmt_close($stmt2);

            $idEtiqueta = mysqli_insert_id($conectActual);


        }

        switch ($carpeta) {
            case 'notaprensa':
                $sqlInsert = "INSERT INTO " . $carpeta . "_etiqueta (idNotaPrensa, idEtiqueta, estadoNotaPrensaEtiqueta)
                                VALUES(?,?,'A')";
                break;
            case 'noticia':
                $sqlInsert = "INSERT INTO " . $carpeta . "_etiqueta (idNoticia, idEtiqueta, estadoNoticiaEtiqueta)
                                VALUES(?,?,'A')";
                break;
            case 'publicacioncanla':
                $sqlInsert = "INSERT INTO " . $carpeta . "_etiqueta (idPublicacionCanla, idEtiqueta, estadoPublicacionCanlaEtiqueta)
                                VALUES(?,?,'A')";
                break;
            case 'posicion':
                $sqlInsert = "INSERT INTO " . $carpeta . "_etiqueta (idPosicion, idEtiqueta, estadoPosicionEtiqueta)
                                VALUES(?,?,'A')";
                break;
        }


        $stmt = mysqli_prepare($conectActual, $sqlInsert);
        mysqli_stmt_bind_param($stmt, 'ii', $id, $idEtiqueta);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;

        }
        mysqli_stmt_close($stmt);

        $stmt2 = mysqli_prepare($conectMirror, $sqlInsert);
        mysqli_stmt_bind_param($stmt2, 'ii', $id, $idEtiqueta);
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


function buscarEtiqueta($query)
{
    $consulta = $query."%";
    $conectActual = conectar();

    $sql = "SELECT nombreEtiqueta
            FROM etiqueta
            WHERE nombreEtiqueta LIKE ? ";
    $stmt = mysqli_prepare($conectActual, $sql);
    mysqli_stmt_bind_param($stmt, 's', $consulta);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $nombreEtiqueta);

    mysqli_stmt_store_result($stmt);

    $result = array();

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {
            $row = $nombreEtiqueta;
          

            array_push($result, $row);
        }
    }
    return $result;
}

function eliminarEtiquetas($carpeta, $id)
{
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        $estadoConsulta = TRUE;

        /* Inserción de Minorista */

       switch ($carpeta) {
            case 'notaprensa':
                $sql = "UPDATE " . $carpeta . "_etiqueta SET estadoNotaPrensaEtiqueta = 'B' WHERE idNotaPrensa = ? ";
                break;
            case 'noticia':
                $sql = "UPDATE " . $carpeta . "_etiqueta SET estadoNoticiaEtiqueta = 'B' WHERE idNoticia = ? ";
                break;
            case 'publicacioncanla':
                $sql = "UPDATE " . $carpeta . "_etiqueta SET estadoPublicacionCanlaEtiqueta = 'B' WHERE idPublicacionCanla = ? ";
                break;
            case 'posicion':
                $sql = "UPDATE " . $carpeta . "_etiqueta SET estadoPosicionEtiqueta = 'B' WHERE idPosicion = ? ";
                break;
        }
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


?>
