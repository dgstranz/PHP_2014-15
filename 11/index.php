<?php
	$cont = 0;

	$t1 = microtime(true);

	function es_primo($numero) {
		$raiz = sqrt($numero);

		if ($numero <= 1 or $numero != floor($numero)) return false;
		if ($numero == 2) return true;
		if ($numero % 2 == 0) return false;
		for ($i = 3; $i <= $raiz; $i += 2) {
			if ($numero % $i == 0) return false;
		}
		return true;
	}

	function cuenta_primos($ultimo) {
		$cont = 0;
		
		for ($i = 0; $i < $ultimo; $i++) {
			if (es_primo($i)) {
				$cont++;
			}
		}

		echo 'Hay ' . $cont . ' números primos entre 0 y ' . $ultimo . '.';
		return $cont;
	}

	cuenta_primos(10000);

	$t2 = microtime(true);

	echo '<br>Este proceso ha tardado ' . ($t2 - $t1) . ' segundos.';
?>