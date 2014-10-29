<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
$campos = array('Nombre', 'Dirección', 'Teléfono', 'E-mail');
$agenda = array(
			array('Juan Palomo', 'C/ Guisantes 13', '678 901 234', 'yomeloguiso@yomelocomo.com'),
			array('Francisco Nicolás', 'Av. Contacto', '666 123 456', 'conozco@pecesgordos.es'),
			array('Fulanito Pérez', 'C/ Anónimo, s/n', '600 700 800', 'nombrealuso@servidoraluso.com')
		);

if (!isset($_POST['id'])) {
	print_form();
} elseif (isset($_POST['all'])) {
	print_agenda();
} elseif (isset($_POST['one'])) {
	if (!isset($_POST['contact']) || $_POST['contact'] < 0 || $_POST['contact'] >= sizeof($agenda)) {
		echo '<b>Error</b>: No se ha escogido ningún contacto, o se ha escogido uno que no existe.<br>';
		print_form();
	} else {
		print_contact($_POST['contact']);
	}
}

function print_form() {
	global $agenda;
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
	echo '<input type="hidden" name="id" value="ejemplo"></input>';
	echo '<table>';
	echo '	<tr>';
	echo '		<td colspan="2">';

	echo 'Contacto: <select name="contact">';
	echo '<option value="-1"></option>';
	foreach ($agenda as $key => $value) {
		echo '<option value="' . $key . '">' . $agenda[$key][0] . '</option>';
	}
	echo '</select>';
	echo '		</td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td><input type="submit" name="one" value="Buscar contacto"></td>';
	echo '		<td><input type="submit" name="all" value="Visualizar agenda"></td>';
	echo '	</tr>';
	echo '</table>';
	echo '</form>';
}

function print_contact($contact) {
	global $campos, $agenda;
	foreach ($campos as $key => $value) {
		echo '<b>' . $value . '</b>: ' . $agenda[$contact][$key] . '<br>';
	}
}

function print_agenda() {
	global $campos, $agenda;
	echo '<table>';
	echo '	<tr>';
	foreach ($campos as $key => $value) {
		echo '<th>' . $value . '</th>';
	}
	echo '</tr>';
	foreach ($agenda as $a_key => $a_value) {
		echo '<tr>';
		foreach ($campos as $c_key => $c_value) {
			echo '<td>' . $agenda[$a_key][$c_key] . '</td>';
		}
		echo '</tr>';
	}
	echo '</tr>';
	echo '</table>';
}

?>
</body>
</html>