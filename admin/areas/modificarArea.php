<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesArea.php';
require_once '../../php/validate/validateArea.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionArea();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $ok = true;
    $nombreArea = $_POST['nombreArea'];
    $descripcionArea = trim($_POST['descripcionArea']);
    $idArea = sanearDatos($_POST['id']);

    if (isset($_POST['archivo']) && ($_POST['archivo']!= "")) {
        $filename = $_POST['archivo'];
    } else {
        $filename = NULL;
    }

    if ($ok) {
        $estadoAgregacion = realizarModificacionArea($nombreArea, $descripcionArea, $filename, $idArea);

        if ($estadoAgregacion == 1) {
            $texto = "El área se ha modificado correctamente.";
        } else {
            $texto = "Hubo un error al modificar el área. Vuelva a intentarlo en unos minutos.";
        }
    } else {
        $texto = "Hubo un error al cargar la imagen en el sevidor. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
    $estadoAgregacion = $infoValidate['estado'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto
);

echo json_encode($data);
?>
