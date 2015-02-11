<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
	<link rel='stylesheet' type='text/css' href='estilo.css'>
</head>
<body>

<?php
session_start();
include 'cabecera.php';
include 'opciones.php';

if (isset($_POST['back'])) {
	header('Location: index3.php');
} else {
	foreach ($extras as $extra) {
		if (isset($_POST[$extra])) {
			$_SESSION['extras'][$extra] = $_POST[$extra];
		} else {
			unset($_SESSION['extras']);
			header('Location: index4.php');
		}
	}
}

cabecera(5);
busqueda();

function busqueda() {
	global $tipos, $provincias, $max_dormitorios, $extras;
	require_once 'bd.php';

	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $provincias[$_SESSION['provincia']] . '</span>';

	$select = "SELECT v.id, t.tipo, p.nombre_es, v.dormitorios, v.precio, v.piscina, v.jardin, v.garaje ";
	$select .= "FROM viviendas AS v ";

	$select .= "LEFT JOIN tipos AS t ON v.tipo = t.id ";
	$select .= "LEFT JOIN provincias AS p ON v.provincia = p.id ";

	$select .= "WHERE v.tipo = " . $_SESSION['tipo'] . " ";
	$select .= "AND v.provincia = " . $_SESSION['provincia'] . " ";

	// Aprovecho que en el formulario la opción "> ($max_dormitorios)" pasa el valor $max_dormitorios + 1
	$select .= "AND dormitorios ";
	$select .= ($_SESSION['dormitorios'] > $max_dormitorios) ? ">= " : "= ";
	$select .= $_SESSION['dormitorios'] . " ";

	$select .= "AND precio >= " . $_SESSION['preciomin'] . " ";
	$select .= "AND precio <= " . $_SESSION['preciomax'] . " ";

	foreach ($extras as $extra) {
		// iconv convierte í en 'i, con esta línea elimino el acento.
		$sin_acentuar = strtolower(preg_replace('/\pM*/u', '', normalizer_normalize($extra, Normalizer::FORM_D)));

		// Si $_SESSION['extras'][$extra] == 2 (indiferente), no se añade nada a la sentencia SELECT.
		if ($_SESSION['extras'][$extra] == 1) {
			$select .= " AND $sin_acentuar = true";
		} elseif ($_SESSION['extras'][$extra] == 0) {
			$select .= " AND $sin_acentuar = false";
		}
	}

	$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);

	echo '<h2>Resultados</h2>';

	if ($result->num_rows == 0) {
		echo '<p>No se han encontrado viviendas con estas especificaciones.</p>';
	} else {
		echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
		echo '<p>';
		if ($result->num_rows == 1) {
			echo 'Se ha encontrado <b>1</b> vivienda.';
		} else {
			echo 'Se han encontrado <b>' . $result->num_rows . '</b> viviendas.';
		}
		echo '</p>';
		$cont = 0;
		
		echo '<table id="resultado">';
		echo '<tr>';
		echo '	<th>Tipo</th>';
		echo '	<th>Provincia</th>';
		echo '	<th>Dormitorios</th>';
		echo '	<th>Precio</th>';
		echo '	<th>Extras</th>';
		echo '	<th>Me interesa</th>';
		echo '</tr>';
		while ($row = $result->fetch_row()) {
			$cont++;
			echo '<tr>';

			for ($i=1; $i < sizeof($row) - sizeof($extras); $i++) {
				echo '<td class="color' . ($cont % 2) . '">' . $row[$i] . '</td>';
			}

			echo '<td class="color' . ($cont % 2) . '">';

			$str_extras = '';
			for ($i=0; $i < sizeof($extras); $i++) { 
				if ($row[sizeof($row) - sizeof($extras) + $i] >0) {
					if (!empty($str_extras)) {
						$str_extras .= ', ';
					}
					$str_extras .= $extras[$i];
				}
			}

			echo $str_extras . '</td>';

			echo '<td class="color' . ($cont % 2) . '">';
			echo '<input type="checkbox" value="' . $row[0] . '">';
			echo '</td>';
			echo '</tr>';
		}

		echo '</table>';

		echo '<h2>Recibir resultados por correo electrónico</h2>';
		echo 'Rellene sus datos y se le enviará un correo electrónico con información adicional de las viviendas seleccionadas.';

		echo '<table>
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . '"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value="' . (isset($_POST['email']) ? $_POST['email'] : '') . '"></td>
			</tr>
			<tr>
				<td>Asunto</td>
				<td><input type="text" name="titulo" value="' . (isset($_POST['asunto']) ? $_POST['asunto'] : '') . '"></td>
			</tr>
			<tr>
				<td>Mensaje</td>
				<td><textarea rows="8" cols="50" name="mensaje">' . (isset($_POST['mensaje']) ? $_POST['mensaje'] : '') . '</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Enviar"></td>
			</tr>
		</table>
		</form>';
	}

	echo '<br><a href="return.php">Hacer otra búsqueda</a>';
}

function formulario() {
	
}

?>

</hody>
</html>
