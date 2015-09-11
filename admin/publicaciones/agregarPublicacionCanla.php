<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesPublicacionCanla.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validatePublicacionCanla.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarAltaPublicacionCanla();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloPublicacionCanla = $_POST['tituloPublicacionCanla'];
    $filename = $_POST['archivo'];
    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }

    $idPublicacionCanla = realizarAgregacionPublicacionCanla($tituloPublicacionCanla, $filename, $idArea);

    if ($idPublicacionCanla > 0) {
        $estadoAgregacion = 1;
    } else {
        $estadoAgregacion = -1;
    }

    if (isset($_POST['tags'])) {

        foreach ($_POST['tags'] as $tag) {
            $urlAmigable = urlAmigable($tag['text']);
            $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idPublicacionCanla, 'publicacioncanla');
        }
    }

    if ($estadoAgregacion == 1) {
        $texto = "La publicación se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la publicación. Vuelva a intentarlo en unos minutos.";
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
