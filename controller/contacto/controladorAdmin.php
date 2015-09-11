<?php

require_once '../../php/configWebData.php';
if (file_exists("../../languages/" . $language . "/texts.php")) {
    require_once("../../languages/" . $language . "/texts.php");
}
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';
/* Incluir este configPhpTwig cuando se quiera utilizar Twig
 * importante para los paths absolutos y configuracion
 * del Template
 */
require_once '../../php/configPhpTwig.php';
/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/head.twig");

/* Pasaje del arreglo a la vista .twig */
$template->display($head);

$template = $twig->loadTemplate("/header.twig");  //EL HEADER ES PARA CADA CASO PARTICULAR, DEFINIR EN EL CASE

require_once '../../php/funciones/funcionesArea.php';

$areas = obtenerAreas();

$header['areas'] = $areas;

/* Pasaje del arreglo a la vista .twig */
$template->display($header);
/* Configurando la carga de twig */
$loadTwig = $twig;
$pathVista = "../../html/";


if (isset($_GET['seccion']) && is_string($_GET['seccion'])) {
    $seccion = sanearDatos($_GET['seccion']);
    switch ($seccion) {
        case 'contacto':

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;
            $url = "/contacto.twig";
            break;
        case 'nuevos-miembros':

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;
            //$url = "/nuevosMiembros.twig";
            $url = "/contacto.twig";
            break;
        case 'donaciones':

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;
            //$url = "/donaciones.twig";
            $url = "/contacto.twig";
            break;
        default :

            require_once '../../php/security/securityControl.php';

            $url = "paginaError.twig";
            break;
    }
} else {
    require_once '../../php/security/securityControl.php';

    $url = "paginaError.twig";
}

/* Carga del archivo de la vista .twig */
if (file_exists($pathVista . $url)) {
    $template = $loadTwig->loadTemplate("/" . $url);
} else {
    require_once '../../php/security/securityControl.php';
    $template = $loadTwig->loadTemplate("/paginaError.twig");
}

/* Pasaje del arreglo a la vista .twig */
$template->display($index);

/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/footer.twig");

$footer['areas'] = $areas;
/* Pasaje del arreglo a la vista .twig */
$template->display($footer);
?>

