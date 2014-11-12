<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

include_once 'movie_settings.php';

$error = '';
$archivo_destino = '';

if (!isset($_POST['submitted'])) {
	formulario();
} elseif (!isset($_POST['titulo']) || empty($_POST['titulo'])) {
	echo '<b>Error</b>: Debe indicarse un título';

	if (!isset($_FILES['cartel']) || empty($_FILES['cartel']['name'])) {
		echo ' e incluirse un cartel';
	}

	echo '.<br>';

	formulario();
} elseif (!isset($_FILES['cartel']) || empty($_FILES['cartel']['name'])) {
	echo '<b>Error</b>: Debe incluirse un cartel.<br>';

	formulario();
} else {
	$archivo_destino = IMG_FOLDER . basename($_FILES['cartel']['name']);

	if (!es_imagen($_FILES['cartel'])) {
		echo $error;

		formulario();
	} elseif (!move_uploaded_file($_FILES['cartel']['tmp_name'], $archivo_destino)) {
		echo 'Ha habido un error al tratar de subir el archivo.<br>';

		formulario();
	} else {
		echo 'El archivo se ha subido correctamente.<br>';
		$movie_entry = array($_POST['titulo'], basename($_FILES['cartel']['name']));
		add_movie($movie_entry);
	}
}

echo '<p><a href="movies.php">Ver cartelera</a></p>';

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" enctype="multipart/form-data">';
	echo '<input type="hidden" name="submitted" value="true">';
	echo '<table>';
	echo '	<tr>';
	echo '		<td>Título:</td>';
	echo '		<td><input type="text" name="titulo"' . ((isset($_POST['titulo']) && !empty($_POST['titulo'])) ? ' value="' . $_POST['titulo'] . '"' : '') . '></td>';
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