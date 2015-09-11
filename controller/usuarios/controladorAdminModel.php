<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);


    switch ($seccion) {
        case 'login':
            if (permisoNoLogueado()) {
                require_once '../../admin/usuarios/iniciarSesion.php';
            } else {
                if ($localhost) {
                    header("Location:../../");
                } else {
                    header("Location:" . PATH_HOME);
                }
            }
            break;
        case 'logout':
            require_once '../../admin/usuarios/cerrarSesion.php';

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
