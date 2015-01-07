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

var_dump($_POST);
var_dump($_COOKIE);

if (!isset($_POST['tema']) || !isset($_POST['idioma'])) {
	formulario();
} else {
	$duracion_anyo = 365 * 24 * 60 * 60;
	if (!empty($_POST['tema']) && $_POST['tema'] !== 'ninguno') {
		setcookie('tema', $_POST['tema'], time() + $duracion_anyo);
	} else {
		setcookie('tema', '', time() - 3600);
	}

	if (!empty($_POST['idioma'])) {
		setcookie('idioma', $_POST['idioma'], time() + $duracion_anyo);
	} else {
		setcookie('idioma', '', time() - 3600);
	}

	header('Location: ' .  $_SERVER['PHP_SELF']);
}

echo '<p><a href="index.php">Volver atrás</a></p>';

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Tema:</td>
					<td>
						<select name="tema">
							<option value="">Elige un tema</option>
							<option value="">----------------------</option>
							<option value="ninguno">Estilo por defecto</option>
							<option value="azules.css">Azul</option>
							<option value="rojos.css">Rojo</option>
							<option value="monocromo_oscuro.css">Monocromo con fondo oscuro</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Idioma:</td>
					<td>
						<select name="idioma">
							<option value="">Elige un idioma</option>
							<option value="">----------------------</option>
							<option value="en">English</option>
							<option value="es">Español</option>
							<option value="fr">Français</option>
							<option value="de">Deutsch</option>
							<option value="pl">Polski</option>
							<option value="fi">Suomi</option>
						</select>
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
