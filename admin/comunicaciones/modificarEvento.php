<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEvento.php';
require_once '../../php/validate/validateEvento.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionEvento();
//$infoValidate['estado'] = true;
$href = "";
if ($infoValidate['estado']) {

    $tituloEvento = sanearDatos($_POST['tituloEvento']);
    $lugarEvento = sanearDatos($_POST['lugarEvento']);
    $fechaInicioEvento = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaInicioEvento'])));
    $fechaFinEvento = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaFinEvento'])));
    $descripcionEvento = sanearDatos($_POST['descripcionEvento']);
    $cuerpoEvento = $_POST['cuerpoEvento'];

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $imagenEvento = $_POST['archivo'];
    } else {
        $imagenEvento = NULL;
    }

    $idEvento = sanearDatos($_POST['idEvento']);

    $estadoAgregacion = realizarModificacionEvento($tituloEvento, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $descripcionEvento, $cuerpoEvento, $imagenEvento, $idEvento);

    if ($estadoAgregacion == 1) {
        $texto = "El evento se ha modificado correctamente.";

        if (isset($_POST['mostrar']) && ($_POST['mostrar'] == "ok")) {
            if ($localhost) {
                $href = PATH_CONTROLLER_COMUNICACIONES . "controladorAdmin.php?seccion=evento&nombreEventoUrl=" . strtolower(urlAmigable($tituloEvento)) . "&language=" . $language;
            } else {
                $href = PATH_HOME . $language . "/evento/" . strtolower(urlAmigable($tituloEvento));
            }
        }
    } else {
        $texto = "Hubo un error al modificar el evento. Vuelva a intentarlo en unos minutos.";
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
