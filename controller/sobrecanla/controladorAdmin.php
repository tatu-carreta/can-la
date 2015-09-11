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
        case 'agregarAlianza':
            $index['lang'] = $language;
            $url = "sobrecanla/agregarAlianza.twig";
            break;
        case 'agregarCanInternacional':
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;

            $url = "sobrecanla/agregarCanInternacional.twig";
            $mostrarFooter = true;
            break;
        case 'agregarHistoria':
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;

            $url = "sobrecanla/agregarHistoria.twig";
            $mostrarFooter = true;
            break;
        case 'agregarMiembro':
            require_once '../../php/funciones/funcionesMiembro.php';

            $paises = obtenerPaises();

            $index['paises'] = $paises;
            $index['lang'] = $language;
            $url = "sobrecanla/agregarMiembro.twig";
            break;
        case 'agregarObjetivo':
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;

            $url = "sobrecanla/agregarObjetivo.twig";
            $mostrarFooter = true;
            break;
        case 'agregarReglamento':
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $index['lang'] = $language;
            $index['texts'] = $textsTwig;

            $url = "sobrecanla/agregarReglamento.twig";
            $mostrarFooter = true;
            break;
        case 'agregarReporteAnual':
            $index['lang'] = $language;
            $url = "sobrecanla/agregarReporteAnual.twig";
            break;
        case 'agregarSecretariado':
            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'lang' => $language
            );
            $url = "sobrecanla/agregarSecretariado.twig";
            break;
        case 'modificarAlianza':
            require_once '../../php/funciones/funcionesAlianza.php';
            require_once '../../php/validate/validateAlianza.php';

            $infoValidate = validarVistaModificarAlianza();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idAlianza = sanearDatos($_GET['idAlianza']);

                $datoAlianza = obtenerDatosAlianzaPorId($idAlianza);
                $datoAlianza['nombreAlianza'] = addslashes(html_entity_decode($datoAlianza['nombreAlianza']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'dataArray' => $datoAlianza,
                    'lang' => $language
                );

                $url = "sobrecanla/modificarAlianza.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarCanInternacional':
            require_once '../../php/funciones/funcionesSobreCanla.php';
            require_once '../../php/validate/validateSobreCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $infoValidate = validarVistaModificarSobreCanla();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idSobreCanla = sanearDatos($_GET['idSobreCanla']);

                $datoObjetivo = obtenerDatosSobreCanlaPorId($idSobreCanla);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoSobreCanla' => $datoObjetivo,
                    'lang' => $language,
                    'texts' => $textsTwig
                );

                $url = "sobrecanla/modificarCanInternacional.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'modificarHistoria':
            require_once '../../php/funciones/funcionesSobreCanla.php';
            require_once '../../php/validate/validateSobreCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $infoValidate = validarVistaModificarSobreCanla();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idSobreCanla = sanearDatos($_GET['idSobreCanla']);

                $datoHistoria = obtenerDatosSobreCanlaPorId($idSobreCanla);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoSobreCanla' => $datoHistoria,
                    'lang' => $language,
                    'texts' => $textsTwig
                );

                $url = "sobrecanla/modificarHistoria.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'modificarMiembro':
            require_once '../../php/funciones/funcionesMiembro.php';
            require_once '../../php/validate/validateMiembro.php';

            $paises = obtenerPaises();

            //$infoValidate = validarVistaModificarSobreCanla();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idMiembro = sanearDatos($_GET['idMiembro']);
                $dataArray = obtenerMiembroPorId($idMiembro);

                $dataArray['nombreMiembro'] = addslashes(html_entity_decode($dataArray['nombreMiembro']));
                $dataArray['representanteMiembro'] = addslashes(html_entity_decode($dataArray['representanteMiembro']));
                $dataArray['descripcionMiembro'] = addslashes(html_entity_decode($dataArray['descripcionMiembro']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'dataArray' => $dataArray,
                    'lang' => $language,
                    'paises' => $paises
                );

                $url = "sobrecanla/modificarMiembro.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }

            break;
        case 'modificarObjetivo':
            require_once '../../php/funciones/funcionesSobreCanla.php';
            require_once '../../php/validate/validateSobreCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $infoValidate = validarVistaModificarSobreCanla();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idSobreCanla = sanearDatos($_GET['idSobreCanla']);

                $datoObjetivo = obtenerDatosSobreCanlaPorId($idSobreCanla);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoSobreCanla' => $datoObjetivo,
                    'lang' => $language,
                    'texts' => $textsTwig
                );

                $url = "sobrecanla/modificarObjetivo.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'modificarReglamento':
            require_once '../../php/funciones/funcionesSobreCanla.php';
            require_once '../../php/validate/validateSobreCanla.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);

            $infoValidate = validarVistaModificarSobreCanla();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idSobreCanla = sanearDatos($_GET['idSobreCanla']);

                $datoReglamento = obtenerDatosSobreCanlaPorId($idSobreCanla);

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'datoSobreCanla' => $datoReglamento,
                    'lang' => $language,
                    'texts' => $textsTwig
                );

                $url = "sobrecanla/modificarReglamento.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            $mostrarFooter = true;
            break;
        case 'modificarReporteAnual':
            require_once '../../php/funciones/funcionesReporteAnual.php';
            require_once '../../php/validate/validateReporteAnual.php';

            $infoValidate = validarVistaModificarReporteAnual();
            //$infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idReporteAnual = sanearDatos($_GET['idReporteAnual']);

                $datoReporteAnual = obtenerDatosReporteAnualPorId($idReporteAnual);
                $datoReporteAnual['tituloReporteAnual'] = addslashes(html_entity_decode($datoReporteAnual['tituloReporteAnual']));
                $datoReporteAnual['fechaManualReporteAnual'] = str_replace("-", "/", cambiarFecha($datoReporteAnual['fechaManualReporteAnual']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'dataArray' => $datoReporteAnual,
                    'lang' => $language
                );

                $url = "sobrecanla/modificarReporteAnual.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            break;
        case 'modificarSecretariado':
            require_once '../../php/funciones/funcionesSecretariado.php';
            require_once '../../php/validate/validateReporteAnual.php';

            //$infoValidate = validarVistaModificarSobreCanla();
            $infoValidate['estado'] = true;
            if ($infoValidate['estado']) {

                $idSecretariado = sanearDatos($_GET['idSecretariado']);
                $dataArray = obtenerSecretariadoPorId($idSecretariado);

                $dataArray['textoSecretariado'] = addslashes(html_entity_decode($dataArray['textoSecretariado']));
                $dataArray['nombreSecretariado'] = addslashes(html_entity_decode($dataArray['nombreSecretariado']));
                $dataArray['cargoSecretariado'] = addslashes(html_entity_decode($dataArray['cargoSecretariado']));

                $index = array(
                    'paths' => $paths,
                    'pathsJson' => $pathsJson,
                    'localhost' => $localhost,
                    'dataArray' => $dataArray,
                    'lang' => $language
                );

                $url = "sobrecanla/modificarSecretariado.twig";
            } else {
                $index = array(
                    'texto' => $infoValidate['texto']
                );
                $url = "paginaError.twig";
            }
            //$url = "sobrecanla/modificarSecretariado.twig";
            break;
        case 'alianzas':
            require_once '../../php/funciones/funcionesAlianza.php';
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

            $alianzasPrincipales = obtenerDatosAlianzasPorCategoria(1);
            $alianzasSecundarias = obtenerDatosAlianzasPorCategoria(2);


            $url = "sobrecanla/vistaAlianza.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'alianzasPrincipales' => $alianzasPrincipales,
                'alianzasSecundarias' => $alianzasSecundarias,
                'section' => 'sobrecanla',
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'historia':
            require_once '../../php/funciones/funcionesSobreCanla.php';
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

            $datoHistoria = obtenerDatosSobreCanlaPorTipo("H");

            $url = "sobrecanla/vistaHistoria.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'datoSobreCanla' => $datoHistoria,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'ordenarSecretariado':
            require_once '../../php/funciones/funcionesSecretariado.php';

            $dataArray = listadoSecretariado(); //array con todos los miembros del secretariado
            $url = "sobrecanla/ordenarSecretariado.twig";
            
            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'dataArray' => $dataArray,
                'section' => 'sobrecanla',
                'lang' => $language,
                'texts' => $textsTwig
            );

            
            break;
        case 'objetivos':
            require_once '../../php/funciones/funcionesSobreCanla.php';
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

            $datoObjetivo = obtenerDatosSobreCanlaPorTipo("O");

            $url = "sobrecanla/vistaObjetivo.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'datoSobreCanla' => $datoObjetivo,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'reglamento':
            require_once '../../php/funciones/funcionesSobreCanla.php';
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

            $datoReglamento = obtenerDatosSobreCanlaPorTipo("R");

            $url = "sobrecanla/vistaReglamento.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'datoSobreCanla' => $datoReglamento,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'canInternacional':
            require_once '../../php/funciones/funcionesSobreCanla.php';
            require_once '../../php/funciones/funcionesAlianza.php';
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

            $datoObjetivo = obtenerDatosSobreCanlaPorTipo("C");

            $url = "sobrecanla/vistaCanInternacional.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'datoSobreCanla' => $datoObjetivo,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'reporteAnual':
            require_once '../../php/funciones/funcionesReporteAnual.php';
            require_once '../../php/funciones/funcionesAlianza.php';
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

            $reportes = obtenerReportes();

            $url = "sobrecanla/vistaReporteAnual.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'reportes' => $reportes,
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;

        case 'secretariado':
            require_once '../../php/funciones/funcionesAlianza.php';
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);
            require_once '../../php/funciones/funcionesSecretariado.php';

            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
                $perfil = $_SESSION['user_type'];
            } else {
                $perfil = -1;
            }

            $dataArray = listadoSecretariado(); //array con todos los miembros del secretariado

            $url = "sobrecanla/vistaSecretariado.twig";

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'dataArray' => $dataArray,
                'section' => 'sobrecanla',
                'lang' => $language,
                'texts' => $textsTwig
            );
            $mostrarFooter = true;
            break;
        case 'miembros':
            require_once '../../php/funciones/funcionesArea.php';

            $areas = obtenerAreas();

            $header['areas'] = $areas;

            $template = $twig->loadTemplate("/header.twig");
            /* Pasaje del arreglo a la vista .twig */
            $template->display($header);
            require_once '../../php/funciones/funcionesMiembro.php';

            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
                $perfil = $_SESSION['user_type'];
            } else {
                $perfil = -1;
            }

            if (isset($_GET['idPais']) && ($_GET['idPais'] != "")) {
                $idPais = sanearDatos($_GET['idPais']);
                $dataArray = obtenerMiembrosPorIdPais($idPais);
            } else {
                $idPais = NULL;
                $dataArray = obtenerMiembros();
            }

            $url = "sobrecanla/vistaMiembro.twig";

            $paises = obtenerPaises();

            $index = array(
                'paths' => $paths,
                'pathsJson' => $pathsJson,
                'localhost' => $localhost,
                'perfil' => $perfil,
                'dataArray' => $dataArray,
                'section' => 'sobrecanla',
                'lang' => $language,
                'texts' => $textsTwig,
                'paises' => $paises,
                'idPais' => $idPais
            );
            $mostrarFooter = true;
            break;
        default :

            require_once '../../php/security/securityControl.php';
            require_once '../../php/funciones/funcionesAlianza.php';
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
    require_once '../../php/funciones/funcionesAlianza.php';
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
    require_once '../../php/funciones/funcionesAlianza.php';
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
