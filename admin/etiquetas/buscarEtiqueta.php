<?php
    require_once '../../php/configWebData.php';
    require_once '../../php/funciones.php';
    require_once '../../php/funcionesPhp.php';
    require_once '../../php/funciones/funcionesEtiqueta.php';
    $etiquetas = buscarEtiqueta($_GET['tag']);
    echo json_encode($etiquetas);
?>
