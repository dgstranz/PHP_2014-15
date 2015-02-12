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
} elseif (!isset($_POST['recibir_email'])) {
	foreach ($extras as $extra) {
		if (isset($_POST[$extra])) {
			$_SESSION['extras'][$extra] = $_POST[$extra];
		} else {
			unset($_SESSION['extras']);
			header('Location: index4.php');
		}
	}
} elseif (!isset($_POST['nombre']) || empty(trim($_POST['nombre'])) || !isset($_POST['email']) || empty(trim($_POST['email']))) {
	echo '<p class="error"><b>Error</b>: deben rellenarse los campos.</p>';
} elseif (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $_POST['email'])) {
	echo '<p class="error"><b>Error</b>: correo electrónico no válido.</p>';
} else {

}

cabecera(5);
mostrar_resultados();

function buscar_viviendas() {
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

	$sql_result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);
	return $sql_result;
}

function mostrar_resultados() {
	echo '<h2>Resultados</h2>';

	if (!isset($_SESSION['result'])) {
		$sql_result = buscar_viviendas();

		$result = '';

		if ($sql_result->num_rows == 0) {
			$result .= '<p>No se han encontrado viviendas con estas especificaciones.</p>';
		} else {
			$result .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
			$result .= '<input type="hidden" name="recibir_email" value="true">';
			$result .= '<p>';
			if ($sql_result->num_rows == 1) {
				$result .= 'Se ha encontrado <b>1</b> vivienda.';
			} else {
				$result .= 'Se han encontrado <b>' . $sql_result->num_rows . '</b> viviendas.';
			}
			$result .= '</p>';
			
			$cont = 0;
			
			$result .= '<table id="resultado">';
			$result .= '<tr>';
			$result .= '	<th>Tipo</th>';
			$result .= '	<th>Provincia</th>';
			$result .= '	<th>Dormitorios</th>';
			$result .= '	<th>Precio</th>';
			$result .= '	<th>Extras</th>';
			$result .= '	<th>Me interesa</th>';
			$result .= '</tr>';
			while ($row = $sql_result->fetch_row()) {
				$cont++;
				$result .= '<tr>';

				for ($i=1; $i < sizeof($row) - sizeof($extras); $i++) {
					$result .= '<td class="color' . ($cont % 2) . '">' . $row[$i] . '</td>';
				}

				$result .= '<td class="color' . ($cont % 2) . '">';

				$str_extras = '';
				for ($i=0; $i < sizeof($extras); $i++) { 
					if ($row[sizeof($row) - sizeof($extras) + $i] >0) {
						if (!empty($str_extras)) {
							$str_extras .= ', ';
						}
						$str_extras .= $extras[$i];
					}
				}

				$result .= $str_extras . '</td>';

				$result .= '<td class="color' . ($cont % 2) . '">';
				$result .= '<input type="checkbox" value="' . $row[0] . '">';
				$result .= '</td>';
				$result .= '</tr>';
			}

			$result .= '</table>';

			$result .= '<h2>Recibir resultados por correo electrónico</h2>';
			$result .= 'Rellene sus datos y se le enviará un correo electrónico con información adicional de las viviendas seleccionadas.';

			$result .= '<table>
					<tr>
						<td>Nombre</td>
						<td><input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . '"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email" value="' . (isset($_POST['email']) ? $_POST['email'] : '') . '"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Enviar"></td>
					</tr>
				</table>
				</form>';

			$_SESSION['result'] = $result;	
		}
	}

	echo $_SESSION['result'];

	echo '<br><a href="return.php">Hacer otra búsqueda</a>';
}

function formulario() {
	
}

?>

</hody>
</html>
