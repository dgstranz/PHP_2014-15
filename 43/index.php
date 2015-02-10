<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
require_once('../PHPMailer/class.phpmailer.php');
require_once('../PHPMailer/PHPMailerAutoload.php');

if (!isset($_POST['nombre']) || !isset($_POST['email']) || !isset($_POST['mensaje'])) {
	formulario();
} elseif (empty(trim($_POST['nombre'])) || empty(trim($_POST['email'])) || empty(trim($_POST['mensaje']))) {
	echo '<b>Error</b>: debe indicarse como mínimo el nombre, el email y el mensaje que se desea enviar.';
	formulario();
} elseif (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $_POST['email'])) {
	echo '<b>Error</b>: correo electrónico no válido.';
	formulario();
} else {
	enviar_correo($_POST['nombre'], $_POST['email'], $_POST['mensaje']);
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
			<td>Teléfono</td>
			<td><input type="tel" name="tel" value="' . (isset($_POST['tel']) ? $_POST['tel'] : '') . '"></td>
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

function enviar_correo($nombre, $email, $mensaje) {
	include('config.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->CharSet = 'UTF-8';

	$mail->Username = $user;
	$mail->Password = $pass;

	// Rellenas aquí los datos
	$mail->SetFrom('', 'Servidor');
	$mail->AddReplyTo($email, $nombre);

	$mail->AddAddress('', '');

	$mail->Subject = 'Prueba de correo electrónico por Sendmail';

	$mensaje = wordwrap($mensaje, 78, "\r\n");

	$mail->MsgHTML($mensaje);
	$mail->AltBody = strip_tags($mensaje);

	$cabeceras = 'From: webmaster@example.com' . "\r\n" .
	    'Reply-To: webmaster@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	if($mail->Send()) {
		echo 'Correo enviado';
	} else {
		echo 'Error: ' . $mail->ErrorInfo;
	}
}

?>
</body>
</html>

