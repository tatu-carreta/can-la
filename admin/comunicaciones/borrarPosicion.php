<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesPosicion.php';
require_once '../../php/validate/validatePosicion.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaPosicion();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idPosicion = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaPosicion($idPosicion);

    if ($estadoEliminacion) {
        $texto = "La posición se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la posición. Vuelva a intentarlo en unos minutos.";
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
