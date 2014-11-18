<?php
require_once 'config.php';

$conn = new mysqli(SERVER, USER, PASSWORD) or die('No se pudo establecer una conexión: ' . mysqli_connect_error());

$db_create = "CREATE DATABASE IF NOT EXISTS libroBD
	DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci";

$table_create = "CREATE TABLE IF NOT EXISTS libros (
	id int(11) NOT NULL auto_increment,
	titulo varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	autor varchar(255) COLLATE latin1_spanish_ci NOT NULL,
	PRIMARY KEY (id)
) CHARACTER SET latin1 COLLATE latin1_spanish_ci";

$conn->query($db_create) or die('Error al crear la base de datos: ' . $conn->error);

$conn->select_db('libroBD') or die('No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error());

$conn->query($table_create) or die ('Error al crear la tabla: ' . $conn->error);
?>