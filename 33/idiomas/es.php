<?php
$mensajes = array();

// bd.php
$mensajes['bd']['No conexión'] = 'No se pudo establecer una conexión: ';
$mensajes['bd']['Error BD'] = 'Error al crear la base de datos: ';
$mensajes['bd']['No conexión BD'] = 'No se pudo establecer una conexión a la base de datos: ';
$mensajes['bd']['Error codificación'] = 'Error al establecer UTF-8 como juego de caracteres predeterminado: ';
$mensajes['bd']['Error crear tabla'] = 'Error al crear la tabla: ';

// index.php
$mensajes['index']['Películas'] = 'Películas';
$mensajes['index']['Editar preferencias'] = 'Editar preferencias';
$mensajes['index']['Nueva película'] = 'Introducir nueva película';
$mensajes['index']['Nuevo género'] = 'Introducir nuevo género cinematográfico';
$mensajes['index']['Nuevo actor o director'] = 'Introducir nuevo actor o director';
$mensajes['index']['Ver películas'] = 'Ver todas las películas';
$mensajes['index']['Búsqueda avanzada de películas'] = 'Búsqueda avanzada de películas';
$mensajes['index']['Ver actores'] = 'Ver todos los actores';
$mensajes['index']['Ver directores'] = 'Ver todos los directores';

// formularios en general
$mensajes['form']['Volver atrás'] = 'Volver atrás';
$mensajes['form']['Enviar'] = 'Enviar';
$mensajes['form']['Borrar'] = 'Borrar';
$mensajes['form']['Error'] = '<b>Error</b>: ';

// insertar_genero.php
$mensajes['insertar_genero']['Error campo vacío'] = 'El campo no puede estar vacío.';
$mensajes['insertar_genero']['Error género ya existe'] = 'Este género ya existe en la base de datos.';
$mensajes['insertar_genero']['Nombre:'] = 'Nombre:';

// insertar_pelicula.php
$mensajes['insertar_pelicula']['Error campos vacíos'] = 'Los campos no pueden estar vacíos.';
$mensajes['insertar_pelicula']['Error película ya existe'] = 'Esta película ya existe en la base de datos.';
$mensajes['insertar_pelicula']['Título'] = 'Título:';
$mensajes['insertar_pelicula']['Género'] = 'Género:';
$mensajes['insertar_pelicula']['Elige género'] = 'Elige un género';
$mensajes['insertar_pelicula']['Año'] = 'Año:';
$mensajes['insertar_pelicula']['Protagonista'] = 'Protagonista:';
$mensajes['insertar_pelicula']['Director'] = 'Director:';

// insertar_persona.php
$mensajes['insertar_persona']['Error falta nombre'] = 'Debe indicarse el nombre.';
$mensajes['insertar_persona']['Error falta ocupación'] = 'Debe indicarse alguna ocupación.';
$mensajes['insertar_persona']['Error persona ya existe'] = 'Este actor o director ya existe en la base de datos.';
$mensajes['insertar_persona']['Nombre'] = 'Nombre:';
$mensajes['insertar_persona']['Ocupaciones'] = 'Ocupaciones:';

// preferencias.php
$mensajes['preferencias']['Tema'] = 'Tema:';
$mensajes['preferencias']['Elige un tema'] = 'Elige un tema';
$mensajes['preferencias']['Estilo por defecto'] = 'Estilo por defecto';
$mensajes['preferencias']['Azul'] = 'Azul';
$mensajes['preferencias']['Rojo'] = 'Rojo';
$mensajes['preferencias']['Monocromo con fondo oscuro'] = 'Monocromo con fondo oscuro';
$mensajes['preferencias']['Idioma'] = 'Idioma:';
$mensajes['preferencias']['Elige un idioma'] = 'Elige un idioma';

// ver_actores.php
$mensajes['ver_actores']['Lista de actores'] = 'Lista de actores';

// ver_directores.php
$mensajes['ver_directores']['Lista de directores'] = 'Lista de directores';

// ver_generos.php
$mensajes['ver_generos']['Lista de géneros'] = 'Lista de géneros';

// ver_peliculas.php & ver_peliculas_avanzado.php
$mensajes['ver_peliculas']['Lista de películas'] = 'Lista de películas';
$mensajes['ver_peliculas']['Especificar géneros'] = 'Especificar géneros:';
$mensajes['ver_peliculas']['Especificar años'] = 'Especificar años:';
$mensajes['ver_peliculas']['desde'] = 'desde';
$mensajes['ver_peliculas']['hasta'] = 'hasta';
$mensajes['ver_peliculas']['Especificar protagonista'] = 'Especificar actor principal:';
$mensajes['ver_peliculas']['Especificar director'] = 'Especificar director:';
$mensajes['ver_peliculas']['Especificar ordenación'] = 'Especificar forma de ordenación:';
$mensajes['ver_peliculas']['Título'] = 'Título';
$mensajes['ver_peliculas']['Género'] = 'Género';
$mensajes['ver_peliculas']['Año'] = 'Año';
$mensajes['ver_peliculas']['Protagonista'] = 'Protagonista';
$mensajes['ver_peliculas']['Director'] = 'Director';
$mensajes['ver_peliculas']['Orden ascendente'] = 'Orden ascendente (a-z, 0-9)';
$mensajes['ver_peliculas']['Orden descendente'] = 'Orden descendente (z-a, 9-0)';

//echo basename($_SERVER['PHP_SELF'], '.php');
?>
