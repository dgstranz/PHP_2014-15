<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	if(!isset($_REQUEST['dni']) || !isset($_REQUEST['email']) || empty($_REQUEST['dni']) || empty($_REQUEST['email'])) {
		print_form();
	}
	else {
		$dni = $_REQUEST['dni'];
		$email = $_REQUEST['email'];
		if (is_dni($dni)) {
			echo 'DNI válido.';
		} else {
			echo '<font color="red">DNI no válido.</font>';
		}
		echo '<br>';
		if (is_email($email)) {
			echo 'E-mail válido.';
		} else {
			echo '<font color="red">E-mail no válido.</font>';
		}
	}

	function print_form() {
		echo '
			<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
				DNI: <input type="text" name="dni" />
				E-mail: <input type="text" name="email" />
				<input type="submit" />
			</form>
		';
	}

	function is_dni($dni) {
		if (preg_match('/^\d{1,8}(\-)?[a-zA-Z]$/', $dni)) {
			$numero = preg_replace('/[\-a-zA-Z]/', '', $dni);
			$letra = preg_replace('/[0-9\-]/', '', $dni);
			$resto = $numero % 23;
			$letras = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
			if(strtoupper($letra) == $letras[$resto]) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function is_email($email) {
		if (preg_match('/^([a-zA-Z0-9]+[\.\-_+])*[a-zA-Z0-9]+@\w+\.([a-zA-z]+\.)*[a-zA-Z]{2,6}$/', $email)) {
			return true;
		} else {
			return false;
		}
	}
?>
</body>
</html>