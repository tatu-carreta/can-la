<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesBoletin.php';
require_once '../../php/validate/validateBoletin.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionBoletin();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $tituloBoletin = sanearDatos($_POST['tituloBoletin']);
    $idBoletin = sanearDatos($_POST['idBoletin']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $filename = $_POST['archivo'];
    } else {
        $filename = NULL;
    }
    $estadoAgregacion = realizarModificacionBoletin($tituloBoletin, $filename, $idBoletin);

    if ($estadoAgregacion == 1) {
        $texto = "El boletín se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar el boletín. Vuelva a intentarlo en unos minutos.";
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
