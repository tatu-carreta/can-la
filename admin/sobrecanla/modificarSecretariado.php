<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesSecretariado.php';
require_once '../../php/validate/validateSecretariado.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionSecretariado();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $nombre = sanearDatos($_POST['nombre']);
    $cargo = sanearDatos($_POST['cargo']);
    $texto = sanearDatos($_POST['texto']);
    $id = $_POST['id'];

    if (isset($_POST['archivo'])) {
        $filename = $_POST['archivo'];
        $estadoAgregacion = realizarModificacion($nombre, $cargo, $texto, $id, $filename);
    } else {
        $estadoAgregacion = realizarModificacion($nombre, $cargo, $texto, $id, null);
    }


    if ($estadoAgregacion) {
        $texto = "La persona se ha modificado correctamente.";
    } else {
        $texto = "Hubo un error al modificar la persona. Vuelva a intentarlo en unos minutos.";
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
