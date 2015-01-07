<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
session_start();
require_once('bd.php');
require_once('clases.php');
require_once('funciones_bd.php');

if (!isset($_POST['genero'])) {
	formulario();
} elseif (empty($_POST['genero'])) {
	echo $mensajes['form']['Error'] . 'El campo no puede estar vacío.';
	formulario();
} elseif (buscar_genero($_POST['genero'])) {
	echo $mensajes['form']['Error'] . 'Este género ya existe en la base de datos.';
} else {
	insertar_genero($_POST['genero']);
}

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function formulario() {
	global $mensajes;

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>' . $mensajes['insertar_genero']['Nombre:'] . '</td>
					<td><input type="text" name="genero" value="' . (isset($_POST['genero']) ? $_POST['genero'] : '') . '" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="' . $mensajes['form']['Enviar'] . '" />
						<input type="reset" value="' . $mensajes['form']['Borrar'] . '" />
					</td>
				</tr>
			</table>
		</form>';
}
?>
</body>
</html>
