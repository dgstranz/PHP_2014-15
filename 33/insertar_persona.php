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

if (!isset($_POST['nombre'])) {
	formulario();
} elseif (empty($_POST['nombre'])) {
	echo $mensajes['form']['Error'] . $mensajes['insertar_persona']['Error falta nombre'];
	formulario();
} elseif (!isset($_POST['esActor']) && !isset($_POST['esDirector'])) {
	echo $mensajes['form']['Error'] . $mensajes['insertar_persona']['Error falta ocupación'];
	formulario();
} elseif (buscar_persona($_POST['nombre'])) {
	echo $mensajes['form']['Error'] . $mensajes['insertar_persona']['Error persona ya existe'];
} else {
	$mi_persona = new Persona($_POST['nombre'], isset($_POST['esActor']), isset($_POST['esDirector']));

	insertar_persona($mi_persona);
}

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function formulario() {
	global $mensajes;

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>' . $mensajes['insertar_persona']['Nombre'] . '</td>
					<td><input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . '" /></td>
				</tr>
				<tr>
					<td>' . $mensajes['insertar_persona']['Ocupaciones'] . '</td>
					<td>
						<input type="checkbox" name="esActor" value="true" ' . (isset($_POST['esActor']) ? 'checked ' : '') . '/>Actor<br>
						<input type="checkbox" name="esDirector" value="true" ' . (isset($_POST['esDirector']) ? 'checked ' : '') . '/>Director<br>
					</td>
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
