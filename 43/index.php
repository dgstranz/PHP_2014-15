<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
require_once('../PHPMailer/class.phpmailer.php');
require_once('../PHPMailer/PHPMailerAutoload.php');
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
$mail->AddReplyTo('', 'Servidor');
$mail->SetFrom('', 'Servidor');
$mail->AddReplyTo('', 'Servidor');

$mail->AddAddress('', '');

$mail->Subject = 'Prueba de correo electrónico por Sendmail';

$mensaje = 'Když se Řehoř Samsa jednou ráno probudil z nepokojných snů, shledal, že se v posteli proměnil v jakýsi nestvůrný hmyz. Ležel na hřbetě tvrdém jak pancíř, a když trochu nadzvedl hlavu, uviděl své vyklenuté, hnědé břicho rozdělené obloukovitými výztuhami, na jehož vrcholu se sotva ještě držela přikrývka a tak tak že úplně nesklouzla dolů. Jeho četné, vzhledem k ostatnímu objemu žalostně tenké nohy se mu bezmocně komíhaly před očima. Co se to se mnou stalo? pomyslel si. Nebyl to sen. Jeho pokoj, správný, jen trochu příliš malý lidský pokoj, spočíval klidně mezi čtyřmi dobře známými stěnami, Nad stolem, na němž byla rozložena vybalená kolekce vzorků soukenného zboží - Samsa byl obchodní cestující -, visel obrázek, který si nedávno vystřihl z jednoho ilustrovaného časopisu a zasadil do pěkného pozlaceného rámu. Představoval dámu, opatřenou kožešinovou čapkou a kožešinovým boa, jak vzpřímeně sedí a nastavuje divákovi těžký kožešinový rukávník, v němž se jí ztrácí celé předloktí. Řehořův pohled se pak obrátil k oknu a pošmourné počasí - bylo slyšet, jak kapky deště dopadají na okenní plech - ho naplnilo melancholií. Co kdybych si ještě trochu pospal a zapomněl na všechny blázniviny, pomyslel si, to však bylo naprosto neproveditelné, neboť byl zvyklý spát na pravém boku, v nynějším stavu se však do této polohy nemohl dostat. Ať sebou házel sebevětší silou na pravý bok, vždycky se zase zhoupl zpátky naznak. Zkoušel to snad stokrát, zavřel oči, aby se nemusel dívat na zmítající se nohy, a přestal, až když ucítil v boku lehkou, tupou bolest, jakou ještě nikdy nepocítil. Ach bože, pomyslel si, jaké jsem si to vybral namáhavé povolání! Den co den na cestách. Zlobení s prací je mnohem víc než přímo v obchodě doma, a k tomu ještě ten kříž s cestováním, starosti o vlaková spojení, nepravidelné, špatné jídlo, stále se střídající známosti, jež nikdy nenabudou trvalosti, srdečnosti. Aby to všechno čert vzal! Ucítil nahoře na břiše slabé svědění; pomalu se sunul po hřbetě k čelu postele, aby mohl lépe zvednout hlavu; našel svědící místo, poseté spoustou drobných bílých teček, které nedovedl posoudit; a chtěl to místo jednou nohou ohmatat, hned ji však stáhl zpátky, neboť při dotyku ho hrůzou zamrazilo.';
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

?>
</body>
</html>

