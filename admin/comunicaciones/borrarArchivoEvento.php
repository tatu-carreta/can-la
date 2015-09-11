<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEvento.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

//$infoValidate = validarBajaPosicion();
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idArchivo = sanearDatos($_POST['id']);
    $carpeta = sanearDatos($_POST['carpeta']);

    $estadoEliminacion = realizarBajaArchivo($idArchivo, $carpeta);

    if ($estadoEliminacion) {
        $texto = "El archivo se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el archivo. Vuelva a intentarlo en unos minutos.";
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
