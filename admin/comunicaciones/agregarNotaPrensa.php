<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNotaPrensa.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validateNotaPrensa.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarAltaNotaPrensa();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $ok = true;
    $tituloNotaPrensa = sanearDatos($_POST['tituloNotaPrensa']);
    $fechaNotaPrensa = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaNotaPrensa'])));

    $descripcionNotaPrensa = trim($_POST['descripcionNotaPrensa']);
    $cuerpoNotaPrensa = trim($_POST['cuerpoNotaPrensa']);
    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }

    $filenameImagen = sanearDatos($_POST['archivo']);

    $idNotaPrensa = realizarAgregacionNotaPrensa($tituloNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $descripcionNotaPrensa, $idArea, $filenameImagen);

    if ($idNotaPrensa > 0) {
        $estadoAgregacion = 1;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idNotaPrensa, 'notaprensa');
    }

    if ($estadoAgregacion == 1) {
        $texto = "La nota de prensa se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la nota de prensa. Vuelva a intentarlo en unos minutos.";
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
