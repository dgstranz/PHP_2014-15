<html>
<head>
	<title>Selección de provincias</title>
	<meta charset="utf-8">
</head>
<body>
<?php
$provincias = array(
	'Andalucía' => array('Almería', 'Cádiz', 'Córdoba', 'Granada', 'Huelva', 'Jaén', 'Málaga', 'Sevilla'),
	'Aragón' => array('Huesca', 'Teruel', 'Zaragoza'),
	'Asturias' => array('Asturias'),
	'Islas Baleares' => array('Islas Baleares'),
	'Islas Canarias' => array('Las Palmas', 'S. C. de Tenerife'),
	'Cantabria' => array('Cantabria'),
	'Castilla-La Mancha' => array('Albacete', 'Ciudad Real', 'Cuenca', 'Guadalajara', 'Toledo'),
	'Castilla y León' => array('Ávila', 'Burgos', 'León', 'Palencia', 'Salamanca', 'Segovia', 'Soria', 'Valladolid', 'Zamora'),
	'Cataluña' => array('Barcelona', 'Gerona', 'Lérida', 'Tarragona'),
	'Ceuta' => array('Ceuta'),
	'Extremadura' => array('Badajoz', 'Cáceres'),
	'Galicia' => array('La Coruña', 'Lugo', 'Orense', 'Pontevedra'),
	'Comunidad de Madrid' => array('Madrid'),
	'Melilla' => array('Melilla'),
	'Región de Murcia' => array('Murcia'),
	'Navarra' => array('Navarra'),
	'País Vasco' => array('Álava', 'Guipúzcoa', 'Vizcaya'),
	'La Rioja' => array('La Rioja'),
	'Comunidad Valenciana' => array('Alicante', 'Castellón', 'Valencia')
	);

$state = 0;
if (isset($_REQUEST['aut'])) $state++;
if (isset($_REQUEST['prov'])) $state+=2; //debería valer 3

switch ($state) {
	case 0:
		form_aut();
		break;

	case 1:
		echo 'Comunidad Autónoma: <b>' . $_REQUEST['aut'] . '</b><br>';
		form_prov();
		break;

	case 3:
		echo 'Comunidad Autónoma: <b>' . $_REQUEST['aut'] . '</b><br>';
		echo 'Provincia: <b>' . $_REQUEST['prov'] . '</b><br>';
		break;
	
	default:
		echo 'Has llegado aquí de forma errónea.';
		form_aut();
		break;
}

function form_aut() {
	global $provincias;

	echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) .'" method="POST">';
	echo '	<select name="aut">';

	foreach ($provincias as $key => $value) {
		echo '<option value="' . $key . '">' . $key . '</option>';
	}

	echo '	</select>';
	echo '	<input type="submit" value="submit">';
	echo '</form>';
}

function form_prov() {
	global $provincias;

	echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) .'" method="POST">';
	echo '	<select name="prov">';

	foreach ($provincias[$_REQUEST['aut']] as $key => $value) {
		echo '<option value="' . $value . '">' . $value . '</option>';
	}

	echo '	</select>';
	echo '	<input type="hidden" name="aut" value="' . $_REQUEST['aut'] .'">';
	echo '	<input type="submit" value="submit">';
	echo '</form>';
}

?>
</body>
</html>
