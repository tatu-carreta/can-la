<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaBoletin() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['tituloBoletin']) || ($_POST['tituloBoletin'] == "") || (!is_string($_POST['tituloBoletin']))) {
        $text = "Problema en el título del boletín.";
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

function validarModificacionBoletin() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['idBoletin']) || ($_POST['idBoletin'] == "") || (!is_numeric($_POST['idBoletin']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloBoletin']) || ($_POST['tituloBoletin'] == "") || (!is_string($_POST['tituloBoletin']))) {
        $text = "Problema en el título del boletín.";
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

function validarBajaBoletin() {
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

function validarVistaModificarBoletin() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idBoletin']) || ($_GET['idBoletin'] == "") || (!is_numeric($_GET['idBoletin']))) {
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
