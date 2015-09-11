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

$infoValidate = validarModificacionNotaPrensa();
//$infoValidate['estado'] = true;
$href = "";
if ($infoValidate['estado']) {

    $tituloNotaPrensa = sanearDatos($_POST['tituloNotaPrensa']);
    $fechaNotaPrensa = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaNotaPrensa'])));

    $descripcionNotaPrensa = trim($_POST['descripcionNotaPrensa']);
    $cuerpoNotaPrensa = trim($_POST['cuerpoNotaPrensa']);
    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }
    $idNotaPrensa = sanearDatos($_POST['id']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $filename = $_POST['archivo'];
    } else {
        $filename = NULL;
    }

    $estadoAgregacion = realizarModificacionNotaPrensa($tituloNotaPrensa, $fechaNotaPrensa, $descripcionNotaPrensa, $cuerpoNotaPrensa, $descripcionNotaPrensa, $idArea, $filename, $idNotaPrensa);


    $eliminacionEtiquetas = eliminarEtiquetas('notaprensa', $idNotaPrensa);

    if (!$eliminacionEtiquetas) {
        $estadoAgregacion = false;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idNotaPrensa, 'notaprensa');
    }
    if ($estadoAgregacion == 1) {
        $texto = "La nota de prensa se ha modificado correctamente.";

        if (isset($_POST['mostrar']) && ($_POST['mostrar'] == "ok")) {
            if ($localhost) {
                $href = PATH_CONTROLLER_COMUNICACIONES . "controladorAdmin.php?seccion=notaPrensa&notaPrensaUrl=" . strtolower(urlAmigable($tituloNotaPrensa)) . "&language=" . $language;
            } else {
                $href = PATH_HOME . $language . "/notaPrensa/" . strtolower(urlAmigable($tituloNota));
            }
        }
    } else {
        $texto = "Hubo un error al modificar la nota de prensa. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
    $estadoAgregacion = $infoValidate['estado'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto,
    'href' => $href
);

echo json_encode($data);
?>
