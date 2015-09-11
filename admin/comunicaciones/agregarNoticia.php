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

$infoValidate = validarAltaNoticia();
//$infoValidate['estado'] = true;
if ($infoValidate['estado']) {


    $tituloNoticia = sanearDatos($_POST['tituloNoticia']);
    $fuenteNoticia = sanearDatos($_POST['fuenteNoticia']);
    $imagenNoticia = sanearDatos($_POST['archivo']);
    $fechaNoticia = cambiarFecha(str_replace("/", "-", sanearDatos($_POST['fechaNoticia'])));
    $descripcionNoticia = $_POST['descripcionNoticia'];

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

    $idNoticia = realizarAgregacionNoticia($tituloNoticia, $fuenteNoticia, $imagenNoticia, $fechaNoticia, $descripcionNoticia, $cuerpoNoticia, $idArea);

    if ($idNoticia > 0) {
        $estadoAgregacion = 1;
    }

    foreach ($_POST['tags'] as $tag) {
        $urlAmigable = urlAmigable($tag['text']);
        $estadoAgregacion = realizarAgregacionEtiqueta($tag['text'], $urlAmigable, $idNoticia, 'noticia');
    }

    if ($estadoAgregacion) {
        $texto = "La noticia se ha dado de alta correctamente.";
    } else {
        $texto = "Hubo un error al agregar la noticia. Vuelva a intentarlo en unos minutos.";
    }
} else {
    $texto = $infoValidate['texto'];
    $estadoAgregacion = $infoValidate['estado'];
}
$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto
);

echo json_encode($data);
?>
