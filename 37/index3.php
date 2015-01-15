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
	header('Location: index.php');
} elseif (isset($_POST['zona'])) {
	$_SESSION['zona'] = $_POST['zona'];
} elseif (!isset($_SESSION['zona'])) {
	header('Location: index2.php');
}

cabecera(3);
formulario();
busqueda();
var_dump($_SESSION);

function formulario() {
	global $dormitorios;
	global $precios;

	echo '<form action="index4.php" method="post">
			<p><span class="paso">Paso 3: Elija las características básicas de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<td>Número de dormitorios:</td>
						<td>';

		foreach ($dormitorios as $key => $value) {
			echo '<input type="radio" name="dormitorios" value="' . $key . '">' . $value . "\t";
		}
		
		echo '			</td>
					</tr>
					<tr>
						<td>Precio:</td>
						<td>';

		foreach ($precios as $key => $value) {
			echo '<input type="radio" name="precio" value="' . $key . '">' . $value . '<br>';
		}
		
		echo '			</td>
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
