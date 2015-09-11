<?php

if (!isset($localhost)) {
    require_once '../../php/configWebData.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesMiembro.php';
require_once '../../php/validate/validateMiembro.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionMiembro();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $nombreMiembro = $_POST['nombreMiembro'];
    if (isset($_POST['urlMiembro']) && ($_POST['urlMiembro'])) {
        $urlMiembro = $_POST['urlMiembro'];
    } else {
        $urlMiembro = NULL;
    }
    $representanteMiembro = $_POST['representanteMiembro'];
    if (isset($_POST['direccionMiembro']) && ($_POST['direccionMiembro'])) {
        $direccionMiembro = $_POST['direccionMiembro'];
    } else {
        $direccionMiembro = NULL;
    }
    $latitud = 0;
    $longitud = 0;
    $descripcionMiembro = trim($_POST['descripcionMiembro']);
    $idPais = sanearDatos($_POST['idPais']);

    $idMiembro = sanearDatos($_POST['idMiembro']);

    if (isset($_POST['archivo'])) {
        $filename = $_POST['archivo'];
        $estadoAgregacion = realizarModificacionMiembro($nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $latitud, $longitud, $descripcionMiembro, $filename, $idMiembro, $idPais);
    } else {
        $estadoAgregacion = realizarModificacionMiembro($nombreMiembro, $urlMiembro, $representanteMiembro, $direccionMiembro, $latitud, $longitud, $descripcionMiembro, null, $idMiembro, $idPais);
    }

    if ($estadoAgregacion) {
        $texto = "El miembro se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar el miembro. Vuelva a intentarlo en unos minutos.";
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
