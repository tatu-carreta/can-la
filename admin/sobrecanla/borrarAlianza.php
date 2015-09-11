<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesAlianza.php';
require_once '../../php/validate/validateAlianza.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaAlianza();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idAlianza = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaAlianza($idAlianza);

    if ($estadoEliminacion) {
        $texto = "La alianza se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la alianza. Vuelva a intentarlo en unos minutos.";
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
