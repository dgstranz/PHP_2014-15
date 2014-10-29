<html>
<head>
	<title>Creación de tablas</title>
	<meta charset="utf-8">
</head>
<body>
<?php
function crear_tabla($rows, $cols) {
	$default = array('','','width: 70px;','height: 70px;','background: blue;','border: 3px dashed black;');
	$params = func_get_args();

	echo "<table style=\"";

	for ($i = 2; $i < sizeof($default); $i++) { 
		echo (isset($params[$i]) ? strip_tags($params[$i]) : $default[$i]);
	}
	for ($i = sizeof($default); $i < sizeof($params); $i++) { 
		echo $params[$i];
	}

	echo "\">\n";
	for ($r = 1; $r <= $rows ; $r++) { 
		echo "	<tr>\n";
		for ($c = 1; $c <= $cols; $c++) { 
			echo "		<td>█</td>\n";
		}
		echo "	</tr>\n";
	}
	echo "</table>\n<br>\n";

	return true;
}

echo '<h2>Crear tabla con 2 parámetros</h2>';
crear_tabla(3, 4);

echo '<h2>Crear tabla con 4 parámetros</h2>';
crear_tabla(7, 7,'width: 300px;','height: 200px;');

echo '<h2>Crear tabla con 6 parámetros</h2>';
crear_tabla(4, 6,'width: 300px;','height: 200px;','background: pink;','border: 3px dashed blue;');

echo '<h2>Crear tabla con 9 parámetros</h2>';
crear_tabla(8, 5,'width: 300px;','height: 200px;','background: #cde;','border: 2px dotted #abc;','border-spacing: 10px;','color: red;',"text-align: right;");

?>
</body>
</html>