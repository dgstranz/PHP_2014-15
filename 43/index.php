<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
require_once('../PHPMailer/class.phpmailer.php');
require_once('../PHPMailer/PHPMailerAutoload.php');

if (!isset($_POST['nombre']) || !isset($_POST['email']) || !isset($_POST['titulo']) || !isset($_POST['mensaje'])) {
	formulario();
} elseif (empty(trim($_POST['nombre'])) || empty(trim($_POST['email'])) || empty(trim($_POST['titulo'])) || empty(trim($_POST['mensaje']))) {
	echo '<p class="error"><b>Error</b>: debe indicarse como mínimo el nombre, el email y el mensaje que se desea enviar.</p>';
	formulario();
} elseif (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $_POST['email'])) {
	echo '<p class="error"><b>Error</b>: correo electrónico no válido.</p>';
	formulario();
} else {
	enviar_correo($_POST['nombre'], $_POST['email'], $_POST['titulo'], $_POST['mensaje']);
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
	<table>
		<tr>
			<td>Nombre</td>
			<td><input type="text" name="nombre" value="' . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . '"></td>
		</tr>
		<tr>
			<td>Empresa</td>
			<td><input type="text" name="empresa" value="' . (isset($_POST['empresa']) ? $_POST['empresa'] : '') . '"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="email" value="' . (isset($_POST['email']) ? $_POST['email'] : '') . '"></td>
		</tr>
		<tr>
			<td>Asunto</td>
			<td><input type="text" name="titulo" value="' . (isset($_POST['titulo']) ? $_POST['titulo'] : '') . '"></td>
		</tr>
		<tr>
			<td>Mensaje</td>
			<td><textarea rows="8" cols="50" name="mensaje">' . (isset($_POST['mensaje']) ? $_POST['mensaje'] : '') . '</textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Enviar"></td>
		</tr>
	</table>
	</form>';
}

function enviar_correo($nombre, $email, $titulo, $mensaje) {
	include('config.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->CharSet = 'UTF-8';

	$mail->Username = $mi_email;
	$mail->Password = $mi_pass;

	$mail->SetFrom($mi_email, $mi_nombre);
	$mail->AddReplyTo($mi_email, $mi_nombre);

	$mail->AddAddress($email, $nombre);

	$mail->Subject = $titulo;

	$mail->IsHTML();

	$mensaje = wordwrap($mensaje, 78, "\r\n");

	$mail->AltBody = 'Lo sentimos, tu visor de correo no permite visualizar HTML.';
	$mail->MsgHTML($mensaje);

	if($mail->Send()) {
		echo '<p class="exito">Correo enviado</p>';
	} else {
		echo '<p class="error"><b>Error</b>: ' . $mail->ErrorInfo . '</p>';
	}
}

?>
</body>
</html>

