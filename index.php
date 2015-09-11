<?php

require_once 'php/configWebData.php';
if (file_exists("languages/" . $language . "/texts.php")) {
    require_once("languages/" . $language . "/texts.php");
}
require_once 'php/configPhpTwig.php';
/* Incluir este configPhpTwig cuando se quiera utilizar Twig
 * importante para los paths absolutos y configuracion
 * del Template
 */
require_once 'php/security/security.php';
require_once 'php/funciones.php';
require_once 'php/funcionesPhp.php';
/* Carga del archivo de la vista .twig */
require_once 'php/funciones/funcionesArea.php';
require_once 'php/funciones/funcionesNoticia.php';
require_once 'php/funciones/funcionesEvento.php';
require_once 'php/funciones/funcionesNotaPrensa.php';

$areas = obtenerAreas();
$noticias = obtenerNoticiasHome();
$eventos = obtenerEventosHome();

$noticiasSlide = obtenerNoticiasSlide();
$eventosSlide = obtenerEventosSlide();
$notasSlide = obtenerNotasSlide();
/*
 * ARREGLA CODIFICACION DATOS DE LA HOME
 */
foreach ($noticias as $da => $key) {
    $noticias[$da]['tituloNoticia'] = html_entity_decode($noticias[$da]['tituloNoticia']);
    $noticias[$da]['descripcionNoticia'] = html_entity_decode($noticias[$da]['descripcionNoticia']);
}

foreach ($eventos as $da => $key) {
    $eventos[$da]['tituloEvento'] = html_entity_decode($eventos[$da]['tituloEvento']);
    $eventos[$da]['lugarEvento'] = html_entity_decode($eventos[$da]['lugarEvento']);
    $eventos[$da]['descripcionEvento'] = html_entity_decode($eventos[$da]['descripcionEvento']);
}

/*
 * ARREGLA CODIFICACION DATOS DEL SLIDE
 */
foreach ($noticiasSlide as $da => $key) {
    $noticiasSlide[$da]['tituloNoticia'] = html_entity_decode($noticiasSlide[$da]['tituloNoticia']);
}

foreach ($eventosSlide as $da => $key) {
    $eventosSlide[$da]['tituloEvento'] = html_entity_decode($eventosSlide[$da]['tituloEvento']);
    $eventosSlide[$da]['lugarEvento'] = html_entity_decode($eventosSlide[$da]['lugarEvento']);
}
foreach ($notasSlide as $da => $key) {
    $notasSlide[$da]['tituloNotaPrensa'] = html_entity_decode($notasSlide[$da]['tituloNotaPrensa']);
}

$header['areas'] = $areas;


$template = $twig->loadTemplate("/head.twig");

/* Pasaje del arreglo a la vista .twig */
$template->display($head);


/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/header.twig");

/* Pasaje del arreglo a la vista .twig */
$template->display($header);

$url = "index.twig";

/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/" . $url);
$index['areas'] = $areas;
$index['localhost'] = $localhost;
$index['lang'] = $language;
$index['noticias'] = $noticias;
$index['eventos'] = $eventos;
$index['noticiasSlide'] = $noticiasSlide;
$index['eventosSlide'] = $eventosSlide;
$index['notasSlide'] = $notasSlide;

/* Pasaje del arreglo a la vista .twig */
$template->display($index);

$footer['areas'] = $areas;
/* Carga del archivo de la vista .twig */
$template = $twig->loadTemplate("/footer.twig");

/* Pasaje del arreglo a la vista .twig */
$template->display($footer);
/*
  echo "U -> " . hashData("clan") . " - P -> " . hashData("issime");

  var_dump(obtenerUsuarioPorNombreClave("maxi@prueba.com", "888"));

  var_dump($_SESSION);

  echo hashData("8");

  var_dump(comprobar_string_sin_especiales("maxi@prueba.com"));
 * 
 */
?>
