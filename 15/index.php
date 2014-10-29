<?php

if (!isset($_REQUEST['nombre'])) {
	print_form();
} else {
	$nombre = limpiar($_REQUEST['nombre']);
	if (empty($nombre)) {
		echo '<b>Error</b>: Debes introducir un nombre';
		print_form();
	} else {
		echo 'El nombre introducido es "' . $nombre .'".';
	}
}

function print_form() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="nombre" value="" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Enviar" />
						<input type="reset" value="Borrar" />
					</td>
				</tr>
			</table>
		</form>';
}

function limpiar($str) {
	return htmlspecialchars(trim($str));
}

?>