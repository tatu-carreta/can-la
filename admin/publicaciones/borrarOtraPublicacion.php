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

$infoValidate = validarBajaOtraPublicacion();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idOtraPublicacion = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaOtraPublicacion($idOtraPublicacion);

    if ($estadoEliminacion) {
        $texto = "La publicación se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la publicación. Vuelva a intentarlo en unos minutos.";
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
