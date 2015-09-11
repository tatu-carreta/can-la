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

$infoValidate = validarModificacionAlianza();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $nombreAlianza = sanearDatos($_POST['nombreAlianza']);
    $urlAlianza = sanearDatos($_POST['urlAlianza']);
    $categoriaAlianza = sanearDatos($_POST['categoriaAlianza']);
    $idAlianza = sanearDatos($_POST['idAlianza']);

    if (isset($_POST['archivo'])) {
        $filename = $_POST['archivo'];
        $estadoAgregacion = realizarModificacionAlianza($nombreAlianza, $urlAlianza, $filename, $categoriaAlianza, $idAlianza);
    } else {
        $estadoAgregacion = realizarModificacionAlianza($nombreAlianza, $urlAlianza, null, $categoriaAlianza, $idAlianza);
    }

    if ($estadoAgregacion) {
        $texto = "La alianza se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar la alianza. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
    $estadoAgregacion = $infoValidate['estado'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto
);

echo json_encode($data);
?>
