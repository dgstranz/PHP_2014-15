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

tabla();

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function tabla() {
	global $mensajes;
	
	$peliculas = cargar_peliculas();

	echo '<h1>' . $mensajes['ver_peliculas']['Lista de películas'] . '</h1>';
	echo '<ul>';
	while ($row = $peliculas->fetch_row()) {
		echo '<li>' . $row[1] . ' (' . $row[3] . ')</li>';
	}
	echo '</ul>';
}
?>
</body>
</html>
