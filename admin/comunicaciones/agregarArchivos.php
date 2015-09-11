<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';



if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

//$infoValidate = validarAltaNoticia();
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $galeria = $_POST['archivo'];
    $carpeta = sanearDatos($_POST['carpeta']);
    $id = sanearDatos($_POST['id']);

    foreach ($galeria as $key => $archivo) {
        $estadoAgregacion = agregarArchivosGaleria($archivo, $carpeta, $id);
    }


    if ($estadoAgregacion == 1) {
        $texto = "Los archivos se han dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar los archivos. Vuelva a intentarlo en unos minutos.";
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
