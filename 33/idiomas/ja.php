<?php
$mensajes = array();

// bd.php
$mensajes['bd']['No conexión'] = '接続を確立できませんでした: ';
$mensajes['bd']['Error BD'] = 'データベースを作成できませんでした: ';
$mensajes['bd']['No conexión BD'] = 'データベース接続を確立できませんでした: ';
$mensajes['bd']['Error codificación'] = 'UTF-8はデフォルトの文字セットとして設定できませんでした: ';
$mensajes['bd']['Error crear tabla'] = 'テーブルを作成できませんでした: ';

// index.php
$mensajes['index']['Películas'] = '映画';
$mensajes['index']['Editar preferencias'] = '設定を編集する';
$mensajes['index']['Nueva película'] = '映画を入力する';
$mensajes['index']['Nuevo género'] = 'ジャンルを入力する';
$mensajes['index']['Nuevo actor o director'] = '俳優や監督を入力する';
$mensajes['index']['Ver películas'] = '映画の一覧を参照する';
$mensajes['index']['Búsqueda avanzada de películas'] = '映画の高度な検索';
$mensajes['index']['Ver actores'] = '俳優の一覧を参照する';
$mensajes['index']['Ver directores'] = '監督の一覧を参照する';

// formularios en general
$mensajes['form']['Volver atrás'] = '戻る';
$mensajes['form']['Enviar'] = '送信';
$mensajes['form']['Borrar'] = '削除';
$mensajes['form']['Error'] = '<b>エラー</b>: ';

// insertar_genero.php
$mensajes['insertar_genero']['Error campo vacío'] = 'フィールドは空にできません。';
$mensajes['insertar_genero']['Error género ya existe'] = 'このジャンルは、すでにデータベースに存在します。';
$mensajes['insertar_genero']['Nombre:'] = 'ジャンル';

// insertar_pelicula.php
$mensajes['insertar_pelicula']['Error campos vacíos'] = 'フィールドは空にできません。';
$mensajes['insertar_pelicula']['Error película ya existe'] = 'この映画は、すでにデータベースに存在します。';
$mensajes['insertar_pelicula']['Título'] = 'タイトル';
$mensajes['insertar_pelicula']['Género'] = 'ジャンル';
$mensajes['insertar_pelicula']['Elige género'] = 'ジャンルを選択してください。';
$mensajes['insertar_pelicula']['Año'] = '年';
$mensajes['insertar_pelicula']['Protagonista'] = '主人公';
$mensajes['insertar_pelicula']['Director'] = '監督';

// insertar_persona.php
$mensajes['insertar_persona']['Error falta nombre'] = '名前を入力してください。';
$mensajes['insertar_persona']['Error falta ocupación'] = '仕事を入力してください。';
$mensajes['insertar_persona']['Error persona ya existe'] = 'この俳優や監督は、すでにデータベースに存在します。';
$mensajes['insertar_persona']['Nombre'] = '名前';
$mensajes['insertar_persona']['Ocupaciones'] = '仕事';
$mensajes['insertar_persona']['Actor'] = '俳優';
$mensajes['insertar_persona']['Director'] = '監督';

// preferencias.php
$mensajes['preferencias']['Tema'] = 'テーマ:';
$mensajes['preferencias']['Elige un tema'] = 'テーマを選択してください。';
$mensajes['preferencias']['Estilo por defecto'] = 'デフォルトのテーマ';
$mensajes['preferencias']['Azul'] = '青';
$mensajes['preferencias']['Rojo'] = '赤';
$mensajes['preferencias']['Monocromo con fondo oscuro'] = 'モノクロ、暗い背景';
$mensajes['preferencias']['Idioma'] = '言語:';
$mensajes['preferencias']['Elige un idioma'] = '言語を選択してください。';

// ver_actores.php
$mensajes['ver_actores']['Lista de actores'] = '俳優の一覧';

// ver_directores.php
$mensajes['ver_directores']['Lista de directores'] = '監督の一覧';

// ver_generos.php
$mensajes['ver_generos']['Lista de géneros'] = 'ジャンルの一覧';

// ver_peliculas.php & ver_peliculas_avanzado.php
$mensajes['ver_peliculas']['Lista de películas'] = '映画の一覧';
$mensajes['ver_peliculas']['Especificar géneros'] = 'ジャンルを選ぶ';
$mensajes['ver_peliculas']['Especificar años'] = '年を選ぶ';
$mensajes['ver_peliculas']['desde'] = '開始';
$mensajes['ver_peliculas']['hasta'] = '終了';
$mensajes['ver_peliculas']['Especificar protagonista'] = '主人公を選ぶ';
$mensajes['ver_peliculas']['Especificar director'] = '監督を選ぶ';
$mensajes['ver_peliculas']['Especificar ordenación'] = 'ソート順を選ぶ';
$mensajes['ver_peliculas']['Título'] = 'タイトル';
$mensajes['ver_peliculas']['Género'] = 'ジャンル';
$mensajes['ver_peliculas']['Año'] = '年';
$mensajes['ver_peliculas']['Protagonista'] = '主人公';
$mensajes['ver_peliculas']['Director'] = '監督';
$mensajes['ver_peliculas']['Orden ascendente'] = '昇順 (a-z, 0-9)';
$mensajes['ver_peliculas']['Orden descendente'] = '降順 (z-a, 9-0)';

//echo basename($_SERVER['PHP_SELF'], '.php');
?>
