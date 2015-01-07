<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');
require_once('clases.php');
require_once('funciones_bd.php');

if (!isset($_POST['titulo']) || !isset($_POST['genero']) || !isset($_POST['anyo']) || !isset($_POST['protagonista']) || !isset($_POST['director'])) {
	formulario();
} elseif (empty($_POST['titulo']) || empty($_POST['genero']) || empty($_POST['anyo']) || empty($_POST['protagonista']) || empty($_POST['director'])) {
	echo $mensajes['form']['Error'] . $mensajes['insertar_pelicula']['Error campos vacíos'];
	formulario();
} elseif (buscar_pelicula($_POST['titulo'])) {
	echo $mensajes['form']['Error'] . $mensajes['insertar_pelicula']['Error película ya existe'];
} else {
	$bd_protagonista = buscar_persona($_POST['protagonista']);
	if (!$bd_protagonista) {
		$mi_protagonista = new Persona($_POST['protagonista'], true, false);

		insertar_persona($mi_protagonista);

		$bd_protagonista = buscar_persona($_POST['protagonista']);
	} elseif ($bd_protagonista['esActor'] == 0) {
		modificar_profesion($bd_protagonista['id'], 'esActor', true);
	}


	$bd_director = buscar_persona($_POST['director']);
	if (!$bd_director) {
		$mi_director = new Persona($_POST['director'], false, true);

		insertar_persona($mi_director);

		$bd_director = buscar_persona($_POST['director']);
	} elseif ($bd_director['esDirector'] == 0) {
		modificar_profesion($bd_director['id'], 'esDirector', true);
	}

	$mi_peli = new Pelicula($_POST['titulo'], $_POST['genero'], $_POST['anyo'], $bd_protagonista['id'], $bd_director['id']);

	insertar_pelicula($mi_peli);
}

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function formulario() {
	global $mensajes;
	$anyo_actual = date('Y');
	$generos = cargar_generos();

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>' . $mensajes['insertar_pelicula']['Título'] . '</td>
					<td><input type="text" name="titulo" value="' . (isset($_POST['titulo']) ? $_POST['titulo'] : '') . '" /></td>
				</tr>
				<tr>
					<td>' . $mensajes['insertar_pelicula']['Género'] . '</td>
					<td>
						<select name="genero">
							<option value="">' . $mensajes['insertar_pelicula']['Elige género'] . '</option>
							<option value="">----------------------</option>';

	while ($row = $generos->fetch_row()) {
		echo '<option value="' . $row[0] . '"' . (isset($_POST['genero']) && (strval($_POST['genero']) == strval($row[0])) ? ' selected' : '') . '>' . ucfirst($row[1]) . '</option>';
	}

	echo '				</select>
				</td>
				</tr>
				<tr>
					<td>' . $mensajes['insertar_pelicula']['Año'] . '</td>
					<td><input type="number" min="1890" max="' . $anyo_actual . '" name="anyo" value="' . (isset($_POST['anyo']) ? $_POST['anyo'] : $anyo_actual) . '" /></td>
				</tr>
				<tr>
					<td>' . $mensajes['insertar_pelicula']['Protagonista'] . '</td>
					<td><input type="text" name="protagonista" value="' . (isset($_POST['protagonista']) ? $_POST['protagonista'] : '') . '" /></td>
				</tr>
				<tr>
					<td>' . $mensajes['insertar_pelicula']['Director'] . '</td>
					<td><input type="text" name="director" value="' . (isset($_POST['director']) ? $_POST['director'] : '') . '" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="' . $mensajes['form']['Enviar'] . '" />
						<input type="reset" value="' . $mensajes['form']['Borrar'] . '" />
					</td>
				</tr>
			</table>
		</form>';
}
?>
</body>
</html>
