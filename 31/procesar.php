<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');

if (isset($_SESSION['titulo']) && isset($_SESSION['autor'])) {
	if (!$conn->set_charset('utf8')) {
		echo 'Error al tratar de cargar el conjunto de caracteres UTF-8: ' . $conn->error;
	}
	if (existe()) {
		echo 'El libro "' . $_SESSION['titulo'] . '" del autor ' . $_SESSION['autor']
			. ' ya existe en la base de datos.';
	} elseif (!insertar()) {
		echo 'Error al tratar de introducir el libro en la base de datos: ' . $conn->error;
	} else {
		echo 'Libro introducido correctamente.';
	}

	unset($_SESSION['titulo']);
	unset($_SESSION['autor']);
}

echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Introducir nuevo libro</a></p>';
echo '<p><a href="index.php">Volver atrás</a></p>';

function existe() {
	global $conn;

	$search = "SELECT * FROM libros
		WHERE titulo = '" . $_SESSION['titulo'] . "'
		AND autor = '" . $_SESSION['autor'] . "'";
	$result = $conn->query($search);
	return ($result->num_rows > 0);
}

function insertar() {
	global $conn;

	$insert = "INSERT INTO libros (titulo, autor)
				VALUES ('" . $_SESSION['titulo'] . "','" . $_SESSION['autor'] . "')";
	return ($conn->query($insert));
}
?>
</hody>
</html>