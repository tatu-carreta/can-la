<?php
	require_once 'configWebData.php';
	require_once 'funciones.php';
	require_once 'funcionesPhp.php';


	$indices = array();
	$carpeta = $_GET['carpeta'];
	foreach ($_POST as $index => $id) {

		if ($id != "," )
		{
			array_push($indices, $id);
			
		}
	}
	foreach ($indices as $index => $id) {
		actualizarOrden($index, $id, $carpeta);
	}
?>