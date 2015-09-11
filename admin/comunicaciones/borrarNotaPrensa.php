<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNotaPrensa.php';
require_once '../../php/validate/validateNotaPrensa.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaNotaPrensa();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idNotaPrensa = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaNotaPrensa($idNotaPrensa);

    if ($estadoEliminacion) {
        $texto = "La nota de prensa se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la nota de prensa. Vuelva a intentarlo en unos minutos.";
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
