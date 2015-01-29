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
var_dump($_SESSION);

function busqueda() {
	global $tipos, $provincias;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $provincias[$_SESSION['provincia']] . '</span>';
}

$select = "SELECT * FROM viviendas ";
$select .= "WHERE tipo = " . $_SESSION['tipo'] . " ";
$select .= "AND provincia = " . $_SESSION['provincia'] . " ";

// Aprovecho que en el formulario la opción "> ($max_dormitorios)" pasa el valor $max_dormitorios + 1
$select .= "AND dormitorios ";
if ($_SESSION['dormitorios'] > $max_dormitorios) {
	$select .= ">= ";
}
$select .= $_SESSION['dormitorios'] . " ";

$select .= "AND precio >= " . $_SESSION['preciomin'] . " ";
$select .= "AND precio <= " . $_SESSION['preciomax'];

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
var_dump($select);

require_once 'config.php';
$conn = new mysqli(SERVER, USER, PASSWORD) or die('No se ha podido establecer una conexión: ' . mysqli_connect_error());
$conn->select_db('inmobiliaria') or die('No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error());

$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);

echo '<h1>Resultados</h1>';
echo '<table>';
$num_rows = 0;
while ($row = $result->fetch_row()) {
	$num_rows++;
	echo '<tr>';

	for ($i=0; $i < sizeof($row); $i++) {
		echo '<td bgcolor="' . ($num_rows % 2 ? '#ddd' : '#eee') . '">' . $row[$i] . '</td>';
	}

	echo '</tr>';
}
echo '</table>';

session_destroy();

?>

</hody>
</html>
