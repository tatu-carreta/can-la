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

// $template = $twig->loadTemplate("/header.twig");  EL HEADER ES PARA CADA CASO PARTICULAR, DEFINIR EN EL CASE

/* Pasaje del arreglo a la vista .twig */
//$template->display($header);
/* Configurando la carga de twig */
$loadTwig = $twig;
$pathVista = "../../html/";

if (isset($_GET['seccion']) && is_string($_GET['seccion'])) {
    $seccion = sanearDatos($_GET['seccion']);

    switch ($seccion) {
        case 'agregarOtraPublicacion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "publicaciones/agregarOtraPublicacion.twig";
            break;
        case 'agregarPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $index['areas'] = $areas;
            $index['lang'] = $language;
            $url = "publicaciones/agregarPublicacionCanla.twig";
            break;
        case 'modificarOtraPublicacion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesOtraPublicacion.php';
            require_once '../../php/validate/validateOtraPublicacion.php';

            $infoValidate = validarVistaModificarOtraPublicacion();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idOtraPublicacion = sanearDatos($_GET['idOtraPublicacion']);

                $datoOtraPublicacion = obtenerDatosOtraPublicacionPorId($idOtraPublicacion);

                $datoOtraPublicacion['tituloOtraPublicacion'] = addslashes(html_entity_decode($datoOtraPublicacion['tituloOtraPublicacion']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoOtraPublicacion' => $datoOtraPublicacion,
                    'lang' => $language
                );

                $url = "publicaciones/modificarOtraPublicacion.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesPublicacionCanla.php';
            require_once '../../php/validate/validatePublicacionCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            //$infoValidate = validarVistaModificarPublicacionCanla();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idPublicacionCanla = sanearDatos($_GET['idPublicacionCanla']);

                $datoPublicacionCanla = obtenerDatosPublicacionCanlaPorId($idPublicacionCanla);

                $datoPublicacionCanla['tituloPublicacionCanla'] = addslashes(html_entity_decode($datoPublicacionCanla['tituloPublicacionCanla']));
                $datoPublicacionCanla['area'] = obtenerAreaPorPublicacionCanlaPorId($idPublicacionCanla);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoPublicacionCanla' => $datoPublicacionCanla,
                    'lang' => $language,
                    'areas' => $areas,
                );

                $url = "publicaciones/modificarPublicacionCanla.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'publicaciones':
            require_once '../../php/funciones/funcionesPublicacionCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);
            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
                $perfil = $_SESSION['user_type'];
            } else {
                $perfil = -1;
            }

            $publicaciones = obtenerPublicaciones();

            $url = "publicaciones/vistaPublicaciones.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'publicaciones' => $publicaciones,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'otrasPublicaciones':
            require_once '../../php/funciones/funcionesOtraPublicacion.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);
            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
                $perfil = $_SESSION['user_type'];
            } else {
                $perfil = -1;
            }

            $otrasPublicaciones = obtenerOtrasPublicaciones();

            $url = "publicaciones/vistaOtraPublicacion.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'otrasPublicaciones' => $otrasPublicaciones,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        default :

            require_once '../../php/security/securityControl.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $url = "paginaError.twig";
            $mostrarFooter = true;
            break;
    }
} else {
    require_once '../../php/security/securityControl.php';
    require_once '../../php/funciones/funcionesArea.php';

    $areas = obtenerAreas();

    $header['areas'] = $areas;

    $template = $twig->loadTemplate("/header.twig");
    /* Pasaje del arreglo a la vista .twig */
    $template->display($header);

    $url = "paginaError.twig";
    $mostrarFooter = true;
}

/* Carga del archivo de la vista .twig */
if (file_exists($pathVista . $url)) {
    $template = $loadTwig->loadTemplate("/" . $url);
} else {
    require_once '../../php/security/securityControl.php';
    require_once '../../php/funciones/funcionesArea.php';

    $areas = obtenerAreas();

    $header['areas'] = $areas;

    $template = $twig->loadTemplate("/header.twig");
    /* Pasaje del arreglo a la vista .twig */
    $template->display($header);

    $template = $loadTwig->loadTemplate("/paginaError.twig");
    $mostrarFooter = true;
}

/* Pasaje del arreglo a la vista .twig */
$template->display($index);

if ($mostrarFooter) {
    require_once '../../php/funciones/funcionesArea.php';

    $areas = obtenerAreas();

    $footer['areas'] = $areas;
    /* Carga del archivo de la vista .twig */
    $template = $twig->loadTemplate("/footer.twig");

    /* Pasaje del arreglo a la vista .twig */
    $template->display($footer);
}
?>
