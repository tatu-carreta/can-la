<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNoticia.php';
require_once '../../php/validate/validateNoticia.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaNoticia();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idNoticia = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaNoticia($idNoticia);

    if ($estadoEliminacion) {
        $texto = "La noticia se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la noticia. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $estadoEliminacion = $infoValidate['estado'];
    $texto = $infoValidate['texto'];
}
$data = array(
    'estado' => $estadoEliminacion,
    'texto' => $texto
);

echo json_encode($data);
?>
