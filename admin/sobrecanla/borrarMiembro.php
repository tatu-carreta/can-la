<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesMiembro.php';
require_once '../../php/validate/validateMiembro.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaMiembro();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idMiembro = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaMiembro($idMiembro);

    if ($estadoEliminacion) {
        $texto = "El miembro se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el miembro. Vuelva a intentarlo en unos minutos.";
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
