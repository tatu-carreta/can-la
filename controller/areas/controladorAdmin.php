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
        case 'mapa':
            require_once '../../php/funciones/funcionesArea.php';
            require_once '../../php/funciones/funcionesMiembro.php';

            $areas = obtenerAreas();
            $miembros = obtenerMiembros();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);
            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
                $perfil = $_SESSION['user_type'];
            } else {
                $perfil = -1;
            }

            foreach ($miembros as $m => $datoMiembro) {
                $miembros[$m]['description'] = '<div id="content">' .
                        '<div id="siteNotice">' .
                        '<img style="width:100px;height:50px;" src="' . PATH_IMAGES_AREAS . $datoMiembro['logoMiembro'] . '">' .
                        '</div>' .
                        '<h1 id="firstHeading" class="firstHeading">' . $datoMiembro['nombreMiembro'] . '</h1>' .
                        '<div id="bodyContent">' .
                        '<p><b>' . $datoMiembro['nombreMiembro'] . '</b><br>' .
                        'Representante: ' . $datoMiembro['representanteMiembro'] . '.<br>' .
                        ' ' . $datoMiembro['direccionMiembro'] . ' <br>' .
                        '<p>' . $datoMiembro['descripcionMiembro'] .
                        '</p>' .
                        '</div>' .
                        '</div>';
            }


            $url = "/mapa.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'areas' => $areas,
                'lang' => $language,
                'miembros' => json_encode($miembros)
            );
            $mostrarFooter = true;
            break;
        case 'agregarArea':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "areas/agregarArea.twig";
            break;
        case 'modificarArea':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesArea.php';
            require_once '../../php/validate/validateArea.php';

            $infoValidate = validarVistaModificarArea();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idArea = sanearDatos($_GET['idArea']);

                $datoArea = obtenerDatosAreaPorId($idArea);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoArea' => $datoArea,
                    'lang' => $language
                );

                $url = "areas/modificarArea.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'areas':
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



            $url = "areas/vistaArea.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'areas' => $areas,
                'lang' => $language,
                'texts' => $textsTwig,
            );
            $mostrarFooter = true;
            break;
        case 'area':
            require_once '../../php/funciones/funcionesArea.php';
            require_once '../../php/funciones/funcionesNoticia.php';
            require_once '../../php/funciones/funcionesNotaPrensa.php';
            require_once '../../php/funciones/funcionesPosicion.php';
            require_once '../../php/funciones/funcionesPublicacionCanla.php';

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

            if (isset($_GET['area']) && ($_GET['area'])) {

                $nombreAreaUrl = sanearDatos($_GET['area']);

                $datosArea = obtenerAreaPorNombreUrl($nombreAreaUrl);

                /*
                  $noticias = obtenerNoticiasPorIdArea($datosArea['idArea']);
                  $notas = obtenerNotasPorIdArea($datosArea['idArea']);
                  $posiciones = obtenerPosicionesPorIdArea($datosArea['idArea']);
                  $publicaciones = obtenerPublicacionesPorIdArea($datosArea['idArea']);
                 * 
                 */
                $noticias = obtenerNoticiasPorIdAreaLimitado($datosArea['idArea'], 0, 1);
                $notas = obtenerNotasPrensaPorIdAreaLimitado($datosArea['idArea'], 0, 1);
                $posiciones = obtenerPosicionesPorIdAreaLimitado($datosArea['idArea'], 0, 1);
                $publicaciones = obtenerPublicacionesPorIdAreaLimitado($datosArea['idArea'], 0, 1);


                if (count($noticias) > 0) {
                    foreach ($noticias as $n => $datoNoticia) {
                        $noticias[$n]['tituloNoticia'] = html_entity_decode($noticias[$n]['tituloNoticia']);
                        $noticias[$n]['descripcionNoticia'] = html_entity_decode($noticias[$n]['descripcionNoticia']);
                        $noticias[$n]['cuerpoNoticia'] = html_entity_decode($noticias[$n]['cuerpoNoticia']);
                        //$noticias[$n]['fechaNoticia'] = str_replace("-", "/", cambiarFecha($noticias[$n]['fechaNoticia']));
                        $noticias[$n]['etiquetas'] = obtenerEtiquetasPorIdNoticia($datoNoticia['idNoticia']);
                    }
                }
                if (count($notas) > 0) {
                    foreach ($notas as $np => $datoNotaPrensa) {
                        $notas[$np]['tituloNotaPrensa'] = html_entity_decode($notas[$np]['tituloNotaPrensa']);
                        $notas[$np]['descripcionNotaPrensa'] = html_entity_decode($notas[$np]['descripcionNotaPrensa']);
                        $notas[$np]['cuerpoNotaPrensa'] = html_entity_decode($notas[$np]['cuerpoNotaPrensa']);
                        //$notas[$np]['fechaNotaPrensa'] = str_replace("-", "/", cambiarFecha($notas[$np]['fechaNotaPrensa']));
                        $notas[$np]['etiquetas'] = obtenerEtiquetasPorIdNotaPrensa($datoNotaPrensa['idNotaPrensa']);
                    }
                }
                if (count($posiciones) > 0) {
                    foreach ($posiciones as $p => $datoPosicion) {
                        $posiciones[$p]['tituloPosicion'] = html_entity_decode($posiciones[$p]['tituloPosicion']);
                        $posiciones[$p]['etiquetas'] = obtenerEtiquetasPorIdPosicion($datoPosicion['idPosicion']);
                    }
                }
                if (count($publicaciones) > 0) {
                    foreach ($publicaciones as $pu => $datoPublicacionCanla) {
                        $publicaciones[$pu]['tituloPublicacionCanla'] = html_entity_decode($publicaciones[$pu]['tituloPublicacionCanla']);
                        $publicaciones[$pu]['etiquetas'] = obtenerEtiquetasPorIdPublicacionCanla($datoPublicacionCanla['idPublicacionCanla']);
                    }
                }

                /* DATOS VER MÁS EN AREA */
                $noticiasVerMas = obtenerNoticiasPorIdAreaLimitado(sanearDatos($datosArea['idArea']), 1, 13);
                $notasVerMas = obtenerNotasPrensaPorIdAreaLimitado(sanearDatos($datosArea['idArea']), 1, 13);
                $posicionesVerMas = obtenerPosicionesPorIdAreaLimitado(sanearDatos($datosArea['idArea']), 1, 13);
                $publicacionesVerMas = obtenerPublicacionesPorIdAreaLimitado(sanearDatos($datosArea['idArea']), 1, 13);

                $url = "areas/mostrarArea.twig";

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'perfil' => $perfil,
                    'datosArea' => $datosArea,
                    'noticias' => $noticias,
                    'notas' => $notas,
                    'posiciones' => $posiciones,
                    'publicaciones' => $publicaciones,
                    'cantNoticias' => count($noticias),
                    'cantNotas' => count($notas),
                    'cantPosiciones' => count($posiciones),
                    'cantPublicaciones' => count($publicaciones),
                    'cantNoticiasVerMas' => count($noticiasVerMas),
                    'cantNotasVerMas' => count($notasVerMas),
                    'cantPosicionesVerMas' => count($posicionesVerMas),
                    'cantPublicacionesVerMas' => count($publicacionesVerMas),
                    'lang' => $language,
                    'texts' => $textsTwig,
                );
            } else {
                $url = "paginaError.twig";
            }
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
