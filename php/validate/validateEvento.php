<?php

function validarAltaEvento() {

    $ok = false;
    $text = "";

    if (!isset($_POST['tituloEvento']) || ($_POST['tituloEvento'] == "") || (!is_string($_POST['tituloEvento']))) {
        $text = "Problema en el título del evento.";
    } elseif (!isset($_POST['lugarEvento']) || ($_POST['lugarEvento'] == "") || (!is_string($_POST['lugarEvento']))) {
        $text = "Problema en el lugar del evento.";
    } elseif (!isset($_POST['fechaInicioEvento']) || ($_POST['fechaInicioEvento'] == "") || (!is_string($_POST['fechaInicioEvento'])) || (!validateDate($_POST['fechaInicioEvento'], "d/m/Y"))) {
        $text = "Problema en la fecha de inicio del evento.";
    } elseif (!isset($_POST['fechaFinEvento']) || ($_POST['fechaFinEvento'] == "") || (!is_string($_POST['fechaFinEvento'])) || (!validateDate($_POST['fechaFinEvento'], "d/m/Y"))) {
        $text = "Problema en la fecha de fin del evento.";
    } elseif (!isset($_POST['descripcionEvento']) || ($_POST['descripcionEvento'] == "") || (!is_string($_POST['descripcionEvento']))) {
        $text = "Problema en la bajada del evento.";
    } elseif (!isset($_POST['cuerpoEvento']) || ($_POST['cuerpoEvento'] == "")) {
        $text = "Problema en el cuerpo del evento.";
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

function validarBajaEvento() {
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

function validarModificacionEvento() {
    $ok = false;
    $text = "";

    if (!isset($_POST['idEvento']) || ($_POST['idEvento'] == "") || (!is_numeric($_POST['idEvento']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloEvento']) || ($_POST['tituloEvento'] == "") || (!is_string($_POST['tituloEvento']))) {
        $text = "Problema en el título del evento.";
    } elseif (!isset($_POST['lugarEvento']) || ($_POST['lugarEvento'] == "") || (!is_string($_POST['lugarEvento']))) {
        $text = "Problema en el lugar del evento.";
    } elseif (!isset($_POST['fechaInicioEvento']) || ($_POST['fechaInicioEvento'] == "") || (!is_string($_POST['fechaInicioEvento'])) || (!validateDate($_POST['fechaInicioEvento'], "d/m/Y"))) {
        $text = "Problema en la fecha de inicio del evento.";
    } elseif (!isset($_POST['fechaFinEvento']) || ($_POST['fechaFinEvento'] == "") || (!is_string($_POST['fechaFinEvento'])) || (!validateDate($_POST['fechaFinEvento'], "d/m/Y"))) {
        $text = "Problema en la fecha de fin del evento.";
    } elseif (!isset($_POST['descripcionEvento']) || ($_POST['descripcionEvento'] == "") || (!is_string($_POST['descripcionEvento']))) {
        $text = "Problema en la bajada del evento.";
    } elseif (!isset($_POST['cuerpoEvento']) || ($_POST['cuerpoEvento'] == "")) {
        $text = "Problema en el cuerpo del evento.";
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

function validarVistaModificarEvento() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idEvento']) || ($_GET['idEvento'] == "") || (!is_numeric($_GET['idEvento']))) {
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

function validarAltaDestacadoEvento() {
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
