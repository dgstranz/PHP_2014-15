<?php
$mensajes = array();

// bd.php
$mensajes['bd']['No conexión'] = 'Impossible d\'établir une connexion: ';
$mensajes['bd']['Error BD'] = 'Impossible de créer la base de données: ';
$mensajes['bd']['No conexión BD'] = 'Impossible d\'établir une connexion à la base de données: ';
$mensajes['bd']['Error codificación'] = 'Impossible de définir UTF-8 comme le jeu de caractères par défaut: ';
$mensajes['bd']['Error crear tabla'] = 'Impossible de créer la table: ';

// index.php
$mensajes['index']['Películas'] = 'Films';
$mensajes['index']['Editar preferencias'] = 'Modifier les préférences';
$mensajes['index']['Nueva película'] = 'Insérer nouveau film';
$mensajes['index']['Nuevo género'] = 'Insérer nouveau genre cinématographique';
$mensajes['index']['Nuevo actor o director'] = 'Insérer nouveau acteur ou directeur';
$mensajes['index']['Ver películas'] = 'Voir tous les films';
$mensajes['index']['Búsqueda avanzada de películas'] = 'Recherche avancée de films';
$mensajes['index']['Ver actores'] = 'Voir tous les acteurs';
$mensajes['index']['Ver directores'] = 'Voir tous les directeurs';

// formularios en general
$mensajes['form']['Volver atrás'] = 'Retour';
$mensajes['form']['Enviar'] = 'Envoyer';
$mensajes['form']['Borrar'] = 'Effacer';
$mensajes['form']['Error'] = '<b>Erreur</b>: ';

// insertar_genero.php
$mensajes['insertar_genero']['Error campo vacío'] = 'Ce champ doit être renseigné.';
$mensajes['insertar_genero']['Error género ya existe'] = 'Ce genre existe déjà dans la base de données.';
$mensajes['insertar_genero']['Nombre:'] = 'Nom:';

// insertar_pelicula.php
$mensajes['insertar_pelicula']['Error campos vacíos'] = 'Ces champs doivent être renseignés.';
$mensajes['insertar_pelicula']['Error película ya existe'] = 'Ce film existe déjà dans la base de données.';
$mensajes['insertar_pelicula']['Título'] = 'Titre:';
$mensajes['insertar_pelicula']['Género'] = 'Genre:';
$mensajes['insertar_pelicula']['Elige género'] = 'Choisissez un genre';
$mensajes['insertar_pelicula']['Año'] = 'Année:';
$mensajes['insertar_pelicula']['Protagonista'] = 'Protagoniste:';
$mensajes['insertar_pelicula']['Director'] = 'Directeur:';

// insertar_persona.php
$mensajes['insertar_persona']['Error falta nombre'] = 'Il faut écrire un nom.';
$mensajes['insertar_persona']['Error falta ocupación'] = 'Il faut sélectionner au moins un métier.';
$mensajes['insertar_persona']['Error persona ya existe'] = 'Cet acteur ou directeur existe déjà dans la base de données.';
$mensajes['insertar_persona']['Nombre'] = 'Nom:';
$mensajes['insertar_persona']['Ocupaciones'] = 'Métiers:';
$mensajes['insertar_persona']['Actor'] = 'Actor';
$mensajes['insertar_persona']['Director'] = 'Director';

// preferencias.php
$mensajes['preferencias']['Tema'] = 'Thème:';
$mensajes['preferencias']['Elige un tema'] = 'Choisissez un thème';
$mensajes['preferencias']['Estilo por defecto'] = 'Thème par défaut';
$mensajes['preferencias']['Azul'] = 'Bleu';
$mensajes['preferencias']['Rojo'] = 'Rouge';
$mensajes['preferencias']['Monocromo con fondo oscuro'] = 'Monochrome au fond sombre';
$mensajes['preferencias']['Idioma'] = 'Langue:';
$mensajes['preferencias']['Elige un idioma'] = 'Choisissez une langue';

// ver_actores.php
$mensajes['ver_actores']['Lista de actores'] = 'Liste d\'acteurs';

// ver_directores.php
$mensajes['ver_directores']['Lista de directores'] = 'Liste de directeurs';

// ver_generos.php
$mensajes['ver_generos']['Lista de géneros'] = 'Liste de genres';

// ver_peliculas.php & ver_peliculas_avanzado.php
$mensajes['ver_peliculas']['Lista de películas'] = 'Liste de films';
$mensajes['ver_peliculas']['Especificar géneros'] = 'Sélectionnez un o plusieurs genres:';
$mensajes['ver_peliculas']['Especificar años'] = 'Sélectionnez les années souhaitées:';
$mensajes['ver_peliculas']['desde'] = 'depuis';
$mensajes['ver_peliculas']['hasta'] = 'jusqu\'à';
$mensajes['ver_peliculas']['Especificar protagonista'] = 'Sélectionnez un protagoniste:';
$mensajes['ver_peliculas']['Especificar director'] = 'Sélectionnez un directeur:';
$mensajes['ver_peliculas']['Especificar ordenación'] = 'Sélectionnez le mode de tri souhaité:';
$mensajes['ver_peliculas']['Título'] = 'Titre';
$mensajes['ver_peliculas']['Género'] = 'Genre';
$mensajes['ver_peliculas']['Año'] = 'Année';
$mensajes['ver_peliculas']['Protagonista'] = 'Protagoniste';
$mensajes['ver_peliculas']['Director'] = 'Directeur';
$mensajes['ver_peliculas']['Orden ascendente'] = 'Ordre croissant (a-z, 0-9)';
$mensajes['ver_peliculas']['Orden descendente'] = 'Ordre décroissant (z-a, 9-0)';
?>
