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

$infoValidate = validarAltaDestacadoEvento();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $imagenSlide = sanearDatos($_POST['archivo']);
    $idEvento = sanearDatos($_POST['id']);

    $estadoAgregacion = destacarEvento($imagenSlide, $idEvento);

    if ($estadoAgregacion == 1) {
        $texto = "El evento se ha destacado correctamente.";
    } else {
        $texto = "Hubo un error al destacar el evento. Vuelva a intentarlo en unos minutos.";
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
