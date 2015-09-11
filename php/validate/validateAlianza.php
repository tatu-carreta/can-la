<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaAlianza() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    if (!isset($_POST['nombreAlianza']) || ($_POST['nombreAlianza'] == "") || (!is_string($_POST['nombreAlianza']))) {
        $text = "Problema en el nombre de la alianza.";
    } elseif (!isset($_POST['urlAlianza']) || ($_POST['urlAlianza'] == "") || (!is_string($_POST['urlAlianza'])) || (!filter_var($_POST['urlAlianza'], FILTER_VALIDATE_URL))) {
        $text = "Problema en la url de la alianza.";
    } elseif (!isset($_POST['categoriaAlianza']) || ($_POST['categoriaAlianza'] == "") || (!is_numeric($_POST['categoriaAlianza']))) {
        $text = "Problema en la categoría de la alianza.";
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

function validarModificacionAlianza() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    if (!isset($_POST['idAlianza']) || ($_POST['idAlianza'] == "") || (!is_numeric($_POST['idAlianza']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['nombreAlianza']) || ($_POST['nombreAlianza'] == "") || (!is_string($_POST['nombreAlianza']))) {
        $text = "Problema en el nombre de la alianza.";
    } elseif (!isset($_POST['urlAlianza']) || ($_POST['urlAlianza'] == "") || (!is_string($_POST['urlAlianza'])) || (!filter_var($_POST['urlAlianza'], FILTER_VALIDATE_URL))) {
        $text = "Problema en la url de la alianza.";
    } elseif (!isset($_POST['categoriaAlianza']) || ($_POST['categoriaAlianza'] == "") || (!is_numeric($_POST['categoriaAlianza']))) {
        $text = "Problema en la categoría de la alianza.";
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

function validarBajaArchivoAlianza() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_POST['idAlianza']) || ($_POST['idAlianza'] == "") || (!is_numeric($_POST['idAlianza']))) {
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

function validarBajaAlianza() {
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

function validarVistaModificarAlianza() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idAlianza']) || ($_GET['idAlianza'] == "") || (!is_numeric($_GET['idAlianza']))) {
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
