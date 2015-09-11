<?php

if (!isset($localhost)) {
    require_once '../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/validate/validateSecretariado.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

//$infoValidate = validarAltaSecretariado();
$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $secretariadoOrdenado = $_POST['orden'];
    //var_dump($secretariadoOrdenado);
    $i = 0;

    foreach ($secretariadoOrdenado as $sec => $ord) {
        $id = $ord['idSecretariado'];
        $orden = $i;
        $estadoAgregacion = actualizarOrden($orden, $id, 'secretariado');
        $i ++;
    }

    if ($estadoAgregacion) {
        $texto = "Se ha ordenado correctamente.";
    } else {
        $texto = "Hubo un error al ordenar. Vuelva a intentarlo en unos minutos.";
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
