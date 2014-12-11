<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');
require_once('clases.php');
require_once('funciones_bd.php');

var_dump($_POST);

$select = '';

$generos = cargar_generos();

if (isset($_POST['genero'])) {
	$select .= 'WHERE genero IN (';
	while ($row = $generos->fetch_row()) {
		if (isset($_POST['genero'][$row[0]])) {
			$select .= '\'' . $row[1] . '\', ';
		}
	}
	$select = rtrim($select, ', ') . ')';
}
if (isset($_POST['anyo_min']) && isset($_POST['anyo_max'])) {
	$select .= ($select ? ' AND ' : 'WHERE ');
	$select .= 'anyo >= ' . $_POST['anyo_min'];
	$select .= ' AND anyo <= ' . $_POST['anyo_max'];
}
if (isset($_POST['protagonista']) && !empty($_POST['protagonista'])) {
	$select .= ($select ? ' AND ' : 'WHERE ');
	$select .= 'protagonista = \'' . $_POST['protagonista'] . '\'';
}
if (isset($_POST['director']) && !empty($_POST['director'])) {
	$select .= ($select ? ' AND ' : 'WHERE ');
	$select .= 'director = \'' . $_POST['director'] . '\'';
}
if (isset($_POST['orden'][0])) {
	$select .= ' ORDER BY ' . $_POST['orden'][0];
	if (isset($_POST['orden'][1])) {
		$select .= ' ' . $_POST['orden'][1];
	}
}

echo '"' . $select . '"';

formulario();

echo '<p><a href="index.php">Volver atrás</a></p>';

function formulario() {
	$anyo_actual = date('Y');
	$generos = cargar_generos();

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Géneros:</td>
					<td>';

	while ($row = $generos->fetch_row()) {
		echo '<input type="checkbox" name="genero[' . $row[0] . ']" value="true"' . (isset($_POST['genero'][$row[0]]) ? ' checked' : '') . '>' . ucfirst($row[1]) . '<br>';
	}

	echo '
					</td>
				</tr>
				<tr>
					<td>Años:</td>
					<td>
						desde <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_min" value="' . (isset($_POST['anyo_min']) ? $_POST['anyo_min'] : 2014) . '" />
						 hasta <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_max" value="' . (isset($_POST['anyo_max']) ? $_POST['anyo_max'] : 2014) . '" />
					</td>
				</tr>
				<tr>
					<td>Actor principal:</td>
					<td><input type="text" name="protagonista" value="' . (isset($_POST['protagonista']) ? $_POST['protagonista'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Director:</td>
					<td><input type="text" name="director" value="' . (isset($_POST['director']) ? $_POST['director'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Ordenar por:</td>
					<td>
						<input type="radio" name="orden[0]" value="titulo">Título<br>
						<input type="radio" name="orden[0]" value="genero">Género<br>
						<input type="radio" name="orden[0]" value="anyo">Año<br>
						<input type="radio" name="orden[0]" value="protagonista">Protagonista<br>
						<input type="radio" name="orden[0]" value="director">Director
					</td>
				</tr>
				<tr>
					<td>Orden:</td>
					<td>
						<input type="radio" name="orden[1]" value="ASC">Ascendente (a-z, 0-9)<br>
						<input type="radio" name="orden[1]" value="DESC">Descendente (z-a, 9-0)
					</td>
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
?>
</body>
</html>
