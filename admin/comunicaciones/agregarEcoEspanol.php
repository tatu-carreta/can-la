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

$infoValidate = validarAltaEco();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloEco = sanearDatos($_POST['tituloEco']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $filename = $_POST['archivo'];
    } else {
        $filename = NULL;
    }

    $estadoAgregacion = realizarAgregacionEco($tituloEco, $filename);

    if ($estadoAgregacion == 1) {
        $texto = "El eco en español se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar el eco en español. Vuelva a intentarlo en unos minutos.";
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
