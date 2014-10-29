<html>
<head>
	<title>Saludo según la hora del día</title>
	<meta charset="utf-8">
</head>

<body>
<?php
	$time = date('G');
	switch ($time) {
		case ($time >= 0 && $time < 6):
			echo 'Buenas noches';
			break;
		case ($time >= 6 && $time < 13):
			echo 'Buenos días';
			break;
		case ($time >= 13 && $time < 19):
			echo 'Buenas tardes';
			break;
		case ($time >= 19 && $time <= 24):
			echo 'Buenas noches';
			break;
		default:
			echo 'Hola :D'; //no debería salir esto
	}
?>
</body>
</html>