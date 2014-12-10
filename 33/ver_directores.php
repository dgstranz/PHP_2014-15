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

echo '<p><a href="index.php">Volver atrás</a></p>';

function tabla() {
	$directores = cargar_directores();

	echo '<h1>Lista de directores</h1>';
	echo '<ul>';
	while ($row = $directores->fetch_row()) {
		echo '<li>' . $row[1] . '</li>';
	}
	echo '</ul>';
}
?>
</body>
</html>