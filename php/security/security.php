<?php

function permisoLogueado($localhost) {
    if (!isset($_SESSION['user_name']) || (!isset($_SESSION['ip_user'])) || ($_SESSION['ip_user'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['private'] != $_SESSION['private_alternative'])) {

        require_once '../../php/security/securityControl.php';
        if (file_exists("../usuarios/controladorAdmin.php?seccion=login")) {
            if ($localhost) {
                header("Location: ../usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        } else {
            if ($localhost) {
                header("Location: ../../controller/usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        }

        exit();
    }
}

function permisoRol($arrayRoles, $localhost) {
    if (!in_array($_SESSION['user_type'], $arrayRoles) || ($_SESSION['ip_user'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['private'] != $_SESSION['private_alternative'])) {
        require_once '../../php/security/securityControl.php';
        if (file_exists("../usuarios/controladorAdmin.php?seccion=login")) {
            if ($localhost) {
                header("Location: ../usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        } else {
            if ($localhost) {
                header("Location: ../controller/usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        }
        exit();
    }
}

function permisoNoLogueado() {
    $ok = false;
    if (!isset($_SESSION['user_name']) || (!isset($_SESSION['ip_user'])) || (!isset($_SESSION['private'])) || (!isset($_SESSION['private_alternative']))) {
        $ok = true;
    }

    return $ok;
}

function yaEstaLogueado($localhost) {
    if (isset($_SESSION['user_name']) && (isset($_SESSION['ip_user'])) && ($_SESSION['ip_user'] == $_SERVER['REMOTE_ADDR']) && ($_SESSION['private'] == $_SESSION['private_alternative'])) {
        require_once '../../php/security/securityControl.php';
        if (file_exists("../usuarios/controladorAdmin.php?seccion=login")) {
            if ($localhost) {
                header("Location: ../usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        } else {
            if ($localhost) {
                header("Location: ../controller/usuarios/controladorAdmin.php?seccion=login&error=ok");
            } else {
                header("Location:" . PATH_HOME . "login/ok");
            }
        }

        exit();
    }
}

?>