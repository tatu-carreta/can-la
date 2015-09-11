<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);


    switch ($seccion) {
        case 'agregarBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarBoletin.php';
            break;
        case 'agregarEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarEcoEspanol.php';
            break;
        case 'agregarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarEvento.php';
            break;
        case 'agregarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarNotaPrensa.php';
            break;
        case 'agregarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarNoticia.php';
            break;
        case 'agregarVideo':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarVideo.php';
            break;
        case 'agregarFotos':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarFotos.php';
            break;
        case 'agregarArchivos':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarArchivos.php';
            break;
        case 'agregarPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/agregarPosicion.php';
            break;
        case 'destacarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/destacarNoticia.php';
            break;
        case 'destacarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/destacarEvento.php';
            break;
        case 'destacarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/destacarNotaPrensa.php';
            break;
        case 'modificarBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarBoletin.php';
            break;
        case 'quitarDestacadoNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            require_once '../../php/funciones/funcionesNoticia.php';
            $idNoticia = sanearDatos($_POST['id']);
            $estado = quitarDestacadoNoticia($idNoticia);
            break;
        case 'quitarDestacadoEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            require_once '../../php/funciones/funcionesEvento.php';
            $idEvento = sanearDatos($_POST['id']);
            $estado = quitarDestacadoEvento($idEvento);
            break;
        case 'quitarDestacadoNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);
            require_once '../../php/funciones/funcionesNotaPrensa.php';
            $idEvento = sanearDatos($_POST['id']);
            $estado = quitarDestacadoNotaPrensa($idEvento);
            break;
        case 'modificarEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarEcoEspanol.php';
            break;
        case 'modificarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarEvento.php';
            break;
        case 'modificarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarNotaPrensa.php';
            break;
        case 'modificarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarNoticia.php';
            break;
        case 'modificarPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/modificarPosicion.php';
            break;
        case 'borrarVideo':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarVideo.php';
            break;
        case 'borrarImagen':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarImagen.php';
            break;
        case 'borrarArchivoEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarArchivoEvento.php';
            break;
        case 'borrarBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarBoletin.php';
            break;
        case 'borrarEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarEcoEspanol.php';
            break;
        case 'borrarEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarEvento.php';
            break;
        case 'borrarNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarNotaPrensa.php';
            break;
        case 'borrarNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarNoticia.php';
            break;
        case 'borrarPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarPosicion.php';
            break;
        case 'borrarArchivoBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarArchivoBoletin.php';
            break;
        case 'borrarArchivoEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../admin/comunicaciones/borrarArchivoEcoEspanol.php';
            break;
        case 'listadoPosiciones':

            require_once '../../php/funciones/funcionesPosicion.php';
            $dataArray = obtenerPosiciones();

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloPosicion'] = html_entity_decode($dataArray[$da]['tituloPosicion']);
            }

            echo json_encode($dataArray);

            break;
        case 'listadoNoticias':

            require_once '../../php/funciones/funcionesNoticia.php';
            $noticias = obtenerNoticias();
            $noticiasDestacadas = obtenerNoticiasSlide();

            if (count($noticias) > 0) {
                foreach ($noticias as $da => $key) {
                    $noticias[$da]['tituloNoticia'] = html_entity_decode($noticias[$da]['tituloNoticia']);
                    $noticias[$da]['fuenteNoticia'] = html_entity_decode($noticias[$da]['fuenteNoticia']);
                    $noticias[$da]['descripcionNoticia'] = html_entity_decode($noticias[$da]['descripcionNoticia']);
                    $noticias[$da]['cuerpoNoticia'] = html_entity_decode($noticias[$da]['cuerpoNoticia']);
                    $noticias[$da]['fechaNoticia'] = str_replace("-", "/", cambiarFecha($noticias[$da]['fechaNoticia']));
                }
            }

            if (count($noticiasDestacadas) > 0) {
                foreach ($noticiasDestacadas as $da => $key) {
                    $noticiasDestacadas[$da]['tituloNoticia'] = html_entity_decode($noticiasDestacadas[$da]['tituloNoticia']);
                    $noticiasDestacadas[$da]['fuenteNoticia'] = html_entity_decode($noticiasDestacadas[$da]['fuenteNoticia']);
                    $noticiasDestacadas[$da]['descripcionNoticia'] = html_entity_decode($noticiasDestacadas[$da]['descripcionNoticia']);
                    $noticiasDestacadas[$da]['fechaNoticia'] = str_replace("-", "/", cambiarFecha($noticiasDestacadas[$da]['fechaNoticia']));
                }
            }

            $dataArray = array(
                'noticias' => $noticias,
                'noticiasDestacadas' => $noticiasDestacadas
            );

            echo json_encode($dataArray);

            break;
        case 'listadoNotaPrensa':

            require_once '../../php/funciones/funcionesNotaPrensa.php';
            $notas = obtenerNotasPrensa();
            $notasDestacadas = obtenerNotasSlide();

            if (count($notas) > 0) {
                foreach ($notas as $da => $key) {
                    $notas[$da]['tituloNotaPrensa'] = html_entity_decode($notas[$da]['tituloNotaPrensa']);
                    $notas[$da]['descripcionNotaPrensa'] = html_entity_decode($notas[$da]['descripcionNotaPrensa']);
                    $notas[$da]['cuerpoNotaPrensa'] = html_entity_decode($notas[$da]['cuerpoNotaPrensa']);
                    $notas[$da]['fechaNotaPrensa'] = str_replace("-", "/", cambiarFecha($notas[$da]['fechaNotaPrensa']));
                }
            }

            if (count($notasDestacadas) > 0) {
                foreach ($notasDestacadas as $da => $key) {
                    $notasDestacadas[$da]['tituloNotaPrensa'] = html_entity_decode($notasDestacadas[$da]['tituloNotaPrensa']);
                    $notasDestacadas[$da]['descripcionNotaPrensa'] = html_entity_decode($notasDestacadas[$da]['descripcionNotaPrensa']);
                    $notasDestacadas[$da]['fechaNotaPrensa'] = str_replace("-", "/", cambiarFecha($notasDestacadas[$da]['fechaNotaPrensa']));
                }
            }

            $dataArray = array(
                'notas' => $notas,
                'notasDestacadas' => $notasDestacadas
            );

            echo json_encode($dataArray);

            break;
        case 'listadoEventos':

            require_once '../../php/funciones/funcionesEvento.php';
            $eventos = obtenerEventos();
            $eventosDestacados = obtenerEventosSlide();

            if (count($eventos) > 0) {
                foreach ($eventos as $da => $key) {
                    $eventos[$da]['tituloEvento'] = html_entity_decode($eventos[$da]['tituloEvento']);
                    $eventos[$da]['descripcionEvento'] = html_entity_decode($eventos[$da]['descripcionEvento']);
                    $eventos[$da]['cuerpoEvento'] = html_entity_decode($eventos[$da]['cuerpoEvento']);
                    $eventos[$da]['fechaInicioEvento'] = str_replace("-", "/", cambiarFecha($eventos[$da]['fechaInicioEvento']));
                    $eventos[$da]['fechaFinEvento'] = str_replace("-", "/", cambiarFecha($eventos[$da]['fechaFinEvento']));
                }
            }

            if (count($eventosDestacados) > 0) {
                foreach ($eventosDestacados as $da => $key) {
                    $eventosDestacados[$da]['tituloEvento'] = html_entity_decode($eventosDestacados[$da]['tituloEvento']);
                    $eventosDestacados[$da]['descripcionEvento'] = html_entity_decode($eventosDestacados[$da]['descripcionEvento']);
                    $eventosDestacados[$da]['fechaInicioEvento'] = str_replace("-", "/", cambiarFecha($eventosDestacados[$da]['fechaInicioEvento']));
                }
            }

            $dataArray = array(
                'eventos' => $eventos,
                'eventosDestacados' => $eventosDestacados
            );

            echo json_encode($dataArray);

            break;
        case 'listadoBoletin':

            require_once '../../php/funciones/funcionesBoletin.php';
            $dataArray = obtenerBoletines();

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloBoletin'] = html_entity_decode($dataArray[$da]['tituloBoletin']);
            }

            echo json_encode($dataArray);

            break;
        case 'listadoEco':

            require_once '../../php/funciones/funcionesEco.php';
            $dataArray = obtenerEcos();

            foreach ($dataArray as $da => $key) {
                $dataArray[$da]['tituloEco'] = html_entity_decode($dataArray[$da]['tituloEco']);
            }

            echo json_encode($dataArray);

            break;
        case 'etiquetasPosicion':
            require_once '../../php/funciones/funcionesPosicion.php';
            $dataArray = obtenerEtiquetasPorIdPosicion($_POST['id']);
            echo json_encode($dataArray);

            break;
        case 'etiquetasNoticia':
            require_once '../../php/funciones/funcionesNoticia.php';
            $dataArray = obtenerEtiquetasPorIdNoticia($_POST['id']);
            echo json_encode($dataArray);

            break;
        case 'etiquetasNotaPrensa':
            require_once '../../php/funciones/funcionesNotaPrensa.php';
            $dataArray = obtenerEtiquetasPorIdNotaPrensa($_POST['id']);
            echo json_encode($dataArray);

            break;
        case 'eliminarArchivoPosicion':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones.php';
            require_once '../../php/funcionesPhp.php';
            require_once '../../php/funciones/funcionesPosicion.php';
            $result = eliminarArchivo($_POST['id']);
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        case 'eliminarArchivoBoletin':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesBoletin.php';
            $result = realizarBajaArchivoBoletin(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        case 'eliminarArchivoEco':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesEco.php';
            $result = realizarBajaArchivoEco(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenEvento':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesEvento.php';
            $result = realizarBajaArchivoEvento(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenNotaPrensa':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesNotaPrensa.php';
            $result = realizarBajaArchivoNotaPrensa(sanearDatos($_POST['id']));
            $data = array(
                'estado' => $result,
                'texto' => 'No se ha podido eliminar el archivo.'
            );
            echo json_encode($data);
            break;
        case 'eliminarImagenNoticia':
            permisoLogueado($localhost);
            $permisos = array(1);
            permisoRol($permisos, $localhost);

            require_once '../../php/funciones/funcionesNoticia.php';
            $result = realizarBajaArchivoNoticia(sanearDatos($_POST['id']));
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
