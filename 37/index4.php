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

if (isset($_POST['zona'])) {
	$_SESSION['zona'] = $_POST['zona'];
} elseif (!isset($_SESSION['zona'])) {
	header('Location: index.php');
}

cabecera(4);
formulario();
busqueda();

function formulario() {
	echo '<form action="buscar.php" method="post">
			<p><span class="paso">Paso 4: Elija las características extra de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<td>Extras:</td>
						<td>
							<input type="checkbox" name="piscina">Piscina<br>
							<input type="checkbox" name="jardin">Jardín<br>
							<input type="checkbox" name="piscina">Garaje
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
