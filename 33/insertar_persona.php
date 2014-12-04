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
	echo '<b>Error</b>: Debe indicarse el nombre.';
	formulario();
} elseif (!isset($_POST['esActor']) && !isset($_POST['esDirector'])) {
	echo '<b>Error</b>: Debe indicarse alguna ocupación.';
	formulario();
} elseif (buscar_persona($_POST['nombre'])) {
	echo '<b>Error</b>: Este actor o director ya existe en la base de datos.';
} else {
	$mi_persona = new Persona($_POST['nombre'], isset($_POST['esActor']), isset($_POST['esDirector']));
	echo $mi_persona->nombre;

	insertar_persona($mi_persona);
}

echo '<p><a href="index.php">Volver atrás</a></p>';

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . '" /></td>
				</tr>
				<tr>
					<td>Ocupaciones:</td>
					<td>
						<input type="checkbox" name="esActor" value="true" ' . (isset($_POST['esActor']) ? 'checked ' : '') . '/>Actor<br>
						<input type="checkbox" name="esDirector" value="true" ' . (isset($_POST['esDirector']) ? 'checked ' : '') . '/>Director<br>
					</td>
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
</body>
</html>
