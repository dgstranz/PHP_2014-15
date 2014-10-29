<html>
<head>
	<title>Baraja de cartas</title>
	<meta charset="utf-8">
</head>

<body>
<?php
	$palos_es = array('oros', 'espadas', 'bastos', 'copas');
	$valores_es = array('as', 2, 3, 4, 5, 6, 7, 'sota', 'caballo', 'rey');

	$palos_fr = array('corazones', 'diamantes', 'tréboles', 'picas');
	$valores_fr = array('as', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'sota', 'reina', 'rey');

	function crear_baraja($palos, $valores) {
		$result = array();
		$num_palos = sizeof($palos);
		$num_valores = sizeof($valores);

		for ($i=0; $i < $num_palos; $i++) { 
			for ($j=0; $j < $num_valores; $j++) { 
				$result[$i * $num_valores + $j] = '' . $valores[$j] . ' de ' . $palos[$i];
			}
		}

		return $result;
	}

	function barajar($cartas) {
		$aux = $cartas;
		$result = array();
		$tam;
		$num;

		while (sizeof($result) < sizeof($cartas)) {
			$tam = sizeof($aux);
			$num = rand(0, $tam-1);
			$result[sizeof($result)] = $aux[$num];
			$aux[$num] = $aux[sizeof($aux)-1];
			unset($aux[sizeof($aux)-1]);
		}

		return $result;
	}

	function ver($baraja) {
		foreach ($baraja as $key => $value) {
			echo $value . "<br>\n";
		}
		echo "<br>\n";
	}

	function extraer($num) {
		global $baraja;
		$result = array();
		$limit = min($num, sizeof($baraja));

		for ($i=0; $i < $limit; $i++) {
			$result[$i] = $baraja[sizeof($baraja)-1];
			unset($baraja[sizeof($baraja)-1]);
		}

		return $result;
	}

	$cartas = crear_baraja($palos_fr, $valores_fr);

	$baraja = barajar($cartas);

	echo '<table><tr><td valign="top"><h2>Baraja antes de extraer 5 cartas</h2>';
	ver($baraja);

	$mano = extraer(5);

	echo '</td><td><h2>Baraja después de extraer 5 cartas</h2>';
	ver($baraja);

	echo '<h2>Mano de 5 cartas</h2>';
	ver($mano);

	echo '</td></tr></table>';
?>

</body>
</html>