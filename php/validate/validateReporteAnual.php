<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaReporteAnual() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['tituloReporteAnual']) || ($_POST['tituloReporteAnual'] == "") || (!is_string($_POST['tituloReporteAnual']))) {
        $text = "Problema en el título del reporte anual.";
    } elseif (!isset($_POST['fechaManualReporteAnual']) || ($_POST['fechaManualReporteAnual'] == "") || (!is_string($_POST['fechaManualReporteAnual'])) || (!validateDate($_POST['fechaManualReporteAnual'], "d/m/Y"))) {
        $text = "Problema en la fecha del reporte anual.";
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

function validarModificacionReporteAnual() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['idReporteAnual']) || ($_POST['idReporteAnual'] == "") || (!is_numeric($_POST['idReporteAnual']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloReporteAnual']) || ($_POST['tituloReporteAnual'] == "") || (!is_string($_POST['tituloReporteAnual']))) {
        $text = "Problema en el título del reporte anual.";
    } elseif (!isset($_POST['fechaManualReporteAnual']) || ($_POST['fechaManualReporteAnual'] == "") || (!is_string($_POST['fechaManualReporteAnual'])) || (!validateDate($_POST['fechaManualReporteAnual'], "d/m/Y"))) {
        $text = "Problema en la fecha del reporte anual.";
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

function validarBajaArchivoReporteAnual() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_POST['idReporteAnual']) || ($_POST['idReporteAnual'] == "") || (!is_numeric($_POST['idReporteAnual']))) {
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
 * FUNCION DE VALIDACION DE LOS CAMPOS EN LA BAJA DE CANLA
 */

function validarBajaReporteAnual() {
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

function validarVistaModificarReporteAnual() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idReporteAnual']) || ($_GET['idReporteAnual'] == "") || (!is_numeric($_GET['idReporteAnual']))) {
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
