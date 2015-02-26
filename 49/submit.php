<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php
session_start();
require_once('vars.php');

if (!isset($_POST['path'])) {
	post_message('error', 'Error: no se ha especificado ninguna ruta.');
	go_back($root);
} elseif (!isset($_POST['dir_opt']) && !isset($_POST['file_opt'])) {
	post_message('error', 'Error: no se ha introducido una instrucción válida.');
	go_back_to($_POST['path']);
} elseif (isset($_POST['dir_opt'])) {

	// OPCIONES DE CARPETA

	if (!is_dir($_POST['path'])) {
		post_message('error', 'Error: la ruta introducida no corresponde a un directorio.');
		go_back_to($_POST['path']);
	} elseif ($_POST['dir_opt'] == 'create') {
		if (!isset($_POST['name']) || empty($_POST['name'])) {
			post_message('error', 'Error: no se ha indicado un nombre de directorio.');
		} else {
			$dest = $_POST['path'] . '/' . $_POST['name'];
			if (file_exists($dest)) {
				post_message('error', 'Error: ya existe esa carpeta.');
			} elseif (!mkdir($dest)) {
				post_message('error', 'Error al tratar de crear la carpeta.');
			} else {
				post_message('success', 'La carpeta se ha creado con éxito');
			}
		}

		go_back_to($_POST['path']);

	} elseif ($_POST['dir_opt'] == 'tree') {
		$_SESSION['tree'] = !$_SESSION['tree'];
		header('Location: index.php?path=' . $_POST['path']);
	} elseif ($_POST['dir_opt'] == 'delete') {
		$parent = pathinfo($_POST['path'])['dirname'];
		
		$files = array_diff(scandir($_POST['path']), array('.','..'));

		if (sizeof($files) > 0) {
			post_message('error', 'Error al tratar de borrar la carpeta: No está vacía.');
			go_back_to($_POST['path']);
		} elseif (!rmdir($_POST['path'])) {
			post_message('error', 'Error al tratar de borrar la carpeta.');
			go_back_to($_POST['path']);
		} else {
			post_message('success', 'La carpeta se ha borrado con éxito');
			go_back_to($parent);
		}
	} elseif ($_POST['dir_opt'] == 'back') {
		header('Location: index.php?path=' . pathinfo($_POST['path'])['dirname']);
	} else {
		post_message('error', 'Error: opción desconocida.');
		go_back_to($_POST['path']);
	}

} elseif (isset($_POST['file_opt'])) {

	// OPCIONES DE ARCHIVO

	if(!is_file($_POST['path'])) {
		post_message('error', 'Error: la ruta introducida no corresponde a un archivo.');

		go_back_to($_POST['path']);

	} elseif ($_POST['file_opt'] == 'delete') {
		if (!unlink($_POST['path'])) {
			post_message('error', 'Error al tratar de borrar el archivo.');
			go_back_to($_POST['path']);
		} else {
			post_message('success', 'El archivo se ha borrado con éxito.');
			go_back_to(pathinfo($_POST['path'])['dirname']);
		}
	} elseif ($_POST['file_opt'] == 'copy') {
		if (!isset($_POST['copy']) || empty($_POST['copy'])) {
			post_message('error', 'Error: se pretende copiar un archivo pero no se ha especificado ninguna ruta de destino.');
		} else {
			$dest = pathinfo($_POST['path'])['dirname'] . '/' . pathinfo($_POST['copy'])['basename'];
			if (file_exists($dest)) {
				post_message('error', 'Error: el archivo de destino ya existe.');
			} elseif (!copy($_POST['path'], $dest)) {
				post_message('error', 'Error al tratar de copiar el archivo.');
			} else {
				post_message('success', 'El archivo se ha copiado con éxito');
			}
		}

		go_back_to($_POST['path']);

	} elseif ($_POST['file_opt'] == 'rename') {
		if (!isset($_POST['rename']) || empty($_POST['rename'])) {
			post_message('error', 'Error: se pretende renombrar un archivo pero no se ha especificado el nuevo nombre.');
			go_back_to($_POST['path']);
		} else {
			$dest = pathinfo($_POST['path'])['dirname'] . '/' . pathinfo($_POST['rename'])['basename'];
			if (file_exists($dest)) {
				post_message('error', 'Error: ya existe un archivo en esa ruta.');
				go_back_to($_POST['path']);
			} elseif (!rename($_POST['path'], $dest)) {
				post_message('error', 'Error al tratar de renombrar el archivo.');
				go_back_to($_POST['path']);
			} else {
				post_message('success', 'El archivo se ha renombrado con éxito.');
				go_back_to($dest);
			}
		}
	} elseif ($_POST['file_opt'] == 'back') {
		header('Location: index.php?path=' . pathinfo($_POST['path'])['dirname']);
	} else {
		post_message('error', 'Error: opción desconocida.');

		go_back_to($_POST['path']);
	}
}

function post_message($class, $msg) {
	echo '<p class="' . $class . '">' . $msg . '</p>';
}

function go_back_to($url) {
	echo '<p><a href="index.php?path=' . $url . '">Volver atrás</a></p>';
}

?>

</hody>
</html>
