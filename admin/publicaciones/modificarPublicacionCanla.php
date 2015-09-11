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

$infoValidate = validarModificacionPublicacionCanla();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $tituloPublicacionCanla = sanearDatos($_POST['tituloPublicacionCanla']);
    $filename = $_POST['archivo'];
    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }
    $idPublicacionCanla = sanearDatos($_POST['idPublicacionCanla']);

    $estadoAgregacion = realizarModificacionPublicacionCanla($tituloPublicacionCanla, $filename, $idArea, $idPublicacionCanla);

    $eliminacionEtiquetas = eliminarEtiquetas('publicacioncanla', $idPublicacionCanla);

    if (!$eliminacionEtiquetas) {
        $estadoAgregacion = false;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idPublicacionCanla, 'publicacioncanla');
    }

    if ($estadoAgregacion == 1) {
        $texto = "La publicación se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar la publicación. Vuelva a intentarlo en unos minutos.";
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
