<?php

session_start(); //comentar esta linea si no se trabaja con sesiones
//require_once 'admin/sessionControl.php';
ini_set('default_charset', 'utf8');
/*
  if (isset($redirectAdmin)) {
  $_SESSION['redir_login'] = $redirectAdmin;
  }
 */

$localhost = true; //define si se esta trabajando a modo local o no
$proyecto = "Can Latinoamérica";

switch ($_SERVER['HTTP_HOST']) {
    case "www.can-la.org":
        define("URL_PRODUCTION", "http://www.can-la.org/nuevo/");
        break;
    case "can-la.org":
        define("URL_PRODUCTION", "http://can-la.org/nuevo/");
        break;
    default :
        define("URL_PRODUCTION", "http://can-la.org/nuevo/");
        break;
}
define("URL_LOCAL", "http://localhost/can-la/");

if (isset($_SESSION['lang'])) {
    $language = $_SESSION['lang'];
} else {
    $_SESSION['lang'] = "es";
    $language = "es";
}
/*
  if (!isset($_GET['language'])) {
  $language = "es";
  } else {
  $language = $_GET['language'];
  }
 * 
 */

if (!$localhost) {

    define("DB_HOST", "localhost");

    if ($language == "es") {
        define("DB_USER_ACTUAL", "en000521_canuser");
        define("DB_PASS_ACTUAL", "PassCanla1");
        define("DB_USER_MIRROR", "en000521_usercan");
        define("DB_PASS_MIRROR", "PassCanla2");

        define("DB_SELECTED_ACTUAL", "en000521_can_la_access_es");
        define("DB_SELECTED_MIRROR", "en000521_can_la_access_en");
    } else {
        define("DB_USER_ACTUAL", "en000521_usercan");
        define("DB_PASS_ACTUAL", "PassCanla2");
        define("DB_USER_MIRROR", "en000521_canuser");
        define("DB_PASS_MIRROR", "PassCanla1");

        define("DB_SELECTED_ACTUAL", "en000521_can_la_access_en");
        define("DB_SELECTED_MIRROR", "en000521_can_la_access_es");
    }


    define("URL_TOTAL", URL_PRODUCTION);
} else {
    define("DB_HOST", "localhost");
    define("DB_USER_ACTUAL", "root");
    define("DB_PASS_ACTUAL", "");
    define("DB_USER_MIRROR", "root");
    define("DB_PASS_MIRROR", "");
    define("URL_TOTAL", URL_LOCAL);
    if ($language == "es") {
        define("DB_SELECTED_ACTUAL", "can-la-es");
        define("DB_SELECTED_MIRROR", "can-la-en");
        define("PATH_TEXTS", URL_TOTAL . "languages/ES/");
    } else {
        define("DB_SELECTED_ACTUAL", "can-la-en");
        define("DB_SELECTED_MIRROR", "can-la-es");
        define("PATH_TEXTS", URL_TOTAL . "languages/EN/");
    }
}

$pathsProject = array();

/*
 * SECCIÓN DE DECLARACIÓN DE CONSTANTES
 */

define("REDIRECT_PATH", URL_TOTAL);
define("PATH_HOME", URL_TOTAL);
define("PATH_CSS", URL_TOTAL . "css/");
define("PATH_FONTKIT", URL_TOTAL . "fontkit/");
define("PATH_PHP", URL_TOTAL . "php/");
define("PATH_HTML", URL_TOTAL . "html/");
define("PATH_JS", URL_TOTAL . "js/");
define("PATH_ADMIN", URL_TOTAL . "admin/");
define("PATH_CONTROLLER", URL_TOTAL . "controller/");
define("PATH_IMAGES", URL_TOTAL . "images/");
define("PATH_CKEDITOR", URL_TOTAL . "ckeditor/");
define("PATH_FULLCALENDAR", URL_TOTAL . "fullcalendar/");

// SECCION CONTROLLER
define("PATH_CONTROLLER_AREAS", PATH_CONTROLLER . "areas/");
define("PATH_CONTROLLER_COMUNICACIONES", PATH_CONTROLLER . "comunicaciones/");
define("PATH_CONTROLLER_PUBLICACIONES", PATH_CONTROLLER . "publicaciones/");
define("PATH_CONTROLLER_SOBRECANLA", PATH_CONTROLLER . "sobrecanla/");

// SECCION IMAGES
define("PATH_IMAGES_AREAS", PATH_IMAGES . "areas/");
define("PATH_IMAGES_COMUNICACIONES", PATH_IMAGES . "comunicaciones/");
define("PATH_IMAGES_PUBLICACIONES", PATH_IMAGES . "publicaciones/");
define("PATH_IMAGES_SOBRECANLA", PATH_IMAGES . "sobrecanla/");


/*
 * SECCIÓN DE CARGA DE CONSTANTES EN EL ARREGLO
 */

$pathsProject["REDIRECT_PATH"] = REDIRECT_PATH;
$pathsProject["PATH_HOME"] = PATH_HOME;
$pathsProject["PATH_CSS"] = PATH_CSS;
$pathsProject["PATH_FONTKIT"] = PATH_FONTKIT;
$pathsProject["PATH_PHP"] = PATH_PHP;
$pathsProject["PATH_HTML"] = PATH_HTML;
$pathsProject["PATH_JS"] = PATH_JS;
$pathsProject["PATH_ADMIN"] = PATH_ADMIN;
$pathsProject["PATH_CONTROLLER"] = PATH_CONTROLLER;
$pathsProject["PATH_IMAGES"] = PATH_IMAGES;
$pathsProject["PATH_CKEDITOR"] = PATH_CKEDITOR;
$pathsProject["PATH_FULLCALENDAR"] = PATH_FULLCALENDAR;

// SECCION CONTROLLER
$pathsProject["PATH_CONTROLLER_AREAS"] = PATH_CONTROLLER_AREAS;
$pathsProject["PATH_CONTROLLER_COMUNICACIONES"] = PATH_CONTROLLER_COMUNICACIONES;
$pathsProject["PATH_CONTROLLER_PUBLICACIONES"] = PATH_CONTROLLER_PUBLICACIONES;
$pathsProject["PATH_CONTROLLER_SOBRECANLA"] = PATH_CONTROLLER_SOBRECANLA;

//SECCION DE ARREGLO IMAGES
$pathsProject["PATH_IMAGES"] = PATH_IMAGES;
$pathsProject["PATH_IMAGES_AREAS"] = PATH_IMAGES_AREAS;
$pathsProject["PATH_IMAGES_COMUNICACIONES"] = PATH_IMAGES_COMUNICACIONES;
$pathsProject["PATH_IMAGES_PUBLICACIONES"] = PATH_IMAGES_PUBLICACIONES;
$pathsProject["PATH_IMAGES_SOBRECANLA"] = PATH_IMAGES_SOBRECANLA;
$pathsProject["PATH_TEXTS"] = PATH_TEXTS;

/*
  LLAMADA A LOS TEXTOS
 */
$texts = array();
$mostrarFooter = false;

?>