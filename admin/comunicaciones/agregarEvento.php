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

$infoValidate = validarAltaEvento();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $tituloEvento = sanearDatos($_POST['tituloEvento']);
    $lugarEvento = sanearDatos($_POST['lugarEvento']);
    $fechaInicioEvento = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaInicioEvento'])));
    $fechaFinEvento = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaFinEvento'])));
    $descripcionEvento = $_POST['descripcionEvento'];
    $cuerpoEvento = $_POST['cuerpoEvento'];
    $imagenEvento = $_POST['archivo'];

    $estadoAgregacion = realizarAgregacionEvento($tituloEvento, $lugarEvento, $fechaInicioEvento, $fechaFinEvento, $descripcionEvento, $cuerpoEvento, $imagenEvento);

    if ($estadoAgregacion) {
        $texto = "El evento se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar el evento. Vuelva a intentarlo en unos minutos.";
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
