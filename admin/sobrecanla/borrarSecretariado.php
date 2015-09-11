<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesSecretariado.php';
require_once '../../php/validate/validateSecretariado.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaSecretariado();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $id = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBaja($id);

    if ($estadoEliminacion) {
        $texto = "La persona se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la persona. Vuelva a intentarlo en unos minutos.";
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
