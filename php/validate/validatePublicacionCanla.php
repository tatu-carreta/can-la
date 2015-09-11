<?php

function validarAltaPublicacionCanla() {

    $ok = false;
    $text = "";

    if (!isset($_POST['tituloPublicacionCanla']) || ($_POST['tituloPublicacionCanla'] == "") || (!is_string($_POST['tituloPublicacionCanla']))) {
        $text = "Problema en el título de la publicación.";
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

function validarBajaPublicacionCanla() {
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

function validarModificacionPublicacionCanla() {
    $ok = false;
    $text = "";

    if (!isset($_POST['idPublicacionCanla']) || ($_POST['idPublicacionCanla'] == "") || (!is_numeric($_POST['idPublicacionCanla']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloPublicacionCanla']) || ($_POST['tituloPublicacionCanla'] == "") || (!is_string($_POST['tituloPublicacionCanla']))) {
        $text = "Problema en el título de la publicación.";
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

function validarVistaModificarPublicacionCanla() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idPublicacionCanla']) || ($_GET['idPublicacionCanla'] == "") || (!is_numeric($_GET['idPublicacionCanla']))) {
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
