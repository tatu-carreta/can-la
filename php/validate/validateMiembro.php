<?php

function validarAltaMiembro() {

    $ok = false;
    $text = "";

    if (!isset($_POST['nombreMiembro']) || ($_POST['nombreMiembro'] == "") || (!is_string($_POST['nombreMiembro']))) {
        $text = "Problema en el título del miembro.";
    } elseif (!isset($_POST['representanteMiembro']) || ($_POST['representanteMiembro'] == "") || (!is_string($_POST['representanteMiembro']))) {
        $text = "Problema en el representante del miembro.";
    } elseif (!isset($_POST['descripcionMiembro']) || ($_POST['descripcionMiembro'] == "") || (!is_string($_POST['descripcionMiembro']))) {
        $text = "Problema en la descripcion del miembro.";
    } elseif (!isset($_POST['idPais']) || ($_POST['idPais'] == "") || (!is_numeric($_POST['idPais']))) {
        $text = "Problema en el país del miembro.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en el archivo que se intenta subir.";
    } else {
        if (isset($_POST['urlMiembro']) && ($_POST['urlMiembro'] != "")) {
            if ((!is_string($_POST['urlMiembro'])) || (!filter_var($_POST['urlMiembro'], FILTER_VALIDATE_URL))) {
                $text = "Problema en la url del miembro.";
                $ok = false;
            } else {
                $ok = true;
            }
        } else {
            $ok = true;
        }
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarBajaMiembro() {
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

function validarModificacionMiembro() {
    $ok = false;
    $text = "";

    if (!isset($_POST['idMiembro']) || ($_POST['idMiembro'] == "") || (!is_numeric($_POST['idMiembro']))) {
        $text = "Problema en el pasaje de datos desde el administrador.";
    } elseif (!isset($_POST['nombreMiembro']) || ($_POST['nombreMiembro'] == "") || (!is_string($_POST['nombreMiembro']))) {
        $text = "Problema en el título del miembro.";
    } elseif (!isset($_POST['representanteMiembro']) || ($_POST['representanteMiembro'] == "") || (!is_string($_POST['representanteMiembro']))) {
        $text = "Problema en el representante del miembro.";
    } elseif (!isset($_POST['descripcionMiembro']) || ($_POST['descripcionMiembro'] == "") || (!is_string($_POST['descripcionMiembro']))) {
        $text = "Problema en la descripcion del miembro.";
    } elseif (!isset($_POST['idPais']) || ($_POST['idPais'] == "") || (!is_numeric($_POST['idPais']))) {
        $text = "Problema en el país del miembro.";
    } elseif (!isset($_POST['archivo']) || ($_POST['archivo'] == "") || (!is_string($_POST['archivo']))) {
        $text = "Problema en el archivo que se intenta subir.";
    } else {
        if (isset($_POST['urlMiembro']) && ($_POST['urlMiembro'] != "")) {
            if ((!is_string($_POST['urlMiembro'])) || (!filter_var($_POST['urlMiembro'], FILTER_VALIDATE_URL))) {
                $text = "Problema en la url del miembro.";
                $ok = false;
            } else {
                $ok = true;
            }
        } else {
            $ok = true;
        }
    }

    $data = array(
        'estado' => $ok,
        'texto' => $text
    );

    return $data;
}

function validarVistaModificarMiembro() {
    $ok = false;
    $text = "";

    if (!isset($_GET['idMiembro']) || ($_GET['idMiembro'] == "") || (!is_numeric($_GET['idMiembro']))) {
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
