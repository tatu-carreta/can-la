<?php

function validarAltaEtiqueta() {
    $ok = false;
    $text = "";

    $arregloTipos = array("notaprensa", "noticia", "publicacioncanla", "posicion");

    if (!isset($_POST['nombreEtiqueta']) || ($_POST['nombreEtiqueta'] == "") || (!is_string($_POST['nombreEtiqueta']))) {
        $text = "Problema en el nombre de la etiqueta.";
    } elseif (!isset($_POST['id']) || ($_POST['id'] == "") || (!is_numeric($_POST['id']))) {
        $text = "Problema en los parámetros requeridos.";
    } elseif (!isset($_POST['carpeta']) || ($_POST['carpeta'] == "") || (!is_string($_POST['carpeta'])) || (!in_array($_POST['carpeta'], $arregloTipos))) {
        $text = "Problema en los parámetros requeridos.";
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
