<?php

function conectar() {
    $conexion = mysqli_connect(DB_HOST, DB_USER_ACTUAL, DB_PASS_ACTUAL, DB_SELECTED_ACTUAL);

    if (!$conexion) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}

function conectarMirror() {
    $conexion = mysqli_connect(DB_HOST, DB_USER_MIRROR, DB_PASS_MIRROR, DB_SELECTED_MIRROR);

    if (!$conexion) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    mysqli_set_charset($conexion, 'utf8');
    return $conexion;
}

?>
