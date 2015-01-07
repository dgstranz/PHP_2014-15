<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>

<?php
require_once('config.php');
?>

<h1><?php echo $mensajes['index']['Películas'] ?></h1>

<ul>
	<li><a href="preferencias.php"><?php echo $mensajes['index']['Editar preferencias'] ?></a></li>
	<li><a href="insertar_pelicula.php"><?php echo $mensajes['index']['Nueva película'] ?></a></li>
	<li><a href="insertar_genero.php"><?php echo $mensajes['index']['Nuevo género'] ?></a></li>
	<li><a href="insertar_persona.php"><?php echo $mensajes['index']['Nuevo actor o director'] ?></a></li>
	<li><a href="ver_peliculas.php"><?php echo $mensajes['index']['Ver películas'] ?></a></li>
	<li><a href="ver_peliculas_avanzado.php"><?php echo $mensajes['index']['Búsqueda avanzada de películas'] ?></a></li>
	<li><a href="ver_actores.php"><?php echo $mensajes['index']['Ver actores'] ?></a></li>
	<li><a href="ver_directores.php"><?php echo $mensajes['index']['Ver directores'] ?></a></li>
</ul>

</hody>
</html>
