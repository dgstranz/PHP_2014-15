<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
	<link rel='stylesheet' type='text/css' href='estilo.css'>
</head>
<body>

<?php
session_start();
include 'cabecera.php';
include 'opciones.php';

if (isset($_POST['back'])) {
	header('Location: index2.php');
} elseif (isset($_POST['dormitorios']) && isset($_POST['precio'])) {
	$_SESSION['dormitorios'] = $_POST['dormitorios'];
	$_SESSION['precio'] = $_POST['precio'];
} elseif (!isset($_SESSION['dormitorios']) || !isset($_SESSION['precio'])) {
	header('Location: index3.php');
}

cabecera(4);
formulario();
busqueda();
var_dump($_SESSION);

function formulario() {
	echo '<form action="index5.php" method="post">
			<p><span class="paso">Paso 4: Elija las características extra de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<td>Extras:</td>
						<td>
							<input type="checkbox" name="piscina">Piscina' . "\t" . '
							<input type="checkbox" name="jardin">Jardín' . "\t" . '
							<input type="checkbox" name="garaje">Garaje
						</td>
					</tr>
					<tr>
						<td class="buttons" colspan="2">
							<input type="submit" name="back" value="&lt; Atrás" />
							<input type="submit" name="submit" value="Siguiente >" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>';
}

function busqueda() {
	global $tipos, $zonas;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $zonas[$_SESSION['zona']] . '</span>';
}
?>

</hody>
</html>
