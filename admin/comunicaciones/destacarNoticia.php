<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNoticia.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validateNoticia.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarAltaDestacadoNoticia();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $imagenNoticia = sanearDatos($_POST['archivo']);
    $idNoticia = sanearDatos($_POST['id']);

    $estadoAgregacion = destacarNoticia($imagenNoticia, $idNoticia);

    if ($estadoAgregacion == 1) {
        $texto = "La noticia se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la noticia. Vuelva a intentarlo en unos minutos.";
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
