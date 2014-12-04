<?php
// FUNCIONES DE PELÍCULA
// ---------------------

function buscar_pelicula($titulo) {
	global $conn;

	$select = "SELECT * FROM peliculas
				WHERE titulo = '" . $titulo . "'";
	$result = $conn->query($select);
	$fila = $result->fetch_assoc();
	return $fila;
}

function insertar_pelicula($pelicula) {
	global $conn;

	$insert = "INSERT INTO peliculas (titulo, genero, anyo, protagonista, director)
				VALUES ('" . $pelicula->titulo . "','"
						. $pelicula->genero . "','"
						. $pelicula->anyo . "','"
						. $pelicula->protagonista . "','"
						. $pelicula->director . "')";
	return ($conn->query($insert));
}

// FUNCIONES DE GÉNERO
// -------------------

function buscar_genero($genero) {
	global $conn;

	$select = "SELECT * FROM generos
				WHERE genero = '" . $genero . "'";
	$result = $conn->query($select);
	$fila = $result->fetch_assoc();
	return $fila;
}

function cargar_generos() {
	global $conn;

	$search = "SELECT id, genero FROM generos
		ORDER BY genero";
	$result = $conn->query($search);

	return $result;
}

function insertar_genero($genero) {
	global $conn;

	$insert = "INSERT INTO generos (genero)
				VALUES ('" . $genero . "')";
	return ($conn->query($insert));
}

// FUNCIONES DE ACTOR/DIRECTOR
// ---------------------------
function buscar_persona($nombre) {
	global $conn;

	$select = "SELECT * FROM personas
				WHERE nombre = '" . $nombre . "'";
	$result = $conn->query($select);
	$fila = $result->fetch_assoc();
	return $fila;
}

function insertar_persona($persona) {
	global $conn;

	$insert = "INSERT INTO personas (nombre, esActor, esDirector)
				VALUES ('" . $persona->nombre . "','"
						. $persona->esActor . "','"
						. $persona->esDirector . "')";
	return ($conn->query($insert));
}

function modificar_profesion($persona_id, $atributo, $valor) {
	global $conn;

	if ($atributo == 'esActor' || $atributo == 'esDirector') {
		$update = "UPDATE personas
					SET " . $atributo . " = " . $valor . "
					WHERE id = '" . $persona_id . "'";
		return ($conn->query($update));
	} else {
		return false;
	}
}
?>
