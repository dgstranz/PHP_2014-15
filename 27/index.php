<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

if (!isset($_POST['arbol']) || !isset($_POST['tronco'])) {
	formulario();
} else {
	pintar_arbol($_POST['arbol'], $_POST['tronco']);
}

function pintar_arbol($arbol, $tronco) {
	echo '<center>';
	for ($i=1; $i < $arbol; $i++) {
		for ($j=0; $j < $i; $j++) {
			echo '*';
		}
		echo '<br>';
	}
	for ($i=0; $i < $tronco; $i++) { 
		echo '**<br>';
	}
	echo '</center>';
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
	echo '<table>';
	echo '	<tr>';
	echo '		<td>Tamaño del árbol:</td>';
	echo '		<td><input type="number" name="arbol"></td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td>Longitud del tronco</td>';
	echo '		<td><input type="number" name="tronco"></td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td colspan="2"><input type="submit" value="Enviar"></td>';
	echo '	</tr>';
	echo '</table>';
	echo '</form>';
}
?>
</body>
</html>