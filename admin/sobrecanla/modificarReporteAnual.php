<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesReporteAnual.php';
require_once '../../php/validate/validateReporteAnual.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionReporteAnual();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloReporteAnual = $_POST['tituloReporteAnual'];
    $fechaManualReporteAnual = cambiarFecha(str_replace("/", "-",sanearDatos($_POST['fechaManualReporteAnual'])));
    $idReporteAnual = sanearDatos($_POST['idReporteAnual']);

    $pdfImage = '';
    if (isset($_POST['archivo'])) {
        $filename = $_POST['archivo'];
        $estadoAgregacion = realizarModificacionReporteAnual($tituloReporteAnual, $fechaManualReporteAnual, $filename, $pdfImage, $idReporteAnual);
    } else {
        $estadoAgregacion = realizarModificacionReporteAnual($tituloReporteAnual, $fechaManualReporteAnual, null, $pdfImage, $idReporteAnual);
    }


    if ($estadoAgregacion) {
        $texto = "El reporte anual se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar el reporte anual. Vuelva a intentarlo en unos minutos.";
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
