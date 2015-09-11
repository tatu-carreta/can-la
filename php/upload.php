<?php
$mock = false;
$section = 'sobrecanla'; //si no hay seccion por defecto se subirá en sobrecanla

if(isset($_GET['section']))
{
	$section = $_GET['section']; //si hay seccion la reemplaza
}
$imageDirectory = "../images/".$section."/";


foreach($_FILES as $file)
{
        $type = $file['type'];
        $extension = explode('/', $type);
        $nameWithNoExt = explode('.', $file['name']);
        $randName = $nameWithNoExt[0].mt_rand(10000,99999);
        $filename = basename($randName, ".".$extension[1]);

        $filename = preg_replace("/[^A-Za-z0-9_-]/", "", $filename) .  ".".$extension[1];

        $tmp_name = $file['tmp_name'];
    	$name = $file["name"];

    if(!$mock)
    {

		if (move_uploaded_file($tmp_name, $imageDirectory . $filename))
		{
			$texto = "El archivo se ha subido correctamente.";
			$estadoAgregacion = true;
			$imagen =  $filename;
		}
		else
		{
			$texto = "Ha habido un error en la carga del archivo.";
			$estadoAgregacion = false;
			$imagen = null;
		}
	}
	else
	{
		$texto = "El sistema está en modo de prueba";
		$estadoAgregacion = true;
		$imagen = "imagen_vacía.jpg";
	}	
}

$data = array(
    'estado' => $estadoAgregacion,
    'texto' => $texto,
    'imagen' => $imagen
);

echo json_encode($data);
?>