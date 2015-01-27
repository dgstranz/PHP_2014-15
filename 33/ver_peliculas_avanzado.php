<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
	<style>
		.hidden {
			display: none;
		}
		td {
			vertical-align: top;
		}
	</style>
<?php
session_start();
require_once('bd.php');
require_once('clases.php');
require_once('funciones_bd.php');

if (empty($_POST)) {
	formulario();
} else {
	$consulta = sacar_consulta();
	tabla();
}

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function formulario() {
	global $mensajes;

	$anyo_actual = date('Y');
	$generos = cargar_generos();

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>
						<input onclick="toggle(\'sel_generos\')" type="checkbox" name="vars[genero]" value="true"' . (isset($_POST['vars']['genero']) ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Especificar géneros'] . '
					</td>
					<td colspan="2" class="sel_generos' . (isset($_POST['vars']['genero']) ? '' : ' hidden') . '">';

	while ($row = $generos->fetch_row()) {
		echo '<input type="checkbox" name="genero[' . $row[0] . ']" value="true"' . (isset($_POST['genero'][$row[0]]) ? ' checked' : '') . '>' . ucfirst($row[1]) . '<br>';
	}

	echo '
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_anyo\')" type="checkbox" name="vars[anyo]" value="true"' . (isset($_POST['vars']['anyo']) ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Especificar años'] . '
					</td>
					<td colspan="2" class="sel_anyo' . (isset($_POST['vars']['anyo']) ? '' : ' hidden') . '">
						' . $mensajes['ver_peliculas']['desde'] . ' <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_min" value="' . (isset($_POST['anyo_min']) ? $_POST['anyo_min'] : $anyo_actual) . '" />
						' . $mensajes['ver_peliculas']['hasta'] . ' <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_max" value="' . (isset($_POST['anyo_max']) ? $_POST['anyo_max'] : $anyo_actual) . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_protagonista\')" type="checkbox" name="vars[protagonista]" value="true"' . (isset($_POST['vars']['protagonista']) ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Especificar protagonista'] . '
					</td>
					<td colspan="2" class="sel_protagonista' . (isset($_POST['vars']['protagonista']) ? '' : ' hidden') . '">
						<input type="text" name="protagonista" value="' . (isset($_POST['protagonista']) ? $_POST['protagonista'] : '') . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_director\')" type="checkbox" name="vars[director]" value="true"' . (isset($_POST['vars']['director']) ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Especificar director'] . '
					</td>
					<td colspan="2" class="sel_director' . (isset($_POST['vars']['director']) ? '' : ' hidden') . '">
						<input type="text" name="director" value="' . (isset($_POST['director']) ? $_POST['director'] : '') . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_orden\')" type="checkbox" name="vars[orden]" value="true"' . (isset($_POST['vars']['orden']) ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Especificar ordenación'] . '
					</td>
					<td class="sel_orden' . (isset($_POST['vars']['orden']) ? '' : ' hidden') . '">
						<input type="radio" name="orden[0]" value="titulo"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'titulo') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Título'] . '<br>
						<input type="radio" name="orden[0]" value="genero"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'genero') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Género'] . '<br>
						<input type="radio" name="orden[0]" value="anyo"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'anyo') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Año'] . '<br>
						<input type="radio" name="orden[0]" value="protagonista"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'protagonista') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Protagonista'] . '<br>
						<input type="radio" name="orden[0]" value="director"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'director') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Director'] . '
					</td>
					<td class="sel_orden' . (isset($_POST['vars']['orden']) ? '' : ' hidden') . '">
						<input type="radio" name="orden[1]" value="ASC"' . ((isset($_POST['orden'][1]) && $_POST['orden'][1] == 'ASC') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Orden ascendente'] . '<br>
						<input type="radio" name="orden[1]" value="DESC"' . ((isset($_POST['orden'][1]) && $_POST['orden'][1] == 'DESC') ? ' checked' : '') . '>' . $mensajes['ver_peliculas']['Orden descendente'] . '
					</td>
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

function sacar_consulta() {
	$select = '';

	if (isset($_POST['vars']['genero']) && isset($_POST['genero'])) {
		$select .= 'WHERE genero IN (';
		foreach ($_POST['genero'] as $key => $value) {
			$select .= $key . ', ';
		}
		$select = rtrim($select, ', ') . ')';
	}
	if (isset($_POST['vars']['anyo'])) {
		if (isset($_POST['anyo_min']) && !empty($_POST['anyo_min'])) {
			$select .= ($select ? ' AND ' : 'WHERE ');
			$select .= 'anyo >= ' . $_POST['anyo_min'];
		}
		if (isset($_POST['anyo_max']) && !empty($_POST['anyo_max'])) {
			$select .= ($select ? ' AND ' : 'WHERE ');
			$select .= 'anyo <= ' . $_POST['anyo_max'];
		}
	}
	if (isset($_POST['vars']['protagonista']) && isset($_POST['protagonista']) && !empty($_POST['protagonista'])) {
		$select .= ($select ? ' AND ' : 'WHERE ');
		$select .= 'protagonista = \'' . $_POST['protagonista'] . '\'';
	}
	if (isset($_POST['vars']['director']) && isset($_POST['director']) && !empty($_POST['director'])) {
		$select .= ($select ? ' AND ' : 'WHERE ');
		$select .= 'director = \'' . $_POST['director'] . '\'';
	}
	if (isset($_POST['vars']['orden']) && isset($_POST['orden'][0])) {
		$select .= ' ORDER BY ' . $_POST['orden'][0];
		if (isset($_POST['orden'][1])) {
			$select .= ' ' . $_POST['orden'][1];
		}
	}

	return $select;
}

function tabla() {
	global $mensajes;
	global $consulta;

	$peliculas = cargar_peliculas($consulta);

	echo '<h1>' . $mensajes['ver_peliculas']['Lista de películas'] . '</h1>';
	echo '<ul>';
	while ($row = $peliculas->fetch_row()) {
		echo '<li>' . $row[1] . ' (' . $row[3] . ')</li>';
	}
	echo '</ul>';
}
?>


		<script type="text/javascript">
			function toggle(elementClass) {
				var elements = document.getElementsByClassName(elementClass);
				for (var i = elements.length - 1; i >= 0; i--) {
					if (elements[i].classList.contains('hidden')) {
						elements[i].classList.remove('hidden');
					} else {
						elements[i].classList.add('hidden');
					}
				}
			}
		</script>
</body>
</html>
