<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNotaPrensa.php';
require_once '../../php/validate/validateNotaPrensa.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarAltaDestacadoNotaPrensa();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $imagenNotaPrensa = sanearDatos($_POST['archivo']);
    $idNotaPrensa = sanearDatos($_POST['id']);

    $estadoAgregacion = destacarNotaPrensa($imagenNotaPrensa, $idNotaPrensa);

    if ($estadoAgregacion == 1) {
        $texto = "La nota de prensa se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la nota de prensa. Vuelva a intentarlo en unos minutos.";
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
