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

$infoValidate = validarAltaAlianza();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $nombreAlianza = sanearDatos($_POST['nombreAlianza']);
    $urlAlianza = sanearDatos($_POST['urlAlianza']);
    $categoriaAlianza = sanearDatos($_POST['categoriaAlianza']);

    $filename = $_POST['archivo'];
    
    $estadoAgregacion = realizarAgregacionAlianza($nombreAlianza, $urlAlianza, $categoriaAlianza, $filename);

    if ($estadoAgregacion == 1) {
        $texto = "La alianza se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la alianza. Vuelva a intentarlo en unos minutos.";
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
