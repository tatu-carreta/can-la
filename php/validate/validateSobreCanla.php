<?php

/*
 * FUNCION DE VALIDACION DE LOS CAMPOS EN EL ALTA DE CANLA
 */

function validarAltaSobreCanla() {
    //Valida cuerpo y tipo
    $ok = false;
    $text = "";

    $arregloTipos = array("O", "H", "C", "R");

    if (!isset($_POST['tipoSobreCanla']) || ($_POST['tipoSobreCanla'] == "") || (!in_array($_POST['tipoSobreCanla'], $arregloTipos))) {
        $text = "Problema en el tipo de texto.";
    } elseif (!isset($_POST['cuerpoSobreCanla']) || ($_POST['cuerpoSobreCanla'] == "")) {
        $text = "Problema en el cuerpo del texto.";
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

function validarModificarSobreCanla() {
    //Valida cuerpo e id
    $ok = false;
    $text = "";

    $arregloTipos = array("O", "H", "C", "R");

    if (!isset($_POST['idSobreCanla']) || ($_POST['idSobreCanla'] == "") || (!is_numeric($_POST['idSobreCanla']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tipoSobreCanla']) || ($_POST['tipoSobreCanla'] == "") || (!in_array($_POST['tipoSobreCanla'], $arregloTipos))) {
        $text = "Problema en el tipo de texto.";
    } elseif (!isset($_POST['cuerpoSobreCanla']) || ($_POST['cuerpoSobreCanla'] == "")) {
        $text = "Problema en el cuerpo del texto.";
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

function validarBajaSobreCanla() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_POST['idSobreCanla']) || ($_POST['idSobreCanla'] == "") || (!is_numeric($_POST['idSobreCanla']))) {
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

function validarVistaModificarSobreCanla() {
    //Valida id
    $ok = false;
    $text = "";

    if (!isset($_GET['idSobreCanla']) || ($_GET['idSobreCanla'] == "") || (!is_numeric($_GET['idSobreCanla']))) {
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
