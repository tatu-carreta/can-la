<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaEco() {
//Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['tituloEco']) || ($_POST['tituloEco'] == "") || (!is_string($_POST['tituloEco']))) {
        $text = "Problema en el título del eco en español.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en la carga del archivo.";
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

function validarModificacionEco() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['idEco']) || ($_POST['idEco'] == "") || (!is_numeric($_POST['idEco']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloEco']) || ($_POST['tituloEco'] == "") || (!is_string($_POST['tituloEco']))) {
        $text = "Problema en el título del eco en español.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en la carga del archivo.";
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

function validarBajaEco() {
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

function validarVistaModificarEco() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idEco']) || ($_GET['idEco'] == "") || (!is_numeric($_GET['idEco']))) {
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
