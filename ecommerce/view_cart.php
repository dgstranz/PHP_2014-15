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

td, th {
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

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
	$_SESSION['carrito'] = array();
	echo '<p>No tienes nada en el carrito.</p>';
} else {
	$items = '"' . implode('", "', array_keys($_SESSION['carrito'])) . '"';

	$select = 'SELECT * FROM ecomm_products
		WHERE product_code IN (' . $items . ')
		ORDER BY product_code';

	$result = $conn->query($select) or die ('Error al hacer la búsqueda: ' . $conn->error);
	while($row = $result->fetch_assoc()) {
		$producto = new Producto($row['product_code'], $row['name'], $row['description'], $row['price']);
		$productos[$row['product_code']] = $producto;
	}

	visualizar();
}

echo '<p><a href="index.php">Ver todos los productos</a></p>';

function visualizar() {
	global $productos;
	$precio_total = 0;
	echo '<table>';
	echo '<tr>';
	echo '<th>Imagen</th>';
	echo '<th>Nombre</th>';
	echo '<th>Cantidad</th>';
	echo '<th>Precio unitario</th>';
	echo '<th>Precio total</th>';
	echo '</tr>';
	foreach ($productos as $id => $item) {
		$precio_producto = $item->get_precio() * $_SESSION['carrito'][$id];
		$precio_total += $precio_producto;
		echo '<tr>';
			echo '<td><img class="thumbnail" src="imagenes/' . $id . '_t.jpg"></td>';
			echo '<td><a href="detalle.php?id=' . $id . '">' . $item->get_nombre() . '</a></td>';
			echo '<td>';
				echo '<form action="actualizar.php" method="POST">';
				echo '<input type="hidden" name="id" value="' . $id . '">';
				echo '<input type="hidden" name="action" value="change">';
				echo '<input type="number" name="qty" value="' . $_SESSION['carrito'][$id] . '"><br>';
				echo '<input type="submit" value="Change">';
				echo '</form>';
			echo '</td>';
			echo '<td>' . $item->get_precio() . ' € </td>';
			echo '<td>' . $precio_producto . ' € </td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<td colspan="4"></td>';
	echo '<th>' . $precio_total . '€ </th>';
	echo '</tr>';
	echo '</table>';

	echo '<form action="actualizar.php" method="POST">';
	echo '<input type="hidden" name="action" value="delete">';
	echo '<input type="submit" value="Empty Cart">';
	echo '</form>';
}

?>
</body>
</html>