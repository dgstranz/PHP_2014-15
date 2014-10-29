<html>
<head>
	<title>Letra del DNI</title>
	<meta charset="utf-8">
</head>

<body>
<?php
	$num;
	$resto;

	function letra_dni() {
		$letras=array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
		global $num;

		return $letras[$num % 23];
	}
	
	if (!isset($_REQUEST['dni'])) {
		echo '<form action="index.php?dni=12345678" method="POST">
				Número del DNI: <input type="text" name="dni" />
				<input type="submit" />
			</form>';
	} else {
		$num=$_REQUEST['dni'];

		if (isset($_GET['dni'])) echo 'Variable recibida por GET: ' . $_GET['dni'] . '<br>';
		echo 'Variable recibida por POST: ' . $_POST['dni'] . '<br>';
		echo 'Variable almacenada en $_REQUEST: ' . $_REQUEST['dni'] . '<br><br>';

		if ($num > 99999999 or $num < 0 or ($num - floor($num) > 0)) {
			echo 'Número no válido.';
		} else {
			$resto=$num%23;
			echo 'La letra para el DNI ' . $num . ' es ' . letra_dni() . '.';
		}
	}
?>

</body>
</html>