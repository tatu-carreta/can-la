<?php

require_once '../../php/configWebData.php';
require_once '../../php/security/security.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';

permisoLogueado($localhost);

session_unset();
session_destroy();
session_regenerate_id(true);

if ($localhost) {
    header("Location:../../");
} else {
    header("Location:" . PATH_HOME);
}

exit();
?>
