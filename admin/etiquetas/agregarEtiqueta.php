<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validateEtiqueta.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

//$infoValidate = validarAltaEtiqueta();
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $ok = true;
    $nombreEtiqueta = sanearDatos($_POST['nombreEtiqueta']);
    $id = sanearDatos($_POST['id']);
    $carpeta = sanearDatos($_POST['carpeta']);

    switch ($carpeta) {
        case 'notaprensa':
            break;
        case 'noticia':
            break;
        case 'publicacioncanla':
            break;
        case 'posicion':
            break;
        default :
            $ok = false;
            break;
    }

    if ($ok) {
        $estadoAgregacion = realizarAgregacionEtiqueta($nombreEtiqueta, $id, $carpeta);

        if ($estadoAgregacion == 1) {
            $texto = "El boletín se ha dado de alta correctamente.";
        } else {
            $texto = "Hubo un error al agregar el boletín. Vuelva a intentarlo en unos minutos.";
        }
    } else {
        $texto = "Hubo un error en la recolección de datos a ingresar. Vuelva a intentarlo en unos minutos";
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
