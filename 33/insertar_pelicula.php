<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');

var_dump($_POST);

if (!isset($_POST['titulo']) || !isset($_POST['genero']) || !isset($_POST['anyo']) || !isset($_POST['protagonista']) || !isset($_POST['director'])) {
	formulario();
} elseif (empty($_POST['titulo']) || empty($_POST['genero']) || empty($_POST['anyo']) || empty($_POST['protagonista']) || empty($_POST['director'])) {
	echo '<b>Error</b>: Los campos no pueden estar vacíos.';
	formulario();
} else {
	$_SESSION['titulo'] = $_POST['titulo'];
	$_SESSION['genero'] = $_POST['genero'];
	$_SESSION['anyo'] = $_POST['anyo'];
	$_SESSION['protagonista'] = $_POST['protagonista'];
	$_SESSION['director'] = $_POST['director'];
	header('Location: procesar.php');
}

echo '<p><a href="index.php">Volver atrás</a></p>';

function formulario() {
	$anyo_actual = date('Y');
	$generos = cargar_generos();

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Título:</td>
					<td><input type="text" name="titulo" value="' . (isset($_POST['titulo']) ? $_POST['titulo'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Género:</td>
					<td>
						<select name="genero">
							<option value="">Elige un género</option>
							<option value="">······················</option>';

	while ($row = $generos->fetch_row()) {
		echo '<option value="' . $row[0] . '"' . (isset($_POST['genero']) && (strval($_POST['genero']) == strval($row[0])) ? ' selected' : '') . '>' . ucfirst(utf8_encode($row[1])) . '</option>';
	}

	echo '				</select>
				</td>
				</tr>
				<tr>
					<td>Año:</td>
					<td><input type="number" min="1890" max="' . $anyo_actual . '" name="anyo" value="' . (isset($_POST['anyo']) ? $_POST['anyo'] : 2014) . '" /></td>
				</tr>
				<tr>
					<td>Actor principal:</td>
					<td><input type="text" name="protagonista" value="' . (isset($_POST['protagonista']) ? $_POST['protagonista'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Director</td>
					<td><input type="text" name="director" value="' . (isset($_POST['director']) ? $_POST['director'] : '') . '" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Enviar" />
						<input type="reset" value="Borrar" />
					</td>
				</tr>
			</table>
		</form>';
	cargar_generos();
}

function cargar_generos() {
	global $conn;

	$search = "SELECT id, genero FROM generos
		ORDER BY genero";
	$result = $conn->query($search);

	return $result;
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