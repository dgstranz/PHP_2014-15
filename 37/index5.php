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

	$select = "SELECT t.tipo, p.nombre_es, v.dormitorios, v.precio, v.piscina, v.jardin, v.garaje ";
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

	echo '<h1>Resultados</h1>';

	if ($result->num_rows == 0) {
		echo 'No se han encontrado resultados.';
	} else {
		echo 'Se han encontrado <b>' . $result->num_rows . '</b> viviendas.<br><br>';
		$cont = 0;
		
		echo '<table id="resultado">';
		echo '<tr>';
		echo '	<th>Tipo</th>';
		echo '	<th>Provincia</th>';
		echo '	<th>Dormitorios</th>';
		echo '	<th>Precio</th>';
		echo '	<th>Extras</th>';
		echo '</tr>';
		while ($row = $result->fetch_row()) {
			$cont++;
			echo '<tr>';

			for ($i=0; $i < sizeof($row) - sizeof($extras); $i++) {
				echo '<td bgcolor="' . ($cont % 2 ? '#ddd' : '#eee') . '">' . $row[$i] . '</td>';
			}

			echo '<td bgcolor="' . ($cont % 2 ? '#ddd' : '#eee') . '">';

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
			echo '</tr>';
		}
		echo '</table>';
	}

	echo '<br><a href="return.php">Hacer otra búsqueda</a>';
}

?>

</hody>
</html>
