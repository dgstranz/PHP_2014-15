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

echo '<p><a href="index.php">' . $mensajes['form']['Volver atrás'] . '</a></p>';

function formulario() {
	global $mensajes;

	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>' . $mensajes['preferencias']['Tema'] . '</td>
					<td>
						<select name="tema">
							<option value="">' . $mensajes['preferencias']['Elige un tema'] . '</option>
							<option value="">----------------------</option>
							<option value="ninguno">' . $mensajes['preferencias']['Estilo por defecto'] . '</option>
							<option value="azules.css">' . $mensajes['preferencias']['Azul'] . '</option>
							<option value="rojos.css">' . $mensajes['preferencias']['Rojo'] . '</option>
							<option value="monocromo_oscuro.css">' . $mensajes['preferencias']['Monocromo con fondo oscuro'] . '</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>' . $mensajes['preferencias']['Idioma'] . '</td>
					<td>
						<select name="idioma">
							<option value="">' . $mensajes['preferencias']['Elige un idioma'] . '</option>
							<option value="">----------------------</option>
							<option value="en">English</option>
							<option value="es">Español</option>
							<option value="fr">Français</option>
							<option value="ja">日本語</option>
						</select>
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
