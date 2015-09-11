<?php

function validarAltaNotaPrensa() {

    $ok = false;
    $text = "";

    if (!isset($_POST['tituloNotaPrensa']) || ($_POST['tituloNotaPrensa'] == "") || (!is_string($_POST['tituloNotaPrensa']))) {
        $text = "Problema en el título de la nota de prensa.";
    } elseif (!isset($_POST['fechaNotaPrensa']) || ($_POST['fechaNotaPrensa'] == "") || (!is_string($_POST['fechaNotaPrensa'])) || (!validateDate($_POST['fechaNotaPrensa'], "d/m/Y"))) {
        $text = "Problema en la fecha de la noticia.";
    } elseif (!isset($_POST['descripcionNotaPrensa']) || ($_POST['descripcionNotaPrensa'] == "") || (!is_string($_POST['descripcionNotaPrensa']))) {
        $text = "Problema en la bajada de la noticia.";
    } elseif (!isset($_POST['cuerpoNotaPrensa']) || ($_POST['cuerpoNotaPrensa'] == "")) {
        $text = "Problema en el cuerpo de la noticia.";
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

function validarBajaNotaPrensa() {
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

function validarModificacionNotaPrensa() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloNotaPrensa']) || ($_POST['tituloNotaPrensa'] == "") || (!is_string($_POST['tituloNotaPrensa']))) {
        $text = "Problema en el título de la nota de prensa.";
    } elseif (!isset($_POST['fechaNotaPrensa']) || ($_POST['fechaNotaPrensa'] == "") || (!is_string($_POST['fechaNotaPrensa'])) || (!validateDate($_POST['fechaNotaPrensa'], "d/m/Y"))) {
        $text = "Problema en la fecha de la noticia.";
    } elseif (!isset($_POST['descripcionNotaPrensa']) || ($_POST['descripcionNotaPrensa'] == "") || (!is_string($_POST['descripcionNotaPrensa']))) {
        $text = "Problema en la bajada de la noticia.";
    } elseif (!isset($_POST['cuerpoNotaPrensa']) || ($_POST['cuerpoNotaPrensa'] == "")) {
        $text = "Problema en el cuerpo de la noticia.";
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

function validarVistaModificarNotaPrensa() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idNotaPrensa']) || ($_GET['idNotaPrensa'] == "") || (!is_numeric($_GET['idNotaPrensa']))) {
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

function validarAltaDestacadoNotaPrensa() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
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

?>
