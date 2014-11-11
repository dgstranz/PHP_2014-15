<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

include_once 'movie_settings.php';

$error = '';
$archivo_destino = '';

if (!isset($_POST['titulo'])) {
	if (isset($_FILES['cartel'])) {
		echo '<b>Error</b>: Debe indicarse un título.<br>';
	}

	formulario();
} elseif (!isset($_FILES['cartel'])) {
	echo '<b>Error</b>: Debe incluirse un cartel.<br>';

	formulario();
} else {
	$archivo_destino = IMG_FOLDER . basename($_FILES['cartel']['name']);
	echo $archivo_destino;

	if (!es_imagen($_FILES['cartel'])) {
		echo $error;

		formulario();
	} elseif (!move_uploaded_file($_FILES['cartel']['tmp_name'], $archivo_destino)) {
		echo 'Ha habido un error al tratar de subir el archivo.<br>';
	} else {
		echo 'El archivo se ha subido correctamente.<br>';
		array_push($movies, new Movie($_POST['titulo'], basename($_FILES['cartel']['name'])));
		var_dump($movies);
	}
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" enctype="multipart/form-data">';
	echo '<table>';
	echo '	<tr>';
	echo '		<td>Título:</td>';
	echo '		<td><input type="text" name="titulo"></td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td>Cartel:</td>';
	echo '		<td><input type="file" name="cartel"></td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td colspan="2"><input type="submit" value="Enviar"></td>';
	echo '	</tr>';
	echo '</table>';
	echo '</form>';
}

function es_imagen($archivo) {
	global $error;
	global $archivo_destino;

	var_dump($archivo);

	if (!isset($archivo['tmp_name']) || !isset($archivo['size'])) {
		$error = '<b>Error</b>: No se ha subido ninguna imagen.<br>';
		return false;
	}

	$params = getimagesize($archivo['tmp_name']);
	if ($params === false) {
		$error = '<b>Error</b>: El archivo subido no es una imagen.<br>';
		return false;
	}

	if ($archivo['size'] > MAX_SIZE) {
		$error = '<b>Error</b>: La imagen es demasiado grande. Por favor, vuelve a tratar de subir una imagen de no más de ' . MAX_SIZE . ' bytes.';
		return false;
	}

	$extension = pathinfo($archivo_destino, PATHINFO_EXTENSION);
	if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
		$error = '<b>Error</b>: Solo se pueden subir archivos JPG, JPEG, PNG y GIF.<br>';
		return false;
	}

	if (file_exists($archivo_destino)) {
		$error = '<b>Error</b>: El archivo ya existe.<br>';
		return false;
	}

	return true;
}

?>
</body>
</html>