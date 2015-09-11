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

$infoValidate = validarAltaSecretariado();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $nombreSecretariado = sanearDatos($_POST['nombre']);
    $cargoSecretariado = sanearDatos($_POST['cargo']);
    $textoSecretariado = trim($_POST['texto']);
    $filename = $_POST['archivo'];
    $tipoSecretariado = "S";


    $estadoAgregacion = realizarAgregacionSecretariado($nombreSecretariado, $cargoSecretariado, $textoSecretariado, $filename, $tipoSecretariado);

    if ($estadoAgregacion) {
        $texto = "La persona se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la persona. Vuelva a intentarlo en unos minutos.";
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
