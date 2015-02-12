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
}

cabecera(5);

echo '<h2>Resultados</h2>';

if (!isset($_SESSION['resultado'])) {
	$sql_result = buscar_viviendas();
	$_SESSION['resultado'] = obtener_resultados($sql_result);
}

if ($_SESSION['resultado']['numero'] == 0) {
	echo '<p>No se han encontrado viviendas con estas especificaciones.</p>';
} else {
	if ($_SESSION['resultado']['numero'] == 1) {
		echo 'Se ha encontrado <b>1</b> vivienda.';
	} else {
		echo 'Se han encontrado <b>' . $_SESSION['resultado']['numero'] . '</b> viviendas.';
	}
}


echo $_SESSION['result'];
echo '<br><a href="return.php">Hacer otra búsqueda</a>';

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

function obtener_resultados($sql_result) {
	$resultado = array();
	$resultado['numero'] = $sql_result->num_rows;
	$resumen = '';
	$tabla = '';
	$formulario = '';

	if ($sql_result->num_rows == 0) {
		$resumen .= '<p>No se han encontrado viviendas con estas especificaciones.</p>';
	} else {
		$formulario .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
		$formulario .= '<input type="hidden" name="recibir_email" value="true">';
		$resumen .= '<p>';
		if ($sql_result->num_rows == 1) {
			$resumen .= 'Se ha encontrado <b>1</b> vivienda.';
		} else {
			$resumen .= 'Se han encontrado <b>' . $sql_result->num_rows . '</b> viviendas.';
		}
		$resumen .= '</p>';

		$cont = 0;
		
		$tabla = generar_tabla($sql_result);

		$formulario .= '<h2>Recibir resultados por correo electrónico</h2>';
		$formulario .= 'Rellene sus datos y se le enviará un correo electrónico con información adicional de las viviendas seleccionadas.';

		$formulario .= '<table>
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
	}

	$resultado['resumen'] = $resumen;
	$resultado['tabla'] = $tabla;
	$resultado['formulario'] = $formulario;

	return $resultado;
}

function generar_tabla($sql_result) {
	$tabla = '';

	$tabla .= '<table id="resultado">';
	$tabla .= '<tr>';
	$tabla .= '	<th>Tipo</th>';
	$tabla .= '	<th>Provincia</th>';
	$tabla .= '	<th>Dormitorios</th>';
	$tabla .= '	<th>Precio</th>';
	$tabla .= '	<th>Extras</th>';
	$tabla .= '	<th>Me interesa</th>';
	$tabla .= '</tr>';

	while ($row = $sql_result->fetch_row()) {
		$cont++;
		$tabla .= '<tr>';

		for ($i=1; $i < sizeof($row) - sizeof($extras); $i++) {
			$tabla .= '<td class="color' . ($cont % 2) . '">' . $row[$i] . '</td>';
		}

		$tabla .= '<td class="color' . ($cont % 2) . '">';

		$str_extras = '';
		for ($i=0; $i < sizeof($extras); $i++) { 
			if ($row[sizeof($row) - sizeof($extras) + $i] >0) {
				if (!empty($str_extras)) {
					$str_extras .= ', ';
				}
				$str_extras .= $extras[$i];
			}
		}

		$tabla .= $str_extras . '</td>';

		$tabla .= '<td class="color' . ($cont % 2) . '">';
		$tabla .= '<input type="checkbox" value="' . $row[0] . '">';
		$tabla .= '</td>';
		$tabla .= '</tr>';
	}

	$tabla .= '</table>';

	return $tabla;
}

function formulario() {
	
}

?>

</hody>
</html>
