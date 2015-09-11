<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesBoletin.php';
require_once '../../php/validate/validateBoletin.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaBoletin();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idBoletin = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaArchivoBoletin($idBoletin);

    if ($estadoEliminacion) {
        $texto = "La imagen del boletín se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la imagen del boletín. Vuelva a intentarlo en unos minutos.";
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
