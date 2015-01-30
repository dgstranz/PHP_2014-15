<?php
require_once 'config.php';

$db_create = "CREATE DATABASE IF NOT EXISTS inmobiliaria
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci";

$viviendas = "CREATE TABLE IF NOT EXISTS viviendas (
	id int(11) NOT NULL auto_increment,
	tipo int(2) NOT NULL,
	provincia int(2) NOT NULL,
	dormitorios int(3) NOT NULL,
	precio int(11) NOT NULL,
	piscina boolean NOT NULL,
	jardin boolean NOT NULL,
	garaje boolean NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (tipo) REFERENCES tipos(id),
	FOREIGN KEY (provincia) REFERENCES provincias(id)
) ENGINE = MyISAM";

$tipos = "CREATE TABLE IF NOT EXISTS tipos (
	id int(2) NOT NULL auto_increment,
	tipo varchar(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = MyISAM";

$provincias = "CREATE TABLE IF NOT EXISTS provincias (
	id int(2) NOT NULL,
	nombre_es varchar(30) NOT NULL,
	nombre_coof varchar(30),
	PRIMARY KEY (id)
) ENGINE = MyISAM";

if (!$result = $conn->query($db_create)) {
	echo 'Error al crear la base de datos: ' . $conn->error;
	die();
}


if (!$result = $conn->select_db('inmobiliaria')) {
	echo 'No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error();
	die();
}

if (!$result = $conn->set_charset('utf8')) {
	echo 'Error al establecer UTF-8 como juego de caracteres predeterminado: ' . $conn->error;
	die();
}

if (!$result = $conn->query($tipos)) {
	echo 'Error al crear la tabla Tipos: ' . $conn->error;
	die();
}
if (!$result = $conn->query($provincias)) {
	echo 'Error al crear la tabla Provincias: ' . $conn->error;
	die();
}
if (!$result = $conn->query($viviendas)) {
	echo 'Error al crear la tabla Viviendas: ' . $conn->error;
	die();
}

$insert_provincias = "INSERT INTO provincias (id, nombre_es, nombre_coof) VALUES
	(1, 'Álava', 'Araba'),
	(2, 'Albacete', NULL),
	(3, 'Alicante', 'Alacant'),
	(4, 'Almería', NULL),
	(5, 'Ávila', NULL),
	(6, 'Badajoz', NULL),
	(7, 'Baleares', 'Balears'),
	(8, 'Barcelona', NULL),
	(9, 'Burgos', NULL),
	(10, 'Cáceres', NULL),
	(11, 'Cádiz', NULL),
	(12, 'Castellón', 'Castelló'),
	(13, 'Ciudad Real', NULL),
	(14, 'Córdoba', NULL),
	(15, 'La Coruña', 'A Coruña'),
	(16, 'Cuenca', NULL),
	(17, 'Gerona', 'Girona'),
	(18, 'Granada', NULL),
	(19, 'Guadalajara', NULL),
	(20, 'Guipúzcoa', 'Gipuzkoa'),
	(21, 'Huelva', NULL),
	(22, 'Huesca', NULL),
	(23, 'Jaén', NULL),
	(24, 'León', NULL),
	(25, 'Lérida', 'Lleida'),
	(26, 'La Rioja', NULL),
	(27, 'Lugo', NULL),
	(28, 'Madrid', NULL),
	(29, 'Málaga', NULL),
	(30, 'Murcia', NULL),
	(31, 'Navarra', NULL),
	(32, 'Orense', 'Ourense'),
	(33, 'Asturias', NULL),
	(34, 'Palencia', NULL),
	(35, 'Las Palmas', NULL),
	(36, 'Pontevedra', NULL),
	(37, 'Salamanca', NULL),
	(38, 'Santa Cruz de Tenerife', NULL),
	(39, 'Cantabria', NULL),
	(40, 'Segovia', NULL),
	(41, 'Sevilla', NULL),
	(42, 'Soria', NULL),
	(43, 'Tarragona', NULL),
	(44, 'Teruel', NULL),
	(45, 'Toledo', NULL),
	(46, 'Valencia', 'València'),
	(47, 'Valladolid', NULL),
	(48, 'Vizcaya', 'Bizkaia'),
	(49, 'Zamora', NULL),
	(50, 'Zaragoza', NULL),
	(51, 'Ceuta', NULL),
	(52, 'Melilla', NULL);
";

$insert_tipos = "INSERT INTO tipos (tipo) VALUES
	('piso'), ('chalet'), ('apartamento'), ('dúplex'), ('ático');
";

$insert_viviendas = "INSERT INTO viviendas
	(tipo, provincia, dormitorios, precio, piscina, jardin, garaje)
	VALUES
	(0, 28, 2, 180000, false, false, true),
	(1, 28, 4, 720000, true, true, true),
	(1, 28, 3, 596000, false, true, true),
	(0, 28, 1, 108000, false, false, false),
	(0, 28, 2, 173000, false, false, false),
	(0, 28, 2, 165000, false, false, false),
	(0, 28, 1, 74000, false, false, false),
	(0, 28, 3, 216000, false, false, true),
	(0, 28, 4, 245000, false, false, true),
	(1, 13, 2, 93000, false, false, false),
	(0, 13, 2, 84000, false, false, true);
";

$filas = $conn->query("SELECT id FROM provincias")->num_rows;
if ($filas == 0) {
	if (!$result = $conn->query($insert_provincias)) {
		echo 'Error al insertar los datos en la tabla Provincias: ' . $conn->error;
		die();
	}
}

$filas = $conn->query("SELECT id FROM tipos")->num_rows;
if ($filas == 0) {
	if (!$result = $conn->query($insert_tipos)) {
		echo 'Error al insertar los datos en la tabla Tipos: ' . $conn->error;
		die();
	}
}

$filas = $conn->query("SELECT id FROM viviendas")->num_rows;
if ($filas == 0) {
	if (!$result = $conn->query($insert_viviendas)) {
		echo 'Error al insertar los datos en la tabla Viviendas: ' . $conn->error;
		die();
	}
}

?>
