<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesPosicion.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validatePosicion.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionPosicion();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloPosicion = sanearDatos($_POST['tituloPosicion']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $archivoPosicion = $_POST['archivo'];
    } else {
        $archivoPosicion = NULL;
    }

    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }

    $idPosicion = sanearDatos($_POST['id']);

    $estadoAgregacion = realizarModificacionPosicion($tituloPosicion, $archivoPosicion, $idArea, $idPosicion);

    $eliminacionEtiquetas = eliminarEtiquetas('posicion', $idPosicion);

    if (!$eliminacionEtiquetas) {
        $estadoAgregacion = false;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idPosicion, 'posicion');
    }

    if ($estadoAgregacion == 1) {
        $texto = "La posición se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar la posición. Vuelva a intentarlo en unos minutos.";
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
