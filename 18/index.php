<html>
<head>
	<title>Formulario completo</title>
	<meta charset="utf-8">
</head>
<?php
	$edades = array('&lt;18', '18-29', '30-49', '50-64', '65+');
	$gadgets = array('Móvil', 'Tableta', 'Ordenador', 'Gafas inteligentes', 'iZapatófono');
	$so = array('Windows', 'Linux', 'iOS', 'Android');

	if (!isset($_POST['visitado']) || $_POST['visitado'] != 'efectivamente') {
		print_form();
	} elseif (empty(trim($_POST['nombre'])) ||
				empty(trim($_POST['password'])) ||
				!isset($_POST['edad'])
			) {
		echo '<b>Error</b>: Faltan datos por rellenar';
		print_form();
	} else {
		print_results();
	}

	function print_form() {
		global $edades;
		global $gadgets;
		global $so;

		echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
				<input type="hidden" name="visitado" value="efectivamente">
				<table>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" name="nombre"' . (isset($_POST['nombre']) ? ' value="'. $_POST['nombre'] . '"' : '') . '></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input type="password" name="password"' . (isset($_POST['password']) ? ' value="'. $_POST['password'] . '"' : '') . '></td>
					</tr>
					<tr>
						<td>Edad:</td>
						<td>';

		foreach ($edades as $key => $value) {
			echo '			<input type="radio" name="edad" value="' . $key . '"' . (isset($_POST['edad']) && $_POST['edad'] == $key ? ' checked' : '') . '>' . $value . '<br>';
		}
		
		echo '			</td>
					<tr>
						<td colspan="2" align="center"><h2>Encuesta</h2></td>
					<tr>
						<td colspan="2">¿Desde qué dispositivos te sueles conectar a Internet?</td>
					</tr>
					<tr>
						<td></td>
						<td>';

		foreach ($gadgets as $key => $value) {
			echo '			<input type="checkbox" name="gadgets[' . $key . ']"' . (isset($_POST['gadgets'][$key]) ? ' checked' : '') . '>' . $value . '<br>';
		}

		echo '			</td>
					</tr>
					<tr>
						<td colspan="2">¿Qué sistemas operativos usas habitualmente? <small>(selección múltiple)</small></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<select name="so_uso[]" size="2" multiple>';

		foreach ($so as $key => $value) {
			echo '				<option value="' . $key . '"' . (isset($_POST['so_uso']) && in_array($key, $_POST['so_uso']) ? ' selected' : '') . '>' . $value . '</option>';
		}


		echo '				</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">¿Qué sistema operativo te gusta más? <small>(selección simple)</small></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<select name="so_fav" size="2">';

		foreach ($so as $key => $value) {
			echo '				<option value="' . $key . '"' . (isset($_POST['so_fav']) && $_POST['so_fav'] == $key ? ' selected' : '') . '>' . $value . '</option>';
		}


		echo '				</select>
						</td>
					</tr>
					<tr>
						<td>Comentario:</td>
						<td><textarea cols="40" rows="4" name="comentario"></textarea></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="Enviar">
							<input type="reset" value="Borrar">
						</td>
					</tr>
				</table>
			</form>';
	}

	function print_results() {
		global $edades;
		global $gadgets;
		global $so;

		$num_gadgets = (isset($_POST['gadgets']) ? sizeof($_POST['gadgets']) : 0);
		$num_so_uso = (isset($_POST['so_uso']) ? sizeof($_POST['so_uso']) : 0);

		$i;

		echo 'Los datos enviados son:';
		echo '<ul>';
		echo '<li>Nombre: ' . trim(htmlspecialchars($_POST['nombre']));
		echo '<li>Edad: ' . $edades[$_POST['edad']];
		echo '<li>Dispositivos: ';

		if ($num_gadgets > 0) {
			$i = 0;
			foreach ($_POST['gadgets'] as $key => $value) {
				echo strtolower($gadgets[$key]);
				//En checkboxes el valor por defecto de una caja activada es "on"
				//así que aquí escojo recorrer los índices.
				if ($i < $num_gadgets - 2) echo ', ';
				elseif ($i < $num_gadgets - 1) echo ' y ';
				else echo '.';
				$i++;
			}
		} else {
			echo 'ninguno.';
		}

		echo '<li>Sistemas operativos que utilizas: ';

		if ($num_so_uso > 0) {
			$i = 0;
			foreach ($_POST['so_uso'] as $key => $value) {
				//En selección múltiple los índices del array son correlativos
				echo $so[$value];
				if ($i < $num_so_uso - 2) echo ', ';
				elseif ($i < $num_so_uso - 1) echo ' y ';
				else echo '.';
				$i++;
			}
		} else {
			echo 'ninguno, al menos de forma habitual.';
		}

		echo '<li>Sistema operativo preferido: ' . (isset($_POST['so_fav']) ? $so[$_POST['so_fav']] : 'ninguno.');
		echo '<li>Comentario introducido: ' . (!empty($_POST['comentario']) ? '"' . $_POST['comentario'] . '"' : 'ninguno');
		echo '</ul>';
	}
?>
</body>
</html>