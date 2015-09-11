<?php

if (file_exists("../php/security/securityFunctions.php")) {
    require_once '../php/security/securityFunctions.php';
} else if (file_exists("security/securityFunctions.php")) {
    require_once 'security/securityFunctions.php';
} else if (file_exists("../../php/security/securityFunctions.php")) {
    require_once '../../php/security/securityFunctions.php';
} else if (file_exists("php/security/securityFunctions.php")) {
    require_once 'php/security/securityFunctions.php';
} else if (file_exists("../securityFunctions.php")) {
    require_once '../securityFunctions.php';
} else if (file_exists("../../../php/security/securityFunctions.php")) {
    require_once '../../../php/security/securityFunctions.php';
}

if (isset($_SESSION['iderUser']) && ($_SESSION['iderUser'] != "")) {
    $iderUser = sanearDatos($_SESSION['iderUser']);
} else {
    $iderUser = NULL;
}

realizarMonitoreoMalicioso($iderUser);
?>
