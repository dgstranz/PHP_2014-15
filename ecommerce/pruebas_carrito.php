<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

require_once('carrito.php');

$carrito = new Carrito();

var_dump($carrito);

$producto1 = new Producto(1, 'taza', '', 3);
$producto2 = new Producto(2, 'cuchara', '', 4);
$producto3 = new Producto(3, 'plato', '', 5);
$producto4 = new Producto(5, 'plato', '', 5);

$carrito->introduce_producto($producto1, 4);
$carrito->introduce_producto($producto1, 5);
$carrito->introduce_producto($producto3, 6);
$carrito->introduce_producto($producto1, 5);

var_dump($carrito);

$carrito->visualizar();


?>
</body>
</html>