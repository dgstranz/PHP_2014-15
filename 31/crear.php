<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
require_once('bd.php');

if (!isset($_POST['titulo']) || !isset($_POST['autor'])) {
	formulario();
} elseif (empty($_POST['titulo']) || empty($_POST['autor'])) {
	echo '<b>Error</b>: Los campos no pueden estar vacíos.';
	formulario();
} else {
	if (!$conn->set_charset('utf8')) {
		printf("Error cargando el conjunto de caracteres UTF-8: %s\n", $conn->error);
	}
	if (existe()) {
		echo 'El libro "' . $_POST['titulo'] . '" del autor ' . $_POST['autor']
			. ' ya existe en la base de datos.';
	} elseif (!insertar()) {
		echo 'Error al tratar de introducir el libro en la base de datos: ' . $conn->error;
	} else {
		echo 'Libro introducido correctamente.';
	}
	echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Introducir nuevo libro</a></p>';
}

echo '<p><a href="index.php">Volver atrás</a></p>';

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Título:</td>
					<td><input type="text" name="titulo" value="' . (isset($_POST['titulo']) ? $_POST['titulo'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Autor:</td>
					<td><input type="text" name="autor" value="' . (isset($_POST['autor']) ? $_POST['autor'] : '') . '" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Enviar" />
						<input type="reset" value="Borrar" />
					</td>
				</tr>
			</table>
		</form>';
}

function existe() {
	global $conn;

	$search = "SELECT * FROM libros
		WHERE titulo = '" . $_POST['titulo'] . "'
		AND autor = '" . $_POST['autor'] . "'";
	$result = $conn->query($search);
	return ($result->num_rows > 0);
}

function insertar() {
	global $conn;

	$insert = "INSERT INTO libros (titulo, autor)
				VALUES ('" . $_POST['titulo'] . "','" . $_POST['autor'] . "')";
	return ($conn->query($insert));
}
?>
</hody>
</html>