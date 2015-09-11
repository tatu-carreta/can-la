<?php

function validarAltaNoticia() {

    $ok = false;
    $text = "";

    if (!isset($_POST['tituloNoticia']) || ($_POST['tituloNoticia'] == "") || (!is_string($_POST['tituloNoticia']))) {
        $text = "Problema en el título de la noticia.";
    } elseif (!isset($_POST['fuenteNoticia']) || ($_POST['fuenteNoticia'] == "") || (!is_string($_POST['fuenteNoticia']))) {
        $text = "Problema en la fuente de la noticia.";
    } elseif (!isset($_POST['fechaNoticia']) || ($_POST['fechaNoticia'] == "") || (!is_string($_POST['fechaNoticia'])) || (!validateDate($_POST['fechaNoticia'], "d/m/Y"))) {
        $text = "Problema en la fecha de la noticia.";
    } elseif (!isset($_POST['descripcionNoticia']) || ($_POST['descripcionNoticia'] == "") || (!is_string($_POST['descripcionNoticia']))) {
        $text = "Problema en la bajada de la noticia.";
    } elseif (!isset($_POST['cuerpoNoticia']) || ($_POST['cuerpoNoticia'] == "")) {
        $text = "Problema en el cuerpo de la noticia.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text =
                "Problema en el archivo que se intenta subir.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarBajaNoticia() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']) )) {
        $text =
                "Problema en el pasaje de datos desde el administrador.";
    } else {
        $ok = true;
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text);

    return $data;
}

function validarModificacionNoticia() {
    $ok = false;
    $text = "";

    if (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST ['id']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['tituloNoticia']) || ($_POST ['tituloNoticia'] == "") || (!is_string($_POST['tituloNoticia']))) {
        $text = "Problema en el título de la noticia.";
    } elseif (!isset($_POST['fuenteNoticia']) || ($_POST ['fuenteNoticia'] == "") || (!is_string($_POST['fuenteNoticia']))) {
        $text = "Problema en la fuente de la noticia.";
    } elseif (!isset($_POST['fechaNoticia']) || ($_POST['fechaNoticia'] == "") || (!is_string($_POST['fechaNoticia'])) || (!validateDate($_POST ['fechaNoticia'], "d/m/Y"))) {
        $text = "Problema en la fecha de la noticia.";
    } elseif (!isset($_POST['descripcionNoticia']) || ($_POST['descripcionNoticia'] == "") || (!is_string($_POST ['descripcionNoticia']))) {
        $text = "Problema en la bajada de la noticia.";
    } elseif (!isset($_POST['cuerpoNoticia']) || ($_POST['cuerpoNoticia'] == "")) {
        $text =
                "Problema en el cuerpo de la noticia.";
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

function validarVistaModificarNoticia() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idNoticia']) || ($_GET['idNoticia'] == "") || (!is_numeric($_GET['idNoticia']))) {
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

function validarAltaDestacadoNoticia() {
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
