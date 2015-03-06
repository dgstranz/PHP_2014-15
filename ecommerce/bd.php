<?php
require_once 'conexion.php';

if (!$conn = new mysqli(SERVER, USER, PASSWORD)) {
	echo 'No se ha podido establecer una conexión: ' . mysqli_connect_error();
	die();
} elseif(!$result = $conn->select_db('ecommerce')) {
	require_once('creacion.php');
	header('Location: ' . $_SERVER['PHP_SELF']);
	die();
} elseif (!$result = $conn->set_charset('utf8')) {
	echo 'Error al establecer UTF-8 como juego de caracteres predeterminado: ' . $conn->error;
	die();
}

?>
