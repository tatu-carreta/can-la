<?php

function validarAltaSecretariado() {

    $ok = false;
    $text = "";

    if (!isset($_POST['nombre']) || ($_POST['nombre'] == "") || (!is_string($_POST['nombre']))) {
        $text = "Problema en el nombre del secretariado.";
    } elseif (!isset($_POST['cargo']) || ($_POST['cargo'] == "") || (!is_string($_POST['cargo']))) {
        $text = "Problema en el cargo del secretariado.";
    } elseif (!isset($_POST['texto']) || ($_POST['texto'] == "") || (!is_string($_POST['texto']))) {
        $text = "Problema en el texto del secretariado.";
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

function validarBajaSecretariado() {
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

function validarModificacionSecretariado() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['nombre']) || ($_POST['nombre'] == "") || (!is_string($_POST['nombre']))) {
        $text = "Problema en el nombre del secretariado.";
    } elseif (!isset($_POST['cargo']) || ($_POST['cargo'] == "") || (!is_string($_POST['cargo']))) {
        $text = "Problema en el cargo del secretariado.";
    } elseif (!isset($_POST['texto']) || ($_POST['texto'] == "") || (!is_string($_POST['texto']))) {
        $text = "Problema en el texto del secretariado.";
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

function validarVistaModificarSecretariado() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idSecretariado']) || ($_GET['idSecretariado'] == "") || (!is_numeric($_GET['idSecretariado']))) {
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
