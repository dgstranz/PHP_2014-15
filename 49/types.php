<?php
$abbr = array(
	'type' => array(
		's' => 'Socket',
		'l' => 'Enlace simbólico',
		'-' => 'Archivo',
		'b' => 'Archivo especial de bloque',
		'd' => 'Directorio',
		'c' => 'Archivo especial de caracteres',
		'p' => 'Tubería nombrada',
		'u' => 'Desconocido'
	),
	'icon' => array(
		's' => 'patch.gif',
		'l' => 'link.gif',
		'-' => 'generic.gif',
		'b' => 'box2.gif',
		'd' => 'folder.gif',
		'c' => 'script.gif',
		'p' => 'transfer.gif',
		'u' => 'unknown.gif'
	),
	'user' => array(
		'read' => array(
			'r' => 'El dueño tiene permisos de lectura',
			'-' => 'El dueño no tiene permisos de lectura'
		),
		'write' => array(
			'w' => 'El dueño tiene permisos de escritura',
			'-' => 'El dueño no tiene permisos de escritura'
		),
		'execute' => array(
			'x' => 'El dueño tiene permisos de ejecución',
			'-' => 'El dueño no tiene permisos de ejecución',
			's' => 'Fichero ejecutable con setuid',
			'S' => 'Fichero no ejecutable con setuid'
		)
	),
	'group' => array(
		'read' => array(
			'r' => 'Los usuarios del grupo tienen permisos de lectura',
			'-' => 'Los usuarios del grupo no tienen permisos de lectura'
		),
		'write' => array(
			'w' => 'Los usuarios del grupo tienen permisos de escritura',
			'-' => 'Los usuarios del grupo no tienen permisos de escritura'
		),
		'execute' => array(
			'x' => 'Los usuarios del grupo tienen permisos de ejecución',
			'-' => 'Los usuarios del grupo no tienen permisos de ejecución',
			's' => 'Fichero ejecutable con setgid',
			'S' => 'Fichero no ejecutable con setgid'
		)
	),
	'other' => array(
		'read' => array(
			'r' => 'Los demás usuarios tienen permisos de lectura',
			'-' => 'Los demás usuarios no tienen permisos de lectura'
		),
		'write' => array(
			'w' => 'Los demás usuarios tienen permisos de escritura',
			'-' => 'Los demás usuarios no tienen permisos de escritura'
		),
		'execute' => array(
			'x' => 'Los demás usuarios tienen permisos de ejecución',
			'-' => 'Los demás usuarios no tienen permisos de ejecución',
			's' => 'Fichero ejecutable con sticky bit',
			'S' => 'Fichero no ejecutable con sticky bit'
		)
	)
);
?>
