<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);


    switch ($seccion) {
        case 'agregarEtiqueta':
            require_once '../../admin/etiquetas/agregarEtiqueta.php';
            break;
        case 'etiquetas':
            require_once '../../php/funciones/funcionesEtiqueta.php';
            $etiquetas = buscarEtiqueta($_POST['tag']);
            echo json_encode($etiquetas);
            break;
        default :

            require_once '../../php/security/securityControl.php';

            if ($localhost) {
                header("Location:../../");
            } else {
                header("Location:" . PATH_HOME);
            }
            break;
    }
} else {
    if ($localhost) {
        header("Location:../../");
    } else {
        header("Location:" . PATH_HOME);
    }
}
?>
