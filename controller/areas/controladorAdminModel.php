<?php

require_once '../../php/configWebData.php';
require_once '../../php/funciones.php';
require_once '../../php/funcionesPhp.php';
require_once '../../php/security/security.php';

if (isset($_POST['section']) && is_string($_POST['section'])) {
    $seccion = sanearDatos($_POST['section']);

    switch ($seccion) {
        case 'agregarArea':
            require_once '../../admin/areas/agregarArea.php';
            break;
        case 'modificarArea':
            require_once '../../admin/areas/modificarArea.php';
            break;
        case 'borrarArea':
            require_once '../../admin/areas/borrarArea.php';
            break;
        case 'borrarArchivoArea':
            require_once '../../admin/areas/borrarArchivoArea.php';
            break;
        case 'listadoAreas':
            require_once '../../php/funciones/funcionesArea.php';
            $areas = obtenerAreas();
            echo json_encode($areas);
            break;
        case 'actualizarOrdenAreas':
            require_once '../../php/funciones/funcionesArea.php';
            $areas = obtenerAreas();
            echo json_encode($areas);
            break;
        case 'verMasArea':
            require_once '../../php/funciones/funcionesArea.php';
            require_once '../../php/funciones/funcionesNoticia.php';
            require_once '../../php/funciones/funcionesNotaPrensa.php';
            require_once '../../php/funciones/funcionesPosicion.php';
            require_once '../../php/funciones/funcionesPublicacionCanla.php';

            $noticias = obtenerNoticiasPorIdAreaLimitado(sanearDatos($_POST['idArea']), 1, 13);
            $notas = obtenerNotasPrensaPorIdAreaLimitado(sanearDatos($_POST['idArea']), 1, 13);
            $posiciones = obtenerPosicionesPorIdAreaLimitado(sanearDatos($_POST['idArea']), 1, 13);
            $publicaciones = obtenerPublicacionesPorIdAreaLimitado(sanearDatos($_POST['idArea']), 1, 13);


            if (count($noticias) > 0) {
                foreach ($noticias as $n => $datoNoticia) {
                    $noticias[$n]['tituloNoticia'] = html_entity_decode($noticias[$n]['tituloNoticia']);
                    $noticias[$n]['descripcionNoticia'] = html_entity_decode($noticias[$n]['descripcionNoticia']);
                    $noticias[$n]['cuerpoNoticia'] = html_entity_decode($noticias[$n]['cuerpoNoticia']);
                    $noticias[$n]['fechaNoticia'] = str_replace("-", "/", cambiarFecha($noticias[$n]['fechaNoticia']));
                    $noticias[$n]['etiquetas'] = obtenerEtiquetasPorIdNoticia($datoNoticia['idNoticia']);
                }
            }
            if (count($notas) > 0) {
                foreach ($notas as $np => $datoNotaPrensa) {
                    $notas[$np]['tituloNotaPrensa'] = html_entity_decode($notas[$np]['tituloNotaPrensa']);
                    $notas[$np]['descripcionNotaPrensa'] = html_entity_decode($notas[$np]['descripcionNotaPrensa']);
                    $notas[$np]['cuerpoNotaPrensa'] = html_entity_decode($notas[$np]['cuerpoNotaPrensa']);
                    $notas[$np]['fechaNotaPrensa'] = str_replace("-", "/", cambiarFecha($notas[$np]['fechaNotaPrensa']));
                    $notas[$np]['etiquetas'] = obtenerEtiquetasPorIdNotaPrensa($datoNotaPrensa['idNotaPrensa']);
                }
            }
            if (count($posiciones) > 0) {
                foreach ($posiciones as $p => $datoPosicion) {
                    $posiciones[$p]['tituloPosicion'] = html_entity_decode($posiciones[$p]['tituloPosicion']);
                    $posiciones[$p]['etiquetas'] = obtenerEtiquetasPorIdPosicion($datoPosicion['idPosicion']);
                }
            }
            if (count($publicaciones) > 0) {
                foreach ($publicaciones as $pu => $datoPublicacionCanla) {
                    $publicaciones[$pu]['etiquetas'] = obtenerEtiquetasPorIdPublicacionCanla($datoPublicacionCanla['idPublicacionCanla']);
                }
            }

            $dataArray = array(
                'noticias' => $noticias,
                'notas' => $notas,
                'posiciones' => $posiciones,
                'publicaciones' => $publicaciones,
            );

            echo json_encode($dataArray);
            break;
        case 'eliminarImagenArea':
            require_once '../../php/funciones/funcionesArea.php';
            $result = realizarBajaArchivoArea(sanearDatos($_POST['id']));
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
