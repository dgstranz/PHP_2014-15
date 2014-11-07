<?php
// Establecer el tipo de contenido
header('Content-Type: image/jpeg');
session_start();

// Crear la imagen
$im = imagecreatefromjpeg('fondo.jpg');
$width = imagesx($im);
$height = imagesy($im);

// Número de caracteres y tipografía
$text = '';
$numchars = rand(4,10);
$font = 'arial.ttf';

// Generar y añadir el texto
for ($i=0; $i < $numchars; $i++) {
	$angle = rand(-30, 30);
	$base_size = $width / ($numchars + 1);
	$x = ($i + 0.5) * $base_size;
	$y = 0.5 * ($height + $base_size * rand(-1, 1));
	$size = 0.8 * $base_size;
	$color = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));
	$ascii = rand(1, 62);
	if ($ascii <= 10) {
		$ascii += 47; // rango 48-57, 0-9
	} elseif ($ascii <= 36) {
		$ascii += 54; // rango 65-90, A-Z
	} else {
		$ascii += 60; // rango 97-122, a-z
	}

	$char = chr($ascii);
	$text .= $char;
	imagettftext($im, $size, $angle, $x, $y, $color, $font, $char);
}
$_SESSION['captcha_ver'] = $text;

imagejpeg($im);
?>