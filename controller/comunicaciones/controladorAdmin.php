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
        case 'agregarBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarBoletin.twig";
            break;
        case 'agregarEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarEco.twig";
            break;
        case 'agregarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarEvento.twig";
            break;
        case 'agregarGaleriaNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            $id = $_GET['id'];
            $index['lang'] = $language;
            $index['id'] = $id;
            $index['paths'] = $paths;
            $url = "comunicaciones/agregarGaleriaNoticia.twig";
            break;
        case 'agregarGaleriaNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            $id = $_GET['id'];
            $index['lang'] = $language;
            $index['id'] = $id;
            $index['paths'] = $paths;
            $url = "comunicaciones/agregarGaleriaNotaPrensa.twig";
            break;
        case 'agregarGaleriaEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            $id = $_GET['id'];
            $index['lang'] = $language;
            $index['id'] = $id;
            $index['paths'] = $paths;
            $url = "comunicaciones/agregarGaleriaEvento.twig";
            break;
        case 'agregarArchivosEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            $id = $_GET['id'];
            $index['lang'] = $language;
            $index['id'] = $id;
            $index['paths'] = $paths;
            $url = "comunicaciones/agregarArchivosEvento.twig";
            break;
        case 'agregarVideo':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarVideoNoticia.twig";
            $id = $_GET['id'];
            $index = array(
                'paths' => $paths,
                'id' => $id
            );
            break;
        case 'agregarVideoNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarVideoNotaPrensa.twig";
            $id = $_GET['id'];
            $index = array(
                'paths' => $paths,
                'id' => $id
            );
            break;
        case 'agregarVideoEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;
            $url = "comunicaciones/agregarVideoEvento.twig";
            $id = $_GET['id'];
            $index = array(
                'paths' => $paths,
                'id' => $id
            );
            break;
        case 'agregarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;

            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $index['areas'] = $areas;

            $url = "comunicaciones/agregarNotaPrensa.twig";
            break;
        case 'agregarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;

            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $index['areas'] = $areas;

            $url = "comunicaciones/agregarNoticia.twig";
            break;
        case 'destacarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $idNoticia = sanearDatos($_GET['idNoticia']);
            $index['lang'] = $language;
            $index['id'] = $idNoticia;
            $url = "comunicaciones/destacarNoticia.twig";
            break;
        case 'destacarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $idEvento = sanearDatos($_GET['idEvento']);
            $index['lang'] = $language;
            $index['id'] = $idEvento;
            $url = "comunicaciones/destacarEvento.twig";
            break;
        case 'destacarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $idEvento = sanearDatos($_GET['idNotaPrensa']);
            $index['lang'] = $language;
            $index['id'] = $idEvento;
            $url = "comunicaciones/destacarNotaPrensa.twig";
            break;
        case 'agregarPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            $index['lang'] = $language;

            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $index['areas'] = $areas;

            $url = "comunicaciones/agregarPosicion.twig";
            break;
        case 'modificarBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesBoletin.php';
            require_once '../../php/validate/validateBoletin.php';

            $infoValidate = validarVistaModificarBoletin();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idBoletin = sanearDatos($_GET['idBoletin']);

                $datoBoletin = obtenerDatosBoletinPorId($idBoletin);

                $datoBoletin['tituloBoletin'] = addslashes(html_entity_decode($datoBoletin['tituloBoletin']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoBoletin' => $datoBoletin,
                    'lang' => $language
                );

                $url = "comunicaciones/modificarBoletin.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesEco.php';
            require_once '../../php/validate/validateEco.php';

            $infoValidate = validarVistaModificarEco();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idEco = sanearDatos($_GET['idEco']);

                $datoEco = obtenerDatosEcoPorId($idEco);

                $datoEco['tituloEco'] = addslashes(html_entity_decode($datoEco['tituloEco']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoEco' => $datoEco,
                    'lang' => $language
                );

                $url = "comunicaciones/modificarEco.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesEvento.php';
            require_once '../../php/validate/validateEvento.php';

            //$infoValidate = validarVistaModificarNotaPrensa();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idEvento = sanearDatos($_GET['idEvento']);

                $datoEvento = obtenerDatosEventoPorId($idEvento);

                require_once '../../php/funciones/funcionesArea.php';

                $areas = obtenerAreas();

                $datoEvento['tituloEvento'] = addslashes(html_entity_decode($datoEvento['tituloEvento']));
                $datoEvento['descripcionEvento'] = addslashes(html_entity_decode($datoEvento['descripcionEvento']));
                $datoEvento['lugarEvento'] = addslashes(html_entity_decode($datoEvento['lugarEvento']));
                //$datoEvento['cuerpoEvento'] = html_entity_decode($datoEvento['cuerpoEvento']);
                $datoEvento['fechaInicioEvento'] = str_replace("-", "/", cambiarFecha($datoEvento['fechaInicioEvento']));
                $datoEvento['fechaFinEvento'] = str_replace("-", "/", cambiarFecha($datoEvento['fechaFinEvento']));

                if (isset($_GET['mostrar']) && ($_GET['mostrar'] != "")) {
                    $mostrar = sanearDatos($_GET['mostrar']);
                } else {
                    $mostrar = "";
                }

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoEvento' => $datoEvento,
                    'areas' => $areas,
                    'lang' => $language,
                    'id' => $datoEvento['idEvento'],
                    'mostrar' => $mostrar
                );

                $url = "comunicaciones/modificarEvento.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesNotaPrensa.php';
            require_once '../../php/validate/validateNotaPrensa.php';

            //$infoValidate = validarVistaModificarNotaPrensa();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idNotaPrensa = sanearDatos($_GET['idNotaPrensa']);

                $datoNota = obtenerDatosNotaPrensaPorId($idNotaPrensa);

                require_once '../../php/funciones/funcionesArea.php';

                $areas = obtenerAreas();


                $datoNota['tituloNotaPrensa'] = addslashes(html_entity_decode($datoNota['tituloNotaPrensa']));
                $datoNota['descripcionNotaPrensa'] = addslashes(html_entity_decode($datoNota['descripcionNotaPrensa']));
                //$datoNota['cuerpoNotaPrensa'] = html_entity_decode($datoNota['cuerpoNotaPrensa']);
                $datoNota['fechaNotaPrensa'] = str_replace("-", "/", cambiarFecha($datoNota['fechaNotaPrensa']));
                $datoNota['area'] = obtenerAreaPorNotaPrensaPorId($idNotaPrensa);

                if (isset($_GET['mostrar']) && ($_GET['mostrar'] != "")) {
                    $mostrar = sanearDatos($_GET['mostrar']);
                } else {
                    $mostrar = "";
                }

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoNotaPrensa' => $datoNota,
                    'areas' => $areas,
                    'lang' => $language,
                    'id' => $datoNota['idNotaPrensa'],
                    'carpeta' => "notaprensa",
                    'mostrar' => $mostrar
                );

                $url = "comunicaciones/modificarNotaPrensa.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesNoticia.php';
            require_once '../../php/validate/validateNoticia.php';

            //$infoValidate = validarVistaModificarNoticia();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idNoticia = sanearDatos($_GET['idNoticia']);

                $datoNoticia = obtenerDatosNoticiaPorId($idNoticia);

                require_once '../../php/funciones/funcionesArea.php';

                $datoNoticia['tituloNoticia'] = addslashes(html_entity_decode($datoNoticia['tituloNoticia']));
                $datoNoticia['fuenteNoticia'] = addslashes(html_entity_decode($datoNoticia['fuenteNoticia']));
                $datoNoticia['descripcionNoticia'] = addslashes(html_entity_decode($datoNoticia['descripcionNoticia']));
                //$datoNoticia['cuerpoNoticia'] = html_entity_decode($datoNoticia['cuerpoNoticia']);
                $datoNoticia['fechaNoticia'] = str_replace("-", "/", cambiarFecha($datoNoticia['fechaNoticia']));

                $datoNoticia['area'] = obtenerAreaPorNoticiaPorId($idNoticia);

                $areas = obtenerAreas();

                if (isset($_GET['mostrar']) && ($_GET['mostrar'] != "")) {
                    $mostrar = sanearDatos($_GET['mostrar']);
                } else {
                    $mostrar = "";
                }

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoNoticia' => $datoNoticia,
                    'areas' => $areas,
                    'lang' => $language,
                    'id' => $datoNoticia['idNoticia'],
                    'carpeta' => "noticia",
                    'mostrar' => $mostrar
                );

                $url = "comunicaciones/modificarNoticia.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesPosicion.php';
            require_once '../../php/validate/validatePosicion.php';

            //$infoValidate = validarVistaModificarPosicion();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idPosicion = sanearDatos($_GET['idPosicion']);

                $datoPosicion = obtenerDatosPosicionPorId($idPosicion);

                require_once '../../php/funciones/funcionesArea.php';

                $areas = obtenerAreas();

                $datoPosicion['tituloPosicion'] = addslashes(html_entity_decode($datoPosicion['tituloPosicion']));
                $datoPosicion['area'] = obtenerAreaPorPosicionPorId($idPosicion);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoPosicion' => $datoPosicion,
                    'areas' => $areas,
                    'lang' => $language,
                    'id' => $datoPosicion['idPosicion'],
                    'carpeta' => "posicion"
                );

                $url = "comunicaciones/modificarPosicion.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'boletinCanla':
            require_once '../../php/funciones/funcionesBoletin.php';
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

            $boletines = obtenerBoletines();

            $url = "comunicaciones/vistaBoletin.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'boletines' => $boletines,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'ecoEspanol':
            require_once '../../php/funciones/funcionesEco.php';
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

            $ecos = obtenerEcos();

            $url = "comunicaciones/vistaEco.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'ecos' => $ecos,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'notas-de-prensa':
            require_once '../../php/funciones/funcionesNotaPrensa.php';
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

            $notas = obtenerNotasPrensa();

            $url = "comunicaciones/vistaNotaPrensa.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'notas' => $notas,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'agenda':
            require_once '../../php/funciones/funcionesEvento.php';
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

            $eventos = obtenerEventos();

            $url = "comunicaciones/vistaAgenda.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'eventos' => $eventos,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'noticias':
            require_once '../../php/funciones/funcionesNoticia.php';
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

            $noticiasDestacadas = obtenerNoticiasSlide();

            $noticias = obtenerNoticias();

            $url = "comunicaciones/vistaNoticia.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'noticias' => $noticias,
                'noticiasDestacadas' => $noticiasDestacadas,
                'lang' => $language,
                'section' => "comunicaciones",
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'posiciones':
            require_once '../../php/funciones/funcionesPosicion.php';
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

            $posiciones = obtenerPosiciones();

            $url = "comunicaciones/vistaPosiciones.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'posiciones' => $posiciones,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'notaPrensa':
            require_once '../../php/funciones/funcionesNotaPrensa.php';
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

            if (isset($_GET['notaPrensaUrl']) && ($_GET['notaPrensaUrl'])) {

                $notaPrensaUrl = sanearDatos($_GET['notaPrensaUrl']);

                $datosNota = obtenerNotaPrensaPorNombreUrl($notaPrensaUrl);

                if ($datosNota['idNotaPrensa']) {

                    $imagenesNotaPrensa = obtenerImagenesPorIdNotaPrensa($datosNota['idNotaPrensa']);
                    $videosNotaPrensa = obtenerVideosPorIdNotaPrensa($datosNota['idNotaPrensa']);

                    foreach ($videosNotaPrensa as $da => $key) {
                        $embed = explode("=", $videosNotaPrensa[$da]['nombreVideoNotaPrensa']);

                        $nombreVideoNotaPrensaEmbed = "//youtube.com/embed/" . $embed[1];

                        $videosNotaPrensa[$da]['nombreVideoNotaPrensaEmbed'] = $nombreVideoNotaPrensaEmbed;
                    }

                    $datosNota['tituloNotaPrensaRecorte'] = html_entity_decode(acortar($datosNota['tituloNotaPrensa'], 30));

                    $url = "comunicaciones/mostrarNotaPrensa.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'datosNota' => $datosNota,
                        'imagenes' => $imagenesNotaPrensa,
                        'videos' => $videosNotaPrensa,
                        'lang' => $language,
                        'section' => "comunicaciones",
                        'texts' => $textsTwig,
                        'cantFotos' => count($imagenesNotaPrensa),
                        'cantVideos' => count($videosNotaPrensa)
                    );
                } else {
                    $notas = obtenerNotasPrensa();

                    $url = "comunicaciones/vistaNotaPrensa.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'notas' => $notas,
                        'lang' => $language,
                        'texts' => $textsTwig
                    );
                }
            } else {
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'noticia':
            require_once '../../php/funciones/funcionesNoticia.php';
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

            if (isset($_GET['nombreNoticiaUrl']) && ($_GET['nombreNoticiaUrl'])) {

                $nombreNoticiaUrl = sanearDatos($_GET['nombreNoticiaUrl']);

                $datosNoticuia = obtenerNoticiaPorNombreUrl($nombreNoticiaUrl);

                //var_dump($datosNoticuia);

                if ($datosNoticuia['idNoticia']) {

                    $imagenesNoticia = obtenerImagenesPorIdNoticia($datosNoticuia['idNoticia']);
                    $videosNoticia = obtenerVideosPorIdNoticia($datosNoticuia['idNoticia']);

                    foreach ($videosNoticia as $da => $key) {
                        $embed = explode("=", $videosNoticia[$da]['nombreVideoNoticia']);

                        $nombreVideoNoticiaEmbed = "//youtube.com/embed/" . $embed[1];

                        $videosNoticia[$da]['nombreVideoNoticiaEmbed'] = $nombreVideoNoticiaEmbed;
                    }

                    $datosNoticuia['tituloNoticia'] = html_entity_decode($datosNoticuia['tituloNoticia']);
                    $datosNoticuia['fuenteNoticia'] = html_entity_decode($datosNoticuia['fuenteNoticia']);
                    $datosNoticuia['descripcionNoticia'] = html_entity_decode($datosNoticuia['descripcionNoticia']);
                    $datosNoticuia['cuerpoNoticia'] = $datosNoticuia['cuerpoNoticia'];
                    $datosNoticuia['tituloNoticiaRecorte'] = html_entity_decode(acortar($datosNoticuia['tituloNoticia'], 30));

                    $url = "comunicaciones/mostrarNoticia.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'datosNoticia' => $datosNoticuia,
                        'imagenes' => $imagenesNoticia,
                        'videos' => $videosNoticia,
                        'lang' => $language,
                        'texts' => $textsTwig,
                        'cantFotos' => count($imagenesNoticia),
                        'cantVideos' => count($videosNoticia)
                    );
                } else {

                    $noticiasDestacadas = obtenerNoticiasSlide();

                    $noticias = obtenerNoticias();

                    $url = "comunicaciones/vistaNoticia.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'noticias' => $noticias,
                        'noticiasDestacadas' => $noticiasDestacadas,
                        'lang' => $language,
                        'section' => "comunicaciones",
                        'texts' => $textsTwig
                    );
                }
            } else {
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'evento':
            require_once '../../php/funciones/funcionesEvento.php';
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

            if (isset($_GET['nombreEventoUrl']) && ($_GET['nombreEventoUrl'])) {

                $nombreEventoUrl = sanearDatos($_GET['nombreEventoUrl']);

                $datoEvento = obtenerEventoPorNombreUrl($nombreEventoUrl);

                if ($datoEvento['idEvento']) {

                    $imagenesEvento = obtenerImagenesPorIdEvento($datoEvento['idEvento']);
                    $videosEvento = obtenerVideosPorIdEvento($datoEvento['idEvento']);
                    $archivosEvento = obtenerArchivosPorIdEvento($datoEvento['idEvento']);

                    foreach ($videosEvento as $da => $key) {
                        $embed = explode("=", $videosEvento[$da]['nombreVideoEvento']);

                        $nombreVideoEventoEmbed = "//youtube.com/embed/" . $embed[1];

                        $videosEvento[$da]['nombreVideoEventoEmbed'] = $nombreVideoEventoEmbed;
                    }

                    $datoEvento['tituloEvento'] = html_entity_decode($datoEvento['tituloEvento']);
                    $datoEvento['lugarEvento'] = html_entity_decode($datoEvento['lugarEvento']);
                    $datoEvento['descripcionEvento'] = html_entity_decode($datoEvento['descripcionEvento']);
                    $datoEvento['cuerpoEvento'] = $datoEvento['cuerpoEvento'];
                    $datoEvento['tituloEventoRecorte'] = html_entity_decode(acortar($datoEvento['tituloEvento'], 30));

                    $url = "comunicaciones/mostrarAgenda.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'datoEvento' => $datoEvento,
                        'imagenes' => $imagenesEvento,
                        'videos' => $videosEvento,
                        'archivos' => $archivosEvento,
                        'lang' => $language,
                        'texts' => $textsTwig,
                        'cantFotos' => count($imagenesEvento),
                        'cantVideos' => count($videosEvento),
                        'cantArchivos' => count($archivosEvento),
                    );
                } else {
                    $eventos = obtenerEventos();

                    $url = "comunicaciones/vistaAgenda.twig";

                    $index = array(
                        'paths' => $paths,
                        'pathsJson' => $pathsJson,
                        'localhost' => $localhost,
                        'perfil' => $perfil,
                        'eventos' => $eventos,
                        'lang' => $language,
                        'texts' => $textsTwig
                    );
                }
            } else {
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'posicion':
            require_once '../../php/funciones/funcionesPosicion.php';
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

            if (isset($_GET['nombrePosicionUrl']) && ($_GET['nombrePosicionUrl'])) {

                $nombrePosicionUrl = sanearDatos($_GET['nombrePosicionUrl']);

                $datosPosicion = obtenerPosicionPorNombreUrl($nombrePosicionUrl);

                $url = "comunicaciones/mostrarPosicion.twig";

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'perfil' => $perfil,
                    'datosPosicion' => $datosPosicion,
                    'lang' => $language,
                    'texts' => $textsTwig
                );
            } else {
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        default :

            require_once '../../php/security/securityControl.php';

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $url = "paginaError.twig";
            $mostrarFooter = true;
            break;
    }
} else {
    require_once '../../php/security/securityControl.php';

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
