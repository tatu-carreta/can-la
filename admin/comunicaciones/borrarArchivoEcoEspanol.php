<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEco.php';
require_once '../../php/validate/validateEco.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaEco();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idEco = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaArchivoEco($idEco);

    if ($estadoEliminacion) {
        $texto = "La imagen del eco en español se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la imagen del eco en español. Vuelva a intentarlo en unos minutos.";
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
