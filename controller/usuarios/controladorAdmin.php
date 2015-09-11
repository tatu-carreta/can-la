<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';
/* Incluir este configPhpTwig cuando se quiera utilizar Twig
 * importante para los paths absolutos y configuracion
 * del Template
 */
require_once '../../php/configPhpTwig.php';


// $template = $twig->loadTemplate("/header.twig");  EL HEADER ES PARA CADA CASO PARTICULAR, DEFINIR EN EL CASE

/* Pasaje del arreglo a la vista .twig */
//$template->display($header);
/* Configurando la carga de twig */
$loadTwig = $twig;
$pathVista = "../../html/";

if (isset($_GET['seccion']) && is_string($_GET['seccion'])) {
    $seccion = sanearDatos($_GET['seccion']);

    switch ($seccion) {
        case 'login':
            /* Carga del archivo de la vista .twig */
            $template = $twig->loadTemplate("/head.twig");

            /* Pasaje del arreglo a la vista .twig */
            $template->display($head);

            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            if (permisoNoLogueado()) {
                $index['lang'] = $language;
                $url = "/login.twig";
            } else {
                $index = array(
                    'texto' => "Usted ya está logueado, no puede acceder a esta sección."
                );
                $url = "paginaError.twig";
            }

            break;
        case 'idioma':
            if ($_SESSION['lang'] == "es") {
                $_SESSION['lang'] = "en";
            } else {
                $_SESSION['lang'] = "es";
            }

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();

            break;
        case 'logout':
            require_once '../../admin/usuarios/cerrarSesion.php';

            break;
        default :

            /* Carga del archivo de la vista .twig */
            $template = $twig->loadTemplate("/head.twig");

            /* Pasaje del arreglo a la vista .twig */
            $template->display($head);

            require_once '../../php/security/securityControl.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $url = "paginaError.twig";
            break;
    }
} else {
    /* Carga del archivo de la vista .twig */
    $template = $twig->loadTemplate("/head.twig");

    /* Pasaje del arreglo a la vista .twig */
    $template->display($head);

    require_once '../../php/security/securityControl.php';
    require_once '../../php/funciones/funcionesArea.php';

    $areas = obtenerAreas();

    $header['areas'] = $areas;

    $template = $twig->loadTemplate("/header.twig");
    /* Pasaje del arreglo a la vista .twig */
    $template->display($header);

    $url = "paginaError.twig";
}

/* Carga del archivo de la vista .twig */
if (file_exists($pathVista . $url)) {
    $template = $loadTwig->loadTemplate("/" . $url);
} else {
    /* Carga del archivo de la vista .twig */
    $template = $twig->loadTemplate("/head.twig");

    /* Pasaje del arreglo a la vista .twig */
    $template->display($head);

    require_once '../../php/security/securityControl.php';
    require_once '../../php/funciones/funcionesArea.php';

    $areas = obtenerAreas();

    $header['areas'] = $areas;

    $template = $twig->loadTemplate("/header.twig");
    /* Pasaje del arreglo a la vista .twig */
    $template->display($header);

    $template = $loadTwig->loadTemplate("/paginaError.twig");
}

/* Pasaje del arreglo a la vista .twig */
$template->display($index);

require_once '../../php/funciones/funcionesArea.php';

$areas = obtenerAreas();

$footer['areas'] = $areas;
/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/footer.twig");

/* Pasaje del arreglo a la vista .twig */
$template->display($footer);
?>
