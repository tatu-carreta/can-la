<?php

function validarAltaPosicion() {

    $ok = false;
    $text = "";

    if (!isset($_POST['tituloPosicion']) || ($_POST['tituloPosicion'] == "") || (!is_string($_POST['tituloPosicion']))) {
        $text = "Problema en el título de la posición.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en el archivo que se intenta subir.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarBajaPosicion() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarModificacionPosicion() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloPosicion']) || ($_POST['tituloPosicion'] == "") || (!is_string($_POST['tituloPosicion']))) {
        $text = "Problema en el título de la posición.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en el archivo que se intenta subir.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarVistaModificarPosicion() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idPosicion']) || ($_GET['idPosicion'] == "") || (!is_numeric($_GET['idPosicion']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

?>
