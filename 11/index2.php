<?php
	$primos = array();

	$t1 = microtime(true);

	function es_primo($numero) {
		global $primos;
		$raiz = sqrt($numero);

		if ($numero <= 1 or $numero != floor($numero)) return false;
		if ($numero == 2) return true;
		if ($numero % 2 == 0) return false;
		for ($i = 0; $i < sizeof($primos); $i++) { 
			if ($numero % $primos[$i] == 0) return false;
		}
		return true;
	}

	function cuenta_primos($ultimo) {
		global $primos;

		for ($i = 0; $i < $ultimo; $i++) {
			if (es_primo($i)) {
				$primos[sizeof($primos)] = $i;
			}
		}

		echo 'Hay ' . sizeof($primos) . ' números primos entre 0 y ' . $ultimo . '.';
		return sizeof($primos);
	}

	cuenta_primos(10000);

	$t2 = microtime(true);

	echo '<br>Este proceso ha tardado ' . ($t2 - $t1) . ' segundos.';
?>