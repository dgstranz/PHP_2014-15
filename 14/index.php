<html>
<head>
	<title>Aguja y pajar</title>
	<meta charset="utf-8">
</head>
<?php
	$aguja;
	$pajar;
	$pos = array();

	if (!isset($_POST['aguja']) || !isset($_POST['pajar'])) {
		print_form();
	} elseif (empty($_POST['aguja']) || empty($_POST['pajar'])) {
		echo '<b>Error:</b> Alguno de los campos está vacío. Redireccionando en 5 segundos...';
		header('refresh: 5, url=index.php');
	} else {
		$aguja = $_POST['aguja'];
		$pajar = $_POST['pajar'];
		print_form();
		$pos = buscar_pos($aguja, $pajar);
		visualizar($pos);
	}

	function print_form() {
		global $aguja;
		global $pajar;
		echo '<form action="index.php" method="post">
				<table>
					<tr>
						<td>Texto:</td>
						<td><textarea cols="40" rows="4" name="pajar">'.$pajar.'</textarea></td>
					</tr>
					<tr>
						<td>Buscar:</td>
						<td><input type="text" name="aguja" value="'.$aguja.'" /></td>
					</tr>
					<tr><td colspan="2"><input type="submit" value="Enviar" /><input type="reset" value="Borrar" /></td></tr>
				</table>
			</form>';
	}

	function buscar_pos($aguja, $pajar) {
		$pos_actual = 0;
		$num_ocurrencias = 0;
		$pos = array();

		while (($valor = stripos($pajar, $aguja, $pos_actual)) !== false) {
			$pos[sizeof($pos)] = $valor;
			$pos_actual = $valor + 1;
		}

		return $pos;
	}

	function visualizar($pos) {
		global $aguja;

		switch ($pos) {
			case !isset($pos):
				echo '<h2>No se ha encontrado la cadena "' . $aguja . '".</h2>';
				break;

			case sizeof($pos) == 1:
				echo '<h2>Se ha encontrado la cadena "' . $aguja . '" 1 vez.</h2>';
				echo '<b>Posición:</b> ' . $pos[0];
				break;
			
			default:
				echo '<h2>Se ha encontrado la cadena "' . $aguja . '" ' . sizeof($pos) . ' ' . (sizeof($pos) > 1 ? 'veces' : 'vez') . '.</h2>';
				echo '<ol><b>Posiciones:</b>';
				foreach ($pos as $key => $value) {
					echo '<li>' . $value . '</li>';
				}
				echo '</ol>';
				break;
		}
	}
?>
</body>
</html>