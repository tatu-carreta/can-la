<?php

if (!isset($localhost)) {
    require_once '../../php/config.php';
    $noLocalhost = true;
}


require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesNoticia.php';
require_once '../../php/funciones/funcionesEtiqueta.php';
require_once '../../php/validate/validateNoticia.php';

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

$infoValidate = validarModificacionNoticia();
//$infoValidate['estado'] = true;
$href = "";
if ($infoValidate['estado']) {

    $tituloNoticia = sanearDatos($_POST['tituloNoticia']);
    $fuenteNoticia = sanearDatos($_POST['fuenteNoticia']);

    if (isset($_POST['archivo']) && ($_POST['archivo'] != "")) {
        $imagenNoticia = $_POST['archivo'];
    } else {
        $imagenNoticia = NULL;
    }

    $fechaNoticia = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaNoticia'])));
    $descripcionNoticia = sanearDatos($_POST['descripcionNoticia']);

    $cuerpoNoticia = $_POST['cuerpoNoticia'];
    /*
      $cuerpoNoticia = $_POST['cuerpoNoticia'];

      if ((!is_string($cuerpoNoticia) && !is_numeric($cuerpoNoticia)))
      continue;

      if (get_magic_quotes_gpc())
      $cuerpoNoticia = stripslashes((string) $cuerpoNoticia);
      else
      $cuerpoNoticia = (string) $cuerpoNoticia;
     */


    if (isset($_POST['idArea']) && ($_POST['idArea'] != "")) {
        $idArea = sanearDatos($_POST['idArea']);
    } else {
        $idArea = NULL;
    }

    $idNoticia = sanearDatos($_POST['id']);

    $estadoAgregacion = realizarModificacionNoticia($tituloNoticia, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $idArea, $idNoticia);


    $eliminacionEtiquetas = eliminarEtiquetas('noticia', $idNoticia);

    if (!$eliminacionEtiquetas) {
        $estadoAgregacion = false;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idNoticia, 'noticia');
    }

    if ($estadoAgregacion == 1) {
        $texto = "La noticia se ha modificado correctamente.";

        if (isset($_POST['mostrar']) && ($_POST['mostrar'] == "ok")) {
            if ($localhost) {
                $href = PATH_CONTROLLER_COMUNICACIONES . "controladorAdmin.php?seccion=noticia&nombreNoticiaUrl=" . strtolower(urlAmigable($tituloNoticia)) . "&language=" . $language;
            } else {
                $href = PATH_HOME . $language . "/noticia/" . strtolower(urlAmigable($tituloNoticia));
            }
        }
    } else {
        $texto = "Hubo un error al modificar la noticia. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
    $estadoAgregacion = $infoValidate['estado'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto,
    'href' => $href
);

echo json_encode($data);
?>
