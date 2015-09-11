<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaArea() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['nombreArea']) || ($_POST['nombreArea'] == "") || (!is_string($_POST['nombreArea']))) {
        $text = "Problema en el nombre del área.";
    } elseif (!isset($_POST['descripcionArea']) || ($_POST['descripcionArea'] == "") || (!is_string($_POST['descripcionArea']))) {
        $text = "Problema en la descripción del área.";
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

function validarModificacionArea() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['nombreArea']) || ($_POST['nombreArea'] == "") || (!is_string($_POST['nombreArea']))) {
        $text = "Problema en el nombre del área.";
    } elseif (!isset($_POST['descripcionArea']) || ($_POST['descripcionArea'] == "") || (!is_string($_POST['descripcionArea']))) {
        $text = "Problema en la descripción del área.";
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

function validarBajaArea() {
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

function validarVistaModificarArea() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idArea']) || ($_GET['idArea'] == "") || (!is_numeric($_GET['idArea']))) {
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
