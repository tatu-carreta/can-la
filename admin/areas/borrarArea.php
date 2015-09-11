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

$infoValidate = validarBajaArea();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idArea = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaArea($idArea);

    if ($estadoEliminacion) {
        $texto = "El área se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el área. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $estadoEliminacion = $infoValidate['estado'];
    $texto = $infoValidate['texto'];
}
$data = array(
    'estado' => $estadoEliminacion,
    'texto' => $texto
);

echo json_encode($data);
?>
