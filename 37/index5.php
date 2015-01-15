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
	$extras = array('piscina', 'jardin', 'garaje');
	foreach ($extras as $extra) {
		if (isset($_POST[$extra])) {
			$_SESSION[$extra] = true;
		} else {
			$_SESSION[$extra] = false;
		}
	}
}

cabecera(5);
busqueda();
var_dump($_SESSION);

function busqueda() {
	global $tipos, $zonas;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $zonas[$_SESSION['zona']] . '</span>';
}
?>

</hody>
</html>
