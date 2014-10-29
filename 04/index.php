<html>
<head>
<title>Tablas de multiplicar</title>
</head>
<body>

<form action="index.php" method="get">
	Filas: <input type="number" name="filas" min=1 value=10><br />
	Columnas: <input type="number" name="columnas" min=1 value=10><br />
	<input type="submit">
</form>

<?php
if(isset($_GET['filas']) && isset($_GET['columnas'])) {
$filas=$_GET['filas'];
$columnas=$_GET['columnas'];
if($filas<1) $filas=10;
if($columnas<1) $columnas=10;

echo '<table border="5"><tr><td></td>';

for($i=1;$i<=$columnas;$i++) {
	echo '<td><b>'.$i.'</b></td>';
}

echo '</tr>';

for($j=1;$j<=$filas;$j++) {
	echo '<tr><td><b>'.$j.'</b></td>';
	for($i=1;$i<=$columnas;$i++) {
		echo '<td>'.$i.'&times;'.$j.'='.$i*$j.'</td>';
	}
	echo '</tr>';
}

echo '</table>';
}
?>
</body>
</html>