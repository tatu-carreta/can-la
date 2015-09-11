<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesOtraPublicacion.php';
require_once '../../php/validate/validateOtraPublicacion.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionOtraPublicacion();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloOtraPublicacion = sanearDatos($_POST['tituloOtraPublicacion']);
    $descripcionOtraPublicacion = trim($_POST['descripcionOtraPublicacion']);
    $urlOtraPublicacion = sanearDatos($_POST['urlOtraPublicacion']);
    $idOtraPublicacion = sanearDatos($_POST['idOtraPublicacion']);


    $estadoAgregacion = realizarModificacionOtraPublicacion($tituloOtraPublicacion, $descripcionOtraPublicacion, $urlOtraPublicacion, $idOtraPublicacion);

    if ($estadoAgregacion == 1) {
        $texto = "La publicación se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar la publicación. Vuelva a intentarlo en unos minutos.";
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
