<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['identificativo'])) {
	if (!isset($_POST['username']) && !isset($_POST['password'])) {
		formulario();
	} elseif ($_POST['username'] != 'alumno' || $_POST['password'] != '123456') {
		echo '<b>Error</b>: Nombre de usuario o contraseña no válido.';
		formulario();
	} else {
		$_SESSION['identificativo'] = $_POST['username'];
		header('Location: index.php?' . SID);
	}
} else {
	echo 'Usuario ya identificado.<br>';
	echo '<a href="index.php">Volver al índice</a>';
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Nombre de usuario:</td>
					<td><input type="text" name="username" value="" /></td>
				</tr>
				<tr>
					<td>Contraseña:</td>
					<td><input type="password" name="password" value="" /></td>
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
?>

</hody>
</html>