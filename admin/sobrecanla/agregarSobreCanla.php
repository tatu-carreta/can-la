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

$infoValidate = validarAltaSobreCanla();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {

    $cuerpoSobreCanla = $_POST['cuerpoSobreCanla'];
    $tipoSobreCanla = sanearDatos($_POST['tipoSobreCanla']);

    if ((!is_string($cuerpoSobreCanla) && !is_numeric($cuerpoSobreCanla)))
        continue;

    if (get_magic_quotes_gpc())
//$texto = htmlspecialchars( stripslashes((string)$texto) );
        $cuerpoSobreCanla = stripslashes((string) $cuerpoSobreCanla);
    else
//$texto = htmlspecialchars( (string)$texto );
        $cuerpoSobreCanla = (string) $cuerpoSobreCanla;

    $estadoAgregacion = realizarAgregacionSobreCanla($cuerpoSobreCanla, $tipoSobreCanla);

    if ($estadoAgregacion == 1) {
        $texto = "El texto se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar el texto. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto
);

switch ($tipoSobreCanla) {
    case 'O':
        $seccion = "objetivos";
        break;
    case 'R':
        $seccion = "reglamento";
        break;
    case 'H':
        $seccion = "historia";
        break;
    case 'C':
        $seccion = "canInternacional";
        break;
}

if ($localhost) {
    header("Location:" . PATH_CONTROLLER_SOBRECANLA . "controladorAdmin.php?seccion=" . $seccion . "&language=" . $language);
} else {
    header("Location:" . PATH_HOME . $language . "/sobrecanla/" . $seccion);
}



//echo json_encode($data);
?>
