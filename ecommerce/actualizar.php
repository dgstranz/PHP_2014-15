<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

session_start();

require_once('carrito.php');
require_once('bd.php');

if (!isset($_POST['action'])) {
	echo 'No hay nada que actualizar, o no se ha pasado correctamente por el formulario.';
} elseif ($_POST['action'] == 'delete') {
	unset($_SESSION['carrito']);
	echo 'Carrito eliminado';
} elseif ($_POST['action'] == 'add' || $_POST['action'] == 'change') {
	if(!isset($_POST['id']) || !isset($_POST['qty'])) {
		echo 'No hay nada que actualizar, o no se ha pasado correctamente por el formulario.';
	} else {
		$select = 'SELECT product_code FROM ecomm_products
			WHERE product_code = "' . $_POST['id'] . '"
			ORDER BY product_code';

		$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);
		if(!$row = $result->fetch_assoc()) {
			echo 'Producto no encontrado';
		} elseif ($_POST['action'] == 'change') {
			if ($_POST['qty'] > 0) {
				$_SESSION['carrito'][$_POST['id']] = $_POST['qty'];
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {
				unset($_SESSION['carrito'][$_POST['id']]);
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		} elseif ($_POST['action'] == 'add') {
			if ($_POST['qty'] > 0) {
				$_SESSION['carrito'][$_POST['id']] = $_POST['qty'];
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} elseif ($_POST['qty'] == 0) {
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {
				echo 'No se puede pedir un número negativo de productos.';
			}
		}
	}
} else {
	echo 'No sé qué quieres hacer.';
}

echo '<p><a href="index.php">Volver al índice</a></p>';
echo '<p><a href="view_cart.php">Ver carrito</a></p>';

?>
</body>
</html>