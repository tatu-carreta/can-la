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
        case 'mostrarEtiqueta':
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

            if (isset($_GET['nombreEtiqueta']) && ($_GET['nombreEtiqueta'])) {

                $nombreEtiqueta = sanearDatos($_GET['nombreEtiqueta']);

                $noticias = obtenerNoticiasPorEtiqueta($nombreEtiqueta);
                $notas = obtenerNotasPrensaPorEtiqueta($nombreEtiqueta);
                $posiciones = obtenerPosicionesPorEtiqueta($nombreEtiqueta);
                $publicaciones = obtenerPublicacionesPorEtiqueta($nombreEtiqueta);

                if (count($noticias) > 0) {
                    foreach ($noticias as $n => $datoNoticia) {
                        $noticias[$n]['tituloNoticia'] = html_entity_decode($noticias[$n]['tituloNoticia']);
                        $noticias[$n]['fuenteNoticia'] = html_entity_decode($noticias[$n]['fuenteNoticia']);
                        $noticias[$n]['descripcionNoticia'] = html_entity_decode($noticias[$n]['descripcionNoticia']);
                        $noticias[$n]['cuerpoNoticia'] = html_entity_decode($noticias[$n]['cuerpoNoticia']);
                        $noticias[$n]['etiquetas'] = obtenerEtiquetasPorIdNoticia($datoNoticia['idNoticia']);
                    }
                }
                if (count($notas) > 0) {
                    foreach ($notas as $np => $datoNotaPrensa) {
                        $notas[$np]['tituloNotaPrensa'] = html_entity_decode($notas[$np]['tituloNotaPrensa']);
                        $notas[$np]['descripcionNotaPrensa'] = html_entity_decode($notas[$np]['descripcionNotaPrensa']);
                        $notas[$np]['cuerpoNotaPrensa'] = html_entity_decode($notas[$np]['cuerpoNotaPrensa']);
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
                /*
                  var_dump($noticias);
                  var_dump($notas);
                  var_dump($posiciones);
                  var_dump($publicaciones);
                 */
                $url = "/mostrarEtiqueta.twig";

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'noticias' => $noticias,
                    'notas' => $notas,
                    'posiciones' => $posiciones,
                    'publicaciones' => $publicaciones,
                    'cantNoticias' => count($noticias),
                    'cantNotas' => count($notas),
                    'cantPosiciones' => count($posiciones),
                    'cantPublicaciones' => count($publicaciones),
                    'lang' => $language,
                    'texts' => $textsTwig,
                    'nombreEtiqueta' => $nombreEtiqueta
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
