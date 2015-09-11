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

$infoValidate = validarAltaPosicion();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $tituloPosicion = sanearDatos($_POST['tituloPosicion']);
    $archivoPosicion = sanearDatos($_POST['archivo']);
    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }

    $idPosicion = realizarAgregacionPosicion($tituloPosicion, $archivoPosicion, $idArea);

    if ($idPosicion > 0) {
        $estadoAgregacion = 1;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idPosicion, 'posicion');
    }

    if ($estadoAgregacion) {
        $texto = "La posición se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la posición. Vuelva a intentarlo en unos minutos.";
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
