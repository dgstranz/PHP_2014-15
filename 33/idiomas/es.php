<?php

// COMENTARIO
// Solo hay que traducir lo que va entre comillas y después de los signos igual
// Ejemplo: En la línea
//    $bd['No conexión'] = 'No se pudo establecer una conexión: ';
// solamente hay que traducir
//    'No se pudo establecer una conexión: '

// bd.php
$bd = array();

$bd['No conexión'] = 'No se pudo establecer una conexión: ';
$bd['Error BD'] = 'Error al crear la base de datos: ';
$bd['No conexión BD'] = 'No se pudo establecer una conexión a la base de datos: ';
$bd['Error codificación'] = 'Error al establecer UTF-8 como juego de caracteres predeterminado: ';
$bd['Error crear tabla'] = 'Error al crear la tabla: ';

// index.php
$index = array();

$index['Películas'] = 'Películas';
$index['Editar preferencias'] = 'Editar preferencias';
$index['Nueva película'] = 'Introducir nueva película';
$index['Nuevo género'] = 'Introducir nuevo género cinematográfico';
$index['Nuevo actor o director'] = 'Introducir nuevo actor o director';
$index['Ver películas'] = 'Ver todas las películas';
$index['Búsqueda avanzada de películas'] = 'Búsqueda avanzada de películas';
$index['Ver actores'] = 'Ver todos los actores';
$index['Ver directores'] = 'Ver todos los directores';

// formularios en general
$form = array();

$form['Volver atrás'] = 'Volver atrás';
$form['Enviar'] = 'Enviar';
$form['Borrar'] = 'Borrar';
$form['Error'] = '<b>Error</b>: ';

// insertar_genero.php
$insertar_genero = array();

$insertar_genero['Error campo vacío'] = 'El campo no puede estar vacío.';
$insertar_genero['Error género ya existe'] = 'Este género ya existe en la base de datos.';
$insertar_genero['Nombre:'] = 'Nombre:';

// insertar_pelicula.php
$insertar_pelicula = array();

$insertar_pelicula['Error campos vacíos'] = 'Los campos no pueden estar vacíos.';
$insertar_pelicula['Error película ya existe'] = 'Esta película ya existe en la base de datos.';
$insertar_pelicula['Título'] = 'Título:';
$insertar_pelicula['Género'] = 'Género:';
$insertar_pelicula['Elige género'] = 'Elige un género';
$insertar_pelicula['Año'] = 'Año:';
$insertar_pelicula['Protagonista'] = 'Protagonista:';
$insertar_pelicula['Director'] = 'Director:';

// insertar_persona.php
$insertar_persona = array();

$insertar_persona['Error falta nombre'] = 'Debe indicarse el nombre.';
$insertar_persona['Error falta ocupación'] = 'Debe indicarse alguna ocupación.';
$insertar_persona['Error persona ya existe'] = 'Este actor o director ya existe en la base de datos.';
$insertar_persona['Nombre'] = 'Nombre:';
$insertar_persona['Ocupaciones'] = 'Ocupaciones:';

// preferencias.php
$preferencias = array();

$preferencias['Tema'] = 'Tema:';
$preferencias['Elige un tema'] = 'Elige un tema';
$preferencias['Estilo por defecto'] = 'Estilo por defecto';
$preferencias['Azul'] = 'Azul';
$preferencias['Rojo'] = 'Rojo';
$preferencias['Monocromo con fondo oscuro'] = 'Monocromo con fondo oscuro';
$preferencias['Elige un idioma'] = 'Elige un idioma';

// ver_actores.php
$ver_actores = array();

$ver_actores['Lista de actores'] = 'Lista de actores';

// ver_directores.php
$ver_directores = array();

$ver_directores['Lista de directores'] = 'Lista de directores';

// ver_generos.php
$ver_generos = array();

$ver_generos['Lista de géneros'] = 'Lista de géneros';

// ver_peliculas.php & ver_peliculas_avanzado.php
$ver_peliculas = array();

$ver_peliculas['Lista de películas'] = 'Lista de películas';
$ver_peliculas['Especificar géneros'] = 'Especificar géneros:';
$ver_peliculas['Especificar años'] = 'Especificar años:';
$ver_peliculas['desde'] = 'desde';
$ver_peliculas['hasta'] = 'hasta';
$ver_peliculas['Especificar actor principal'] = 'Especificar actor principal:';
$ver_peliculas['Especificar director'] = 'Especificar director:';
$ver_peliculas['Especificar forma de ordenación'] = 'Especificar forma de ordenación:';
$ver_peliculas['Título'] = 'Título';
$ver_peliculas['Género'] = 'Género';
$ver_peliculas['Año'] = 'Año';
$ver_peliculas['Protagonista'] = 'Protagonista';
$ver_peliculas['Director'] = 'Director';
$ver_peliculas['Orden ascendente'] = 'Orden ascendente (a-z, 0-9)';
$ver_peliculas['Orden descendente'] = 'Orden descendente (z-a, 9-0)';

//echo basename($_SERVER['PHP_SELF'], '.php');
?>
