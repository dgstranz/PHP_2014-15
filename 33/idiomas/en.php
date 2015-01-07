<?php
$mensajes = array();

// bd.php
//$mensajes['bd'] = array();

$mensajes['bd']['No conexión'] = 'Could not establish a connection: ';
$mensajes['bd']['Error BD'] = 'Failed to create the database: ';
$mensajes['bd']['No conexión BD'] = 'Could not establish a connection to the database: ';
$mensajes['bd']['Error codificación'] = 'Failed to set UTF-8 as the default charset: ';
$mensajes['bd']['Error crear tabla'] = 'Failed to create the table: ';

// index.php
$mensajes['index']['Películas'] = 'Movies';
$mensajes['index']['Editar preferencias'] = 'Edit settings';
$mensajes['index']['Nueva película'] = 'Enter new movie';
$mensajes['index']['Nuevo género'] = 'Enter new genre';
$mensajes['index']['Nuevo actor o director'] = 'Enter new actor or director';
$mensajes['index']['Ver películas'] = 'View all movies';
$mensajes['index']['Búsqueda avanzada de películas'] = 'Advanced movie search';
$mensajes['index']['Ver actores'] = 'View all actors';
$mensajes['index']['Ver directores'] = 'View all directors';

// formularios en general
$mensajes['form']['Volver atrás'] = 'Go back';
$mensajes['form']['Enviar'] = 'Submit';
$mensajes['form']['Borrar'] = 'Delete';
$mensajes['form']['Error'] = '<b>Error</b>: ';

// insertar_genero.php
$mensajes['insertar_genero']['Error campo vacío'] = 'The field cannot be empty.';
$mensajes['insertar_genero']['Error género ya existe'] = 'This genre already exists in the database.';
$mensajes['insertar_genero']['Nombre:'] = 'Name:';

// insertar_pelicula.php
$mensajes['insertar_pelicula']['Error campos vacíos'] = 'The fields cannot be empty.';
$mensajes['insertar_pelicula']['Error película ya existe'] = 'This movie already exists in the database.';
$mensajes['insertar_pelicula']['Título'] = 'Títle:';
$mensajes['insertar_pelicula']['Género'] = 'Genre:';
$mensajes['insertar_pelicula']['Elige género'] = 'Choose a genre';
$mensajes['insertar_pelicula']['Año'] = 'Year:';
$mensajes['insertar_pelicula']['Protagonista'] = 'Leading actor:';
$mensajes['insertar_pelicula']['Director'] = 'Director:';

// insertar_persona.php
$mensajes['insertar_persona']['Error falta nombre'] = 'The name should be submitted.';
$mensajes['insertar_persona']['Error falta ocupación'] = 'Must have a profession.';
$mensajes['insertar_persona']['Error persona ya existe'] = 'This actor or director already exists in the database.';
$mensajes['insertar_persona']['Nombre'] = 'Name:';
$mensajes['insertar_persona']['Ocupaciones'] = 'Professions:';

// preferencias.php
$mensajes['preferencias']['Tema'] = 'Theme:';
$mensajes['preferencias']['Elige un tema'] = 'Choose a theme';
$mensajes['preferencias']['Estilo por defecto'] = 'Default theme';
$mensajes['preferencias']['Azul'] = 'Blue';
$mensajes['preferencias']['Rojo'] = 'Red';
$mensajes['preferencias']['Monocromo con fondo oscuro'] = 'Monochrome with a dark background';
$mensajes['preferencias']['Idioma'] = 'Language:';
$mensajes['preferencias']['Elige un idioma'] = 'Choose a language';

// ver_actores.php
$mensajes['ver_actores']['Lista de actores'] = 'List of actors';

// ver_directores.php
$mensajes['ver_directores']['Lista de directores'] = 'List of directors';

// ver_generos.php
$mensajes['ver_generos']['Lista de géneros'] = 'List of genres';

// ver_peliculas.php & ver_peliculas_avanzado.php
$mensajes['ver_peliculas']['Lista de películas'] = 'List of movies';
$mensajes['ver_peliculas']['Especificar géneros'] = 'Select genres:';
$mensajes['ver_peliculas']['Especificar años'] = 'Select years:';
$mensajes['ver_peliculas']['desde'] = 'from';
$mensajes['ver_peliculas']['hasta'] = 'to';
$mensajes['ver_peliculas']['Especificar protagonista'] = 'Select leading actor:';
$mensajes['ver_peliculas']['Especificar director'] = 'Select director:';
$mensajes['ver_peliculas']['Especificar ordenación'] = 'Select order:';
$mensajes['ver_peliculas']['Título'] = 'Title';
$mensajes['ver_peliculas']['Género'] = 'Genre';
$mensajes['ver_peliculas']['Año'] = 'Year';
$mensajes['ver_peliculas']['Protagonista'] = 'Leading actor';
$mensajes['ver_peliculas']['Director'] = 'Director';
$mensajes['ver_peliculas']['Orden ascendente'] = 'Ascending order (a-z, 0-9)';
$mensajes['ver_peliculas']['Orden descendente'] = 'Descending order (z-a, 9-0)';
?>
