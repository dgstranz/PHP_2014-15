<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

if (!isset($_POST['email'])) {
	formulario();
} else {
	echo validar_email($_POST['email']) ? 'E-mail correcto' : 'E-mail incorrecto';
}

function validar_email($email) {
	$aux = strstr($email, '@');
	if (!$aux) { //No hay arroba
		return false;
	} elseif (strpos($aux, '@', 1)) { // Hay más de una arroba
		return false;
	} elseif (!strpos($aux, '.')) { // No hay punto
		return false;
	} else {
		$codes = array('.' => ord('.'), //46
			'@' => ord('@'), //64
			'A' => ord('A'), //65
			'Z' => ord('Z'), //90
			'a' => ord('a'), //97
			'z' => ord('z')); //122
		for ($i=0; $i < strlen($email); $i++) {
			$code = ord($email[$i]);
			if (($code < $codes['@'] && $code != $codes['.']) ||
				($code > $codes['Z'] && $code < $codes['a']) ||
				($code > $codes['z'])) { // Tiene algún carácter incorrecto
				return false;
			}
		}
		return true;
	}
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
	echo '<table>';
	echo '	<tr>';
	echo '		<td>Introduce aquí el e-mail:</td>';
	echo '		<td><input type="text" name="email" value="abcde@fghi.jk"></td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td colspan="2"><input type="submit" value="Enviar"></td>';
	echo '	</tr>';
	echo '</table>';
	echo '</form>';
}
?>
</body>
</html>