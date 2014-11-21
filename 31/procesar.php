<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=iso-8859-1'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');

if (isset($_SESSION['titulo']) && isset($_SESSION['autor'])) {
	$conn->set_charset('utf8');
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

$conn->set_charset('latin1');
mostrar();

echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Introducir nuevo libro</a></p>';
echo utf8_decode("<p><a href=\"index.php\">Volver atrás</a></p>");

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

function mostrar() {
	global $conn;

	$select = "SELECT titulo, autor FROM libros";
	$result = $conn->query($select);
	if ($result->num_rows > 0) {
		echo "<table>\n";
		echo "\t<tr>\n";
		echo "\t\t<th>" . utf8_decode("Título") . "</th>\n";
		echo "\t\t<th>Autor</th>\n";
		echo "\t<tr>\n";
		while ($row = $result->fetch_row()) {
			echo "\t<tr>\n";
			echo "\t\t<td>$row[0]</td>\n";
			echo "\t\t<td>$row[1]</td>\n";
			echo "\t</tr>\n";
		}
		echo "</table>\n";
	}
	$result->close();
}
?>
</hody>
</html>