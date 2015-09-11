<?php

/*
 * Busqueda para el login
 */

function obtenerUsuarioPorNombreClave($nombre, $clave) {
    $conect = conectar();
    $sql = "SELECT u.idUsuario, u.idPerfil, u.iderUser
            FROM usuario as u
            WHERE u.estadoUsuario = 'A'
            AND u.nombreUsuario = ? 
            AND u.claveUsuario = ?";
    $stmt = mysqli_prepare($conect, $sql);
    $nombre = hashData($nombre);
    $clave = hashData($clave);
    mysqli_stmt_bind_param($stmt, 'ss', $nombre, $clave);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $idUsuario, $idPerfil, $iderUser);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $row = mysqli_stmt_fetch($stmt);

        $result = array(
            'estado' => true,
            'perfil' => $idPerfil,
            'idUsuario' => $idUsuario,
            'iderUser' => $iderUser
        );
    } else {
        $result = array(
            'estado' => false
        );
    }

    return $result;
}

/*
 * Monitoreo del usuario cuando se loguea
 */

function realizarInformeUsuarioLogueado($idUsuario, $ipUsuario) {
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $ok = false;
    $conect = conectar();
    $sql = "UPDATE usuario 
            SET cantidadIngresos = cantidadIngresos+1 
            WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conect, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idUsuario);
    mysqli_stmt_execute($stmt);
    $ok = true;

    return $ok;
}

?>
