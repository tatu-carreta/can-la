<?php

function validarDatosLogin() {
    $ok = false;
    $text = "";

    if (!isset($_POST['user']) || ($_POST['user'] == "")) {
        $text = "Problema en el nombre de usuario";
    } elseif (!isset($_POST['pass']) || ($_POST['user'] == "")) {
        $text = "Problema en la contraseña.";
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
