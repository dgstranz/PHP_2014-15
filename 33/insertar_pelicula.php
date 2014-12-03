<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');
require_once('clases.php');

var_dump($_POST);

if (!isset($_POST['titulo']) || !isset($_POST['genero']) || !isset($_POST['anyo']) || !isset($_POST['protagonista']) || !isset($_POST['director'])) {
	formulario();
} elseif (empty($_POST['titulo']) || empty($_POST['genero']) || empty($_POST['anyo']) || empty($_POST['protagonista']) || empty($_POST['director'])) {
	echo '<b>Error</b>: Los campos no pueden estar vacíos.';
	formulario();/*
} elseif (buscar_pelicula($_POST['titulo'])) {
	echo '<b>Error</b>: Esta película ya existe en la base de datos.';*/
} else {
	echo $_POST['protagonista'];
	$bd_protagonista = buscar_persona($_POST['protagonista']);
	if (!$bd_protagonista) {
		$mi_protagonista = new Persona($_POST['protagonista'], true, false);
		var_dump($mi_protagonista);

		insertar_persona($mi_protagonista);

		$bd_protagonista = buscar_persona($_POST['protagonista']);
	} elseif ($bd_protagonista['actor'] === 0) {
		hacer_actor($bd_protagonista['id']);
	}


	$bd_director = buscar_persona($_POST['director']);
	if (!$bd_director) {
		$mi_director = new Persona($_POST['director'], false, true);

		insertar_persona($mi_director);
		
		$bd_director = buscar_persona($_POST['director']);
	} elseif ($bd_director['director'] === 0) {
		hacer_director($bd_director['id']);
	}

	$mi_peli = new Pelicula($_POST['titulo'], $_POST['genero'], $_POST['anyo'], $bd_protagonista['id'], $bd_director['id']);
	echo $mi_peli->titulo;

	insertar_pelicula($mi_peli);
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
}

function cargar_generos() {
	global $conn;

	$search = "SELECT id, genero FROM generos
		ORDER BY genero";
	$result = $conn->query($search);

	return $result;
}

function insertar_pelicula($pelicula) {
	global $conn;

	$insert = "INSERT INTO peliculas (titulo, genero, anyo, protagonista, director)
				VALUES ('" . $pelicula->titulo . "','"
						. $pelicula->genero . "','"
						. $pelicula->anyo . "','"
						. $pelicula->protagonista . "','"
						. $pelicula->director . "')";
	return ($conn->query($insert));
}

function insertar_persona($persona) {
	global $conn;

	$insert = "INSERT INTO personas (nombre, esActor, esDirector)
				VALUES ('" . $persona->nombre . "','"
						. $persona->esActor . "','"
						. $persona->esDirector . "')";
	return ($conn->query($insert));
}

function buscar_pelicula($titulo) {
	global $conn;

	$select = "SELECT * FROM peliculas
				WHERE titulo = '" . $titulo . "'";
	$result = $conn->query($select);
	$fila = $result->fetch_assoc();
	var_dump($result);
	var_dump($fila);
	return ($fila);
}

function buscar_persona($nombre) {
	global $conn;

	$select = "SELECT * FROM personas
				WHERE nombre = '" . $nombre . "'";
	$result = $conn->query($select);
	$fila = $result->fetch_assoc();
	var_dump($result);
	var_dump($fila);
	return ($fila);
}

?>
</hody>
</html>