<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
$dia_semana = 2; // Huecos que hay que dejar al principio del calendario 

$dias_mes = array(array('Enero', 31),
	array('Febrero', 28),
	array('Marzo', 31),
	array('Abril', 30),
	array('Mayo', 31),
	array('Junio', 30),
	array('Julio', 31),
	array('Agosto', 31),
	array('Septiembre', 30),
	array('Octubre', 31),
	array('Noviembre', 30),
	array('Diciembre', 31));

function print_cal($dias_mes) {
	global $dia_semana;
	echo "<h1>$dias_mes[0]</h1>\n";
	echo "<table>";
	echo "\t<tr>\n";
	for ($i=1; $i <= $dia_semana; $i++) { 
		echo "\t\t<td></td>\n";
	}
	for ($i=1; $i <= $dias_mes[1]; $i++) { 
		echo "\t\t<td>$i</td>\n";
		if ($i < $dias_mes[1] && ($i + $dia_semana) % 7 == 0) {
			echo "\t</tr>\n";
		}
	}
	$dia_semana = ($dias_mes[1] + $dia_semana) % 7;
	echo "\t</tr>\n";
	echo "</table>\n";
}

array_walk($dias_mes, 'print_cal');
?>
</body>
</html>