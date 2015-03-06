<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

session_start();

require_once('carrito.php');
require_once('bd.php');

if (!isset($_SESSION['id'])) {
	$_SESSION['sessid'] = session_id();
}

if (!isset($_SESSION['carrito'])) {
	$_SESSION['carrito'] = array();
}

if (!isset($_GET['id'])) {
	echo 'Error';
}

visualizar($_GET['id']);

function visualizar($id) {
	global $conn;

	$select = 'SELECT * FROM ecomm_products
		WHERE product_code = "' . $id . '"
		ORDER BY product_code';

	$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);
	if(!$row = $result->fetch_assoc()) {
		echo '<p>Error: el producto indicado no existe</p>';
		echo '<p><a href="index.php">Volver al índice</a></p>';
		echo '<p><a href="view_cart.php">Ver carrito</a></p>';
	} else {
		echo '<form action="actualizar.php" method="POST">';
		echo '<input type="hidden" name="id" value="' . $row['product_code'] . '">';
		echo '<table>';
		echo '<tr>';
		echo '<td rowspan="6">';
		echo '<img src="imagenes/' . $row['product_code'] . '.jpg"></td>';
		echo '</td>';
		echo '<td><h1>' . $row['name'] . '</h1></td></tr>';
		echo '<tr><td><p>' . $row['description'] . '</p></td></tr>';
		echo '<tr><td><b>Código del producto</b>: ' . $row['product_code'] . '</td></tr>';
		echo '<tr><td><b>Precio</b>: ' . $row['price'] . ' €</td></tr>';
		echo '<tr><td>';
			echo '<b>Cantidad</b>: ';
			echo '<input type="number" name="qty" min="0" value="' . (isset($_SESSION['carrito'][$id]) ? $_SESSION['carrito'][$id] : 0) . '">';
			if (isset($_SESSION['carrito'][$id])) {
				echo '<input type="hidden" name="action" value="change" />';
				echo '<input type="submit" value="Change quantity" />';
			} else {
				echo '<input type="hidden" name="action" value="add" />';
				echo '<input type="submit" value="Add to cart" />';
			}
		echo '</tr></td>';
		echo '<tr><td>';
		echo '<p><a href="index.php">Volver al índice</a></p>';
		echo '<p><a href="view_cart.php">Ver carrito</a></p>';
		echo '</td></tr>';
		echo '</table>';
		echo '</form>';
	}
}

?>
</body>
</html>