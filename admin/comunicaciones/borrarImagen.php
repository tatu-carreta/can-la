<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

//$infoValidate = validarBajaPosicion();
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idImagen = sanearDatos($_POST['id']);
    $carpeta = sanearDatos($_POST['carpeta']);

    $estadoEliminacion = realizarBajaImagen($idImagen, $carpeta);

    if ($estadoEliminacion) {
        $texto = "La foto se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la foto. Vuelva a intentarlo en unos minutos.";
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
