<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
	<style>
		.hidden: {
			display: none;
			background-color: red;
		}
	</style>
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
					<td>
						<input onclick="toggle(\'sel_generos\')" type="checkbox" name="vars[genero]" value="true"' . (isset($_POST['vars']['genero']) ? ' checked' : '') . '>Especificar géneros:
					</td>
					<td colspan="2" class="sel_generos hidden">';

	while ($row = $generos->fetch_row()) {
		echo '<input type="checkbox" name="genero[' . $row[0] . ']" value="true"' . (isset($_POST['genero'][$row[0]]) ? ' checked' : '') . '>' . ucfirst($row[1]) . '<br>';
	}

	echo '
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_anyo\')" type="checkbox" name="vars[anyo]" value="true"' . (isset($_POST['vars']['anyo']) ? ' checked' : '') . '>Especificar años:
					</td>
					<td colspan="2" class="sel_anyo hidden">
						desde <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_min" value="' . (isset($_POST['anyo_min']) ? $_POST['anyo_min'] : 2014) . '" />
						 hasta <input type="number" min="1890" max="' . $anyo_actual . '" name="anyo_max" value="' . (isset($_POST['anyo_max']) ? $_POST['anyo_max'] : 2014) . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_protagonista\')" type="checkbox" name="vars[protagonista]" value="true"' . (isset($_POST['vars']['protagonista']) ? ' checked' : '') . '>Especificar actor principal:
					</td>
					<td colspan="2" class="sel_protagonista hidden">
						<input type="text" name="protagonista" value="' . (isset($_POST['protagonista']) ? $_POST['protagonista'] : '') . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_director\')" type="checkbox" name="vars[director]" value="true"' . (isset($_POST['vars']['director']) ? ' checked' : '') . '>Especificar director:
					</td>
					<td colspan="2" class="sel_director hidden">
						<input type="text" name="director" value="' . (isset($_POST['director']) ? $_POST['director'] : '') . '" />
					</td>
				</tr>
				<tr>
					<td>
						<input onclick="toggle(\'sel_orden\')" type="checkbox" name="vars[orden]" value="true"' . (isset($_POST['vars']['orden']) ? ' checked' : '') . '>Especificar forma de ordenación:
					</td>
					<td class="sel_orden hidden">
						<input type="radio" name="orden[0]" value="titulo"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'titulo') ? ' checked' : '') . '>Título<br>
						<input type="radio" name="orden[0]" value="genero"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'genero') ? ' checked' : '') . '>Género<br>
						<input type="radio" name="orden[0]" value="anyo"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'anyo') ? ' checked' : '') . '>Año<br>
						<input type="radio" name="orden[0]" value="protagonista"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'protagonista') ? ' checked' : '') . '>Protagonista<br>
						<input type="radio" name="orden[0]" value="director"' . ((isset($_POST['orden'][0]) && $_POST['orden'][0] == 'director') ? ' checked' : '') . '>Director
					</td>
					<td class="sel_orden hidden">
						<input type="radio" name="orden[1]" value="ASC"' . ((isset($_POST['orden'][1]) && $_POST['orden'][1] == 'ASC') ? ' checked' : '') . '>Orden ascendente (a-z, 0-9)<br>
						<input type="radio" name="orden[1]" value="DESC"' . ((isset($_POST['orden'][1]) && $_POST['orden'][1] == 'DESC') ? ' checked' : '') . '>Orden descendente (z-a, 9-0)
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


		<script type="text/javascript">
			function toggle(elementClass) {
				var elements = document.getElementsByClassName(elementClass);
				for (var i = elements.length - 1; i >= 0; i--) {
					if (elements[i].classList.contains('hidden')) {
						elements[i].classList.remove('hidden');
					} else {
						elements[i].classList.add('hidden');
					}
					console.log(elements[i].classList);
				}
			}
		</script>
</body>
</html>
