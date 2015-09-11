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

$infoValidate = validarAltaReporteAnual();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloReporteAnual = sanearDatos($_POST['tituloReporteAnual']);
    $fechaManualReporteAnual = cambiarFecha(str_replace("/", "-",sanearDatos($_POST['fechaManualReporteAnual'])));
    $filename = $_POST['archivo'];
    
    $pdfImage = '';
    
    $estadoAgregacion = realizarAgregacionReporteAnual($tituloReporteAnual, $fechaManualReporteAnual, $filename, $pdfImage);

    if ($estadoAgregacion == 1) {
        $texto = "El reporte anual se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar el reporte anual. Vuelva a intentarlo en unos minutos.";
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
