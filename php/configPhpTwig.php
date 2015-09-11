<?php

if (file_exists("../../Twig-1.14.2/lib/Twig/Autoloader.php")) {
    require_once '../../Twig-1.14.2/lib/Twig/Autoloader.php';
} else {
    require_once 'Twig-1.14.2/lib/Twig/Autoloader.php';
}
Twig_Autoloader::register();

$i = rand(0, 50);
//PARA CARPETA HTML
if (file_exists("../../html")) {
    $templateDir = "../../html";
} else {
    $templateDir = "html";
}
$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);
$lexer = new Twig_Lexer($twig, array(
    'tag_comment' => array('{#', '#}'),
    'tag_block' => array('[%', '%]'),
    'tag_variable' => array('[[', ']]'),
    'interpolation' => array('#{', '}'),
        ));
$twig->setLexer($lexer);

//PARA CARPETA PHP
if (file_exists("../../php")) {
    $templateDir2 = "../../php";
} else {
    $templateDir2 = "php";
}
$loader2 = new Twig_Loader_Filesystem($templateDir2);
$twig2 = new Twig_Environment($loader2);

$paths = array();
$pathsJson = array();
$textsTwig = array();

foreach ($pathsProject as $key => $path) {
    $paths[$key] = $path;
    $pathsJson[$key] = json_encode($path);
}
foreach ($texts as $key => $value) {
    $textsTwig[$key] = $value;
}
/*
  if (file_exists("../php/funciones/funcionesArea.php")) {
  require_once '../php/funciones/funcionesArea.php';
  } else {
  require_once '../../php/funciones/funcionesArea.php';
  }

  $areas = obtenerAreas();
 */
if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != "")) {
    $perfil = $_SESSION['user_type'];
} else {
    $perfil = -1;
}

$head = array('paths' => $paths,
    'pathsJson' => $pathsJson,
    'rand' => $i,
    'lang' => $language,
    'texts' => $textsTwig,
);

$header = array('paths' => $paths,
    'localhost' => $localhost,
    'lang' => $language,
    'texts' => $textsTwig,
    'perfil' => $perfil
);

$menu = array(
    'paths' => $paths,
    'texts' => $textsTwig
);

$footer = array(
    'paths' => $paths,
    'texts' => $textsTwig,
    'localhost' => $localhost,
    'lang' => $language,
);

$index = array(
    'paths' => $paths,
    'texts' => $textsTwig
);
?>
