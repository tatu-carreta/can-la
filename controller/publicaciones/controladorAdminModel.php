<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);

    switch ($seccion) {
        case 'agregarOtraPublicacion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/agregarOtraPublicacion.php';
            break;
        case 'agregarPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/agregarPublicacionCanla.php';
            break;
        case 'modificarOtraPublicacion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/modificarOtraPublicacion.php';
            break;
        case 'modificarPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/modificarPublicacionCanla.php';
            break;
        case 'borrarOtraPublicacion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/borrarOtraPublicacion.php';
            break;
        case 'borrarPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/publicaciones/borrarPublicacionCanla.php';
            break;
        case 'listadoOtraPublicacion':

            require_once '../../php/funciones/funcionesOtraPublicacion.php';
            $dataArray = obtenerOtrasPublicaciones();

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloOtraPublicacion'] = html_entity_decode($dataArray[$da]['tituloOtraPublicacion']);
                $dataArray[$da]['descripcionOtraPublicacion'] = html_entity_decode($dataArray[$da]['descripcionOtraPublicacion']);
            }

            echo json_encode($dataArray);

            break;
        case 'etiquetasPublicacionCanla':
            require_once '../../php/funciones/funcionesPublicacionCanla.php';
            $dataArray = obtenerEtiquetasPorIdPublicacionCanla($_POST['id']);
            echo json_encode($dataArray);

            break;
        case 'listadoPublicaciones':

            require_once '../../php/funciones/funcionesPublicacionCanla.php';
            $dataArray = obtenerPublicaciones();

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloPublicacionCanla'] = html_entity_decode($dataArray[$da]['tituloPublicacionCanla']);
            }

            echo json_encode($dataArray);

            break;
        case 'eliminarArchivoPublicacionCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesPublicacionCanla.php';
            $result = realizarBajaArchivoPublicacionCanla(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        default :

            require_once '../../php/security/securityControl.php';

            $url = "paginaError.twig";
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
