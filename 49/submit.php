<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php
session_start();

var_dump($_POST);
var_dump(pathinfo($_POST['path']));

if (!isset($_POST['path'])) {
	echo 'Error: no se ha especificado ninguna ruta';
} elseif (!isset($_POST['dir_opt']) && !isset($_POST['file_opt'])) {
	echo 'Error: no se ha introducido una instrucción válida.';
} elseif (isset($_POST['dir_opt'])) {
	if (!is_dir($_POST['path'])) {
		echo 'Error: la ruta introducida no corresponde a un directorio.';
	} elseif ($_POST['dir_opt'] == 'tree') {
		if (isset($_SESSION['tree'])) {
			$_SESSION['tree'] = !$_SESSION['tree'];
		} else {
			$_SESSION['tree'] = true;
		}
		header('Location: index.php');
	}
} elseif (isset($_POST['file_opt'])) {
	if(!is_file($_POST['path'])) {
		echo 'Error: la ruta introducida no corresponde a un archivo.';
	} elseif ($_POST['file_opt'] == 'delete') {
		if (!unlink($_POST['path'])) {
			echo 'Error al tratar de borrar el archivo.';
		} else {
			echo 'El archivo se ha borrado con éxito.';
		}
	} elseif ($_POST['file_opt'] == 'copy') {
		if (!isset($_POST['copy']) || empty($_POST['copy'])) {
			echo 'Error: se pretende copiar un archivo pero no se ha especificado ninguna ruta de destino.';
		} else {
			var_dump(pathinfo($_POST['copy']));
			$dest = pathinfo($_POST['path'])['dirname'] . '/' . pathinfo($_POST['copy'])['basename'];
			if (file_exists($dest)) {
				echo 'Error: el archivo de destino ya existe.';
			} elseif (!copy($_POST['path'], $dest)) {
				echo 'Error al tratar de copiar el archivo.';
			} else {
				echo 'El archivo se ha copiado con éxito';
			}
		}
	}
}
?>

</hody>
</html>
