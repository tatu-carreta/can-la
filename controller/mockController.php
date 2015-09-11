<?php
require_once '../Twig-1.14.2/lib/Twig/Autoloader.php';

Twig_Autoloader::register();

$templateDir = "../html";
$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);
$lexer = new Twig_Lexer($twig, array(
    'tag_comment'   => array('{#', '#}'),
    'tag_block'     => array('[%', '%]'),
    'tag_variable'  => array('[[', ']]'),
    'interpolation' => array('#{', '}'),
));
$twig->setLexer($lexer);

$images = array(
	'tabla' => "secretariado",
	'uploader' => "../php/mockUploader.php",
	'seccion' => "sobrecanla"
);

if (isset($_GET['seccion']))
{
	switch ($_GET['seccion'])
	{
		case "images":
			$url = "images.twig";
			$template = $twig->loadTemplate("/" . $url);
			$template->display($images);
		break;
		case "pdf":
			$url = "pdf.twig";
			$template = $twig->loadTemplate("/" . $url);
			$template->display($images);
		break;
		case "modal":
			$url = "callModal.twig";
			$template = $twig->loadTemplate("/" . $url);
			$template->display($images);
		break;
		default:
			echo "no eligió sección";
		break;
	}
}

?>