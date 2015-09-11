<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);


    switch ($seccion) {
        case 'agregarAlianza':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/agregarAlianza.php';
            break;
        case 'agregarMiembro':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/agregarMiembro.php';
            break;
        case 'agregarReporteAnual':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/agregarReporteAnual.php';
            break;
        case 'agregarSecretariado':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/agregarSecretariado.php';
            break;
        case 'agregarSobreCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/agregarSobreCanla.php';
            break;
        case 'modificarAlianza':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/modificarAlianza.php';
            break;
        case 'modificarMiembro':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/modificarMiembro.php';
            break;
        case 'modificarReporteAnual':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/modificarReporteAnual.php';
            break;
        case 'modificarSecretariado':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/modificarSecretariado.php';
            break;
        case 'modificarSobreCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/modificarSobreCanla.php';

            break;
        case 'ordenarSecretariado':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            
            require_once '../../admin/sobrecanla/ordenarSecretariado.php';

            break;
        case 'borrarAlianza':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarAlianza.php';
            break;
        case 'borrarArchivoAlianza':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarArchivoAlianza.php';
            break;
        case 'paises':
            require_once '../../php/funciones/funcionesMiembro.php';
            $paises = obtenerPaisesJson();
            echo json_encode($paises);
            break;
        case 'borrarSobreCanla':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarSobreCanla.php';

            break;
        case 'borrarReporteAnual':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarReporteAnual.php';

            break;
        case 'borrarSecretariado':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarSecretariado.php';

            break;
        case 'borrarMiembro':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/sobrecanla/borrarMiembro.php';

            break;
        case 'listadoAlianza':

            require_once '../../php/funciones/funcionesAlianza.php';
            $alianzasPrincipales = obtenerDatosAlianzasPorCategoria(1);
            $alianzasSecundarias = obtenerDatosAlianzasPorCategoria(2);

            if (count($alianzasPrincipales) > 0) {
                foreach ($alianzasPrincipales as $ap => $datoAlianza) {
                    $alianzasPrincipales[$ap]['nombreAlianza'] = html_entity_decode($alianzasPrincipales[$ap]['nombreAlianza']);
                }
            }


            if (count($alianzasSecundarias) > 0) {
                foreach ($alianzasSecundarias as $as => $datoAlianza) {
                    $alianzasSecundarias[$as]['nombreAlianza'] = html_entity_decode($alianzasSecundarias[$as]['nombreAlianza']);
                }
            }

            $dataArray = array(
                'alianzasPrincipales' => $alianzasPrincipales,
                'alianzasSecundarias' => $alianzasSecundarias
            );

            echo json_encode($dataArray);

            break;
        case 'listadoSecretariado':

            require_once '../../php/funciones/funcionesSecretariado.php';
            $dataArray = listadoSecretariado(); //array con todos los miembros del secretariado

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['textoSecretariado'] = html_entity_decode($dataArray[$da]['textoSecretariado']);
                $dataArray[$da]['nombreSecretariado'] = html_entity_decode($dataArray[$da]['nombreSecretariado']);
                $dataArray[$da]['cargoSecretariado'] = html_entity_decode($dataArray[$da]['cargoSecretariado']);
            }

            echo json_encode($dataArray);

            break;
        case 'listadoMiembros':

            require_once '../../php/funciones/funcionesMiembro.php';
            if (isset($_GET['idPais']) && ($_GET['idPais'] != "")) {
                $dataArray = obtenerMiembrosPorIdPais(sanearDatos($_GET['idPais']));
            } else {
                $dataArray = obtenerMiembros();
            }

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['nombreMiembro'] = html_entity_decode($dataArray[$da]['nombreMiembro']);
                $dataArray[$da]['representanteMiembro'] = html_entity_decode($dataArray[$da]['representanteMiembro']);
            }

            echo json_encode($dataArray);

            break;
        case 'listadoReportes':

            require_once '../../php/funciones/funcionesReporteAnual.php';
            $dataArray = obtenerReportes(); //array con todos los miembros del secretariado

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloReporteAnual'] = html_entity_decode($dataArray[$da]['tituloReporteAnual']);
                $dataArray[$da]['fechaManualReporteAnual'] = str_replace("-", "/", cambiarFecha($dataArray[$da]['fechaManualReporteAnual']));
            }

            echo json_encode($dataArray);

            break;
        case 'eliminarImagenSecretariado':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones.php';
            require_once '../../php/funcionesPhp.php';
            require_once '../../php/funciones/funcionesSecretariado.php';
            $result = eliminarImagen($_POST['id']);
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar la imagen.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenMiembro':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesMiembro.php';
            $result = realizarBajaLogoMiembro(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar la imagen.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenReporteAnual':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesReporteAnual.php';
            $result = realizarBajaArchivoReporteAnual(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar la imagen.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenAlianza':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesAlianza.php';
            $result = realizarBajaArchivoAlianza(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar la imagen.'
            );
            echo json_encode($data);
            break;
        default :
            die("default");
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
