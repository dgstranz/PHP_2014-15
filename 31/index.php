<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>
<?php
require_once('bd.php');

if (!isset($_POST['titulo']) || !isset($_POST['autor'])) {
	formulario();
} elseif (empty($_POST['titulo']) || empty($_POST['autor'])) {
	echo '<b>Error</b>: Los campos no pueden estar vacíos.';
	formulario();
} else {
	if (!$link->set_charset('utf8')) {
    	printf("Error cargando el conjunto de caracteres UTF-8: %s\n", $link->error);
    }
	$insert = "INSERT INTO libros (titulo, autor)
			VALUES ('" . $_POST['titulo'] . "','" . $_POST['autor'] . "')";
	$link->query($insert) or die('Error: ' . mysqli_error($link));
}

function formulario() {
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table>
				<tr>
					<td>Autor:</td>
					<td><input type="text" name="titulo" value="" /></td>
				</tr>
				<tr>
					<td>Título:</td>
					<td><input type="text" name="autor" value="" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Enviar" />
						<input type="reset" value="Borrar" />
					</td>
				</tr>
			</table>
		</form>';
}
?>
</hody>
</html>