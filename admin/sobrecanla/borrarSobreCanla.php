<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesSobreCanla.php';
require_once '../../php/validate/validateSobreCanla.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarBajaSobreCanla();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $idSobreCanla = sanearDatos($_POST['idSobreCanla']);

    $estadoEliminacion = realizarBajaSobreCanla($idSobreCanla);

    if ($estadoEliminacion) {
        $texto = "El texto se ha dado de baja correctamente.";
    } else {
        $texto = "Hubo un error al dar de baja el texto. Vuelva a intentarlo en unos minutos.";
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
