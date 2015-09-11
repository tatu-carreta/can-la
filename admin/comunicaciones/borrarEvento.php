<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEvento.php';
require_once '../../php/validate/validateEvento.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaEvento();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idEvento = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaEvento($idEvento);

    if ($estadoEliminacion) {
        $texto = "El evento se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el evento. Vuelva a intentarlo en unos minutos.";
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
