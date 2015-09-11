<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEco.php';
require_once '../../php/validate/validateEco.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionEco();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $tituloEco = sanearDatos($_POST['tituloEco']);
    $idEco = sanearDatos($_POST['idEco']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $filename = $_POST['archivo'];
    } else {
        $filename = NULL;
    }
    $estadoAgregacion = realizarModificacionEco($tituloEco, $filename, $idEco);

    if ($estadoAgregacion == 1) {
        $texto = "El eco en español se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar el eco en español. Vuelva a intentarlo en unos minutos.";
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
