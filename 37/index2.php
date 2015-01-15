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

if (isset($_POST['tipo'])) {
	$_SESSION['tipo'] = $_POST['tipo'];
} elseif (!isset($_SESSION['tipo'])) {
	header('Location: index.php');
}

cabecera(2);
formulario();
busqueda();

function formulario() {
	global $zonas;

	echo '<form action="index3.php" method="post">
			<p><span class="paso">Paso 2: Elija la zona de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<td>Zona:</td>
						<td>
							<select name="zona">';

		foreach ($zonas as $key => $value) {
			echo '<option value="' . $key . '">' . $value . '</option>';
		}
		
		echo '					</select>
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
	global $tipos;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . '</span>';
}
?>

</hody>
</html>
