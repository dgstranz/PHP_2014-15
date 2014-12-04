<?php
require_once 'config.php';

$conn = new mysqli(SERVER, USER, PASSWORD) or die('No se pudo establecer una conexión: ' . mysqli_connect_error());

$db_create = "CREATE DATABASE IF NOT EXISTS peliculaBD
	DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci";

$peliculas = "CREATE TABLE IF NOT EXISTS peliculas (
	id int(11) NOT NULL auto_increment,
	titulo varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	genero varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	anyo int(4) NOT NULL,
	protagonista int(11) NOT NULL,
	director int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (genero) REFERENCES generos(id),
	FOREIGN KEY (protagonista) REFERENCES personas(id),
	FOREIGN KEY (director) REFERENCES personas(id)
) ENGINE = MyISAM";

$generos = "CREATE TABLE IF NOT EXISTS generos (
	id int(11) NOT NULL auto_increment,
	genero varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	PRIMARY KEY (id)
) ENGINE = MyISAM";

$personas = "CREATE TABLE IF NOT EXISTS personas (
	id int(11) NOT NULL auto_increment,
	nombre varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	esActor boolean NOT NULL,
	esDirector boolean NOT NULL,
	PRIMARY KEY (id)
) ENGINE = MyISAM";

$conn->query($db_create) or die('Error al crear la base de datos: ' . $conn->error);

$conn->select_db('peliculaBD') or die('No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error());

$conn->query($generos) or die ('Error al crear la tabla: ' . $conn->error);
$conn->query($personas) or die ('Error al crear la tabla: ' . $conn->error);
$conn->query($peliculas) or die ('Error al crear la tabla: ' . $conn->error);
?>
