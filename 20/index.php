<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$params = ['year', 'month', 'day', 'hour', 'minute', 'title', 'comment'];
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$$param = $_POST[$param];
		}
	}

	if (!isset($_COOKIE['id'])) {
		setcookie('id', uniqid(), time()+3600);
		header('Location: ' .  $_SERVER['PHP_SELF']);
	}

	if (!isset($_GET['operacion']) || $_GET['operacion'] != 'confirmar') {
		formulario_evento();
	} else if ($_POST['id'] != $_COOKIE['id']) {
		echo 'Error: el identificador ha expirado.';
		formulario_evento();
	} else {
		validar();
	}

	function formulario_evento() {
		global $year, $month, $day, $hour, $minute, $title, $comment;
		$months = [null, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

		echo '<form action="' . $_SERVER['PHP_SELF'] . '?operacion=confirmar" method="POST">';
		echo '<input type="hidden" name="id" value="' . $_COOKIE['id'] . '">';

		echo 'Día: <select name="day">';
		echo '<option value="-1"></option>';
		for($i = 1; $i <= 31 ; $i++) {
			echo '<option value="' . $i . '"' . ((isset($day) && $day == $i) ? ' selected' : '') . '>'.$i.'</option>';
		}
		echo '</select> ';

		echo 'Mes: <select name="month">';
		echo '<option value="-1"></option>';
		for($i = 1; $i <= 12 ; $i++) {
			echo '<option value="' . $i . '"' . ((isset($month) && $month == $i) ? ' selected' : '') . '>'.$months[$i].'</option>';
		}
		echo '</select> ';

		echo 'Año: <select name="year">';
		echo '<option value="-1"></option>';
		for($i = 2000; $i <= 2037 ; $i++) {
			echo '<option value="' . $i . '"' . ((isset($year) && $year == $i) ? ' selected' : '') . '>'.$i.'</option>';
		}
		echo '</select><br>';

		echo 'Hora: <select name="hour">';
		echo '<option value="-1"></option>';
		for($i = 0; $i <= 23 ; $i++) {
			echo '<option value="' . $i . '"' . ((isset($hour) && $hour == $i) ? ' selected' : '') . '>'.$i.'</option>';
		}
		echo '</select>:';
		echo '<select name="minute">';
		echo '<option value="-1"></option>';
		for($i = 0; $i <= 55 ; $i += 5) {
			echo '<option value="' . $i . '"' . ((isset($minute) && $minute == $i) ? ' selected' : '') . '>'.$i.'</option>';
		}
		echo '</select><br>';

		echo 'Título: <input type="text" name="title"><br>';

		echo 'Comentario:<br><textarea name="comment" rows="4" cols="40">';
		echo '</textarea><br>';

		echo '<input type="submit">';
		echo '</form>';
	}

	function validar() {
		global $year, $month, $day, $hour, $minute, $title, $comment;
		$valido = true;
		if (!checkdate($month, $day, $year)) {
			$valido = false;
			echo '<font color="red">Debe introducirse una fecha válida.</font><br>';
		}
		if ($hour < 0 || $hour > 23 || $minute < 0 || $minute > 59 || $minute % 5 != 0) {
			$valido = false;
			echo '<font color="red">Debe introducirse una hora válida.</font><br>';
		}
		if (!$valido) {
			formulario_evento();
		} else {
			echo 'Datos enviados correctamente.<br>';
			echo 'Fecha: ' . $day . '-' . $month . '-' . $year . '<br>';
			echo 'Hora: ' . $hour . ':' . $minute . '<br>';
			echo 'Título: ' . $title . '<br>';
			echo 'Comentario: "' . $comment . '"';
		}
	}
?>
</body>
</html>