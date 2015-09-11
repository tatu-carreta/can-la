<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesReporteAnual.php';
require_once '../../php/validate/validateReporteAnual.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaReporteAnual();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idReporteAnual = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaReporteAnual($idReporteAnual);

    if ($estadoEliminacion) {
        $texto = "El reporte anual se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el reporte anual. Vuelva a intentarlo en unos minutos.";
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
