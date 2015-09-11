<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesPublicacionCanla.php';
require_once '../../php/validate/validatePublicacionCanla.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaPublicacionCanla();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idPublicacionCanla = sanearDatos($_POST['id']);

    $estadoEliminacion = realizarBajaPublicacionCanla($idPublicacionCanla);

    if ($estadoEliminacion) {
        $texto = "La publicación se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja la publicación. Vuelva a intentarlo en unos minutos.";
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
