<?php

if (!isset($localhost)) {
    require_once '../../php/configWebData.php';
    $noLocalhost = true;
}

require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/funciones/funcionesUsuario.php';

require_once '../../php/validate/validateUsuario.php';
require_once '../../php/security/security.php';

/*
 * Si está logueado no tiene acceso.
 */
//yaEstaLogueado();

if (isset($noLocalhost) && ($noLocalhost)) {
    require_once '../../php/security/securityControl.php';
}

/*
 * Se validan los datos del login.
 */
$infoValidate = validarDatosLogin();

$estado = false;

if ($infoValidate['estado']) {
    $nombreUsuario = sanearDatos($_POST['user']);
    $claveUsuario = sanearDatos($_POST['pass']);
    //$continue = $_POST['continue'];

    $estado = obtenerUsuarioPorNombreClave($nombreUsuario, $claveUsuario);

    if ($estado['estado']) {
        $_SESSION['user_name'] = "Administrador";
        $_SESSION['user_mac'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['ip_user'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['private'] = blow_crypt("C9l1n3s9s39m9", 4);
        $_SESSION['private_alternative'] = $_SESSION['private'];
        $_SESSION['user_type'] = $estado['perfil'];
        $_SESSION['iderUser'] = $estado['iderUser'];
        $_SESSION['user_last_activity'] = time();
        $estado = realizarInformeUsuarioLogueado($estado['idUsuario'], $_SERVER['REMOTE_ADDR']);
        $texto = "Usted se ha logueado correctamente.";

        header("Location: ../../");

        //var_dump($_SESSION);
    } else {
        $texto = "Error al iniciar sesión. El nombre de usuario o la contraseña son inválidos.";

        header("Location: ../usuarios/controladorAdmin.php?seccion=login&error=ok");
    }
} else {
    $texto = $infoValidate['texto'];
    
    header("Location: ../usuarios/controladorAdmin.php?seccion=login&error=ok");
}

$data = array(
    "estado" => $estado,
    "texto" => $texto
);

echo json_encode($data);
?>
