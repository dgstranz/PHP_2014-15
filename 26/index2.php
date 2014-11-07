<?php
header ('Content-Type: text/html; charset=UTF-8');
session_start();

if (!isset($_REQUEST['name']) || !isset($_REQUEST['captcha'])) {
	header('Location: index.php');
}

$name = $_REQUEST['name'];
$captcha = $_REQUEST['captcha'];

if(trim($captcha) == $_SESSION['captcha_ver']) {
	echo 'Bienvenido, ' . $name . '.';
} else {
	echo $name.', ¿eres un robot?';
}
?>