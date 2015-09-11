<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaOtraPublicacion() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['tituloOtraPublicacion']) || ($_POST['tituloOtraPublicacion'] == "") || (!is_string($_POST['tituloOtraPublicacion']))) {
        $text = "Problema en el título de la publicación.";
    } elseif (!isset($_POST['urlOtraPublicacion']) || ($_POST['urlOtraPublicacion'] == "") || (!is_string($_POST['urlOtraPublicacion'])) || (!filter_var($_POST['urlOtraPublicacion'], FILTER_VALIDATE_URL))) {
        $text = "Problema en la url de la publicación.";
    } else {

        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN LA MODIFICACION DE CANLA
 */

function validarModificacionOtraPublicacion() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['idOtraPublicacion']) || ($_POST['idOtraPublicacion'] == "") || (!is_numeric($_POST['idOtraPublicacion']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloOtraPublicacion']) || ($_POST['tituloOtraPublicacion'] == "") || (!is_string($_POST['tituloOtraPublicacion']))) {
        $text = "Problema en el título de la publicación.";
    } elseif (!isset($_POST['urlOtraPublicacion']) || ($_POST['urlOtraPublicacion'] == "") || (!is_string($_POST['urlOtraPublicacion'])) || (!filter_var($_POST['urlOtraPublicacion'], FILTER_VALIDATE_URL))) {
        $text = "Problema en la url de la publicación.";
    } else {

        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN LA BAJA DE CANLA
 */

function validarBajaOtraPublicacion() {
    //Valida id
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

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN LA VISTA MODIFICACION DE CANLA
 */

function validarVistaModificarOtraPublicacion() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idOtraPublicacion']) || ($_GET['idOtraPublicacion'] == "") || (!is_numeric($_GET['idOtraPublicacion']))) {
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
