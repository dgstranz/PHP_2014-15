<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
define('BASE_HEIGHT', 10);
define('TOTAL_WIDTH', 800);
define('GRAPH_WIDTH', TOTAL_WIDTH / 2);

$votos = array_count_values(file('votos.txt', FILE_IGNORE_NEW_LINES));

// Valor más alto en el array de votos
$max = array_reduce($votos, 'max_array');

// Escala de la gráfica
$scale = 1;
while (6 * $scale < $max) {
	switch (substr((string)$scale, 0, 1)) {
		case '1':
			$scale *= 2;
			break;
		
		case '2':
			$scale = (int)($scale * 5/2);
			break;

		default:
			$scale *= 2;
			break;
	}
}

arsort($votos);
echo '<h1>Resultados electorales de más a menos votos</h1>';
print_res($votos);

uksort($votos, "strnatcasecmp");
echo '<h1>Resultados electorales por orden alfabético</h1>';
print_res($votos);

function max_array($prev, $cur) {
	return ($cur > $prev) ? $cur : $prev;
}

function print_res($votos) {
	global $max, $scale;

	echo '<div style="width:' . TOTAL_WIDTH . '">';
		foreach ($votos as $key => $value) {
			echo '<div style="display: flex">';
				echo '<div style="width: 100px">'.$key.'</div>';
				echo '<div style="width: ' . ((GRAPH_WIDTH / $max) * $value) . '; position: relative">';
					echo '<img src="verde.png" width="' . ((GRAPH_WIDTH / $max) * $value) . '" height="' . BASE_HEIGHT . '" style="position: absolute; top: 0; bottom: 0; margin: auto; " />';
				echo '</div>';
				echo '<div>&nbsp;' . $value . '</div>';
			echo '</div>';
		}
		echo '<div style="display: flex">';
			echo '<div style="width: 100px"></div>';
			for ($i = 0; $i <= $max + $scale; $i += $scale) { 
				echo '<div style="width: ' . ((GRAPH_WIDTH / ($max / $scale)) - 1) . '; border-left: 1px dotted red">' . $i . '</div>';
			}
		echo '</div>';
	echo '</div>';
}
?>
</body>
</html>