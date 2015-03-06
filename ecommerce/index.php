<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<style>
.thumbnail {
	height: 100px;
}

table {
	border: 1px solid black;
}

td {
	border: 1px solid rgb(192, 192, 192);
}
</style>
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

$productos = array();

$select = 'SELECT * FROM ecomm_products 
	ORDER BY product_code';

$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);
while($row = $result->fetch_assoc()) {
	$producto = new Producto($row['product_code'], $row['name'], $row['description'], $row['price']);
	$productos[$row['product_code']] = $producto;
}

visualizar();

echo '<a href="view_cart.php">Ver carrito</a>';

function visualizar() {
	global $productos;
	echo '<table>';
	foreach ($productos as $id => $item) {
		echo '<tr>';
			echo '<td><img class="thumbnail" src="imagenes/' . $id . '_t.jpg"></td>';
			echo '<td><a href="detalle.php?id=' . $id . '">' . $item->get_nombre() . '</a></td>';
			echo '<td>' . $item->get_precio() . ' €</td>';
		echo '</tr>';
	}
	echo '</table>';
}

?>
</body>
</html>