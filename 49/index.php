<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php
session_start();
// Para que se muestren los iconos predefinidos de WAMP
// http://stackoverflow.com/questions/26607363/wampserver-icons-doesnt-work

// Inicializar variables de ruta
$root = '..';

if (isset($_GET['path']) && !empty($_GET['path'])) {
  $current_path = pathinfo($_GET['path'])['dirname'] . '/' . pathinfo($_GET['path'])['basename'];
} else {
  $current_path = $root;
}

// Por defecto no se muestran las subcarpetas
if (!isset($_SESSION['tree'])) {
  $_SESSION['tree'] = false;
}


echo '<h1>Ruta actual: ' . $current_path . '</h1>';

if (is_dir($current_path)) {
  show_dir_options();

  echo '<table id="contents">';
  echo '<tr>';
  echo '  <th>Nombre</th>';
  echo '  <th>Tamaño</th>';
  echo '  <th>Tipo</th>';
  echo '  <th>Permisos</th>';
  echo '</tr>';

  show_files($current_path);

  echo '</table>';
} else {
  show_file_options();

  //echo '<pre>' . file_get_contents($current_path) . '</pre>';

  $size = filesize($current_path);
  $handle = fopen($current_path,"r");
  echo '<pre>' . fread($handle, $size) . '</pre>';
  fclose($handle);
}

function show_dir_options() {
  global $current_path;
  echo '<form id="options" action="submit.php?path=' . $current_path . '" method="POST">';
  echo '  <h2>Opciones de carpeta</h2>';
  echo '  <input type="hidden" name="path" value="' . $current_path . '">';
  echo '  <table>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="dir_opt" value="create"> ';
  echo '        <img src="http://localhost/icons/folder.sec.gif"> Crear subcarpeta:';
  echo '      </td>';
  echo '      <td><input name="name" type="text" placeholder="Nombre"></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="dir_opt" value="tree"> ';
  echo '        <img src="http://localhost/icons/index.gif"> ' . ($_SESSION['tree'] ? 'Mostrar solo carpeta actual' : 'Mostrar carpetas y subcarpetas');
  echo '      </td>';
  echo '      <td></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="dir_opt" value="delete"> ';
  echo '        <img src="http://localhost/icons/burst.gif"> Borrar';
  echo '      </td>';
  echo '      <td></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td colspan="2"><input type="submit" value="Enviar"></td>';
  echo '    </tr>';
  echo '  </table>';
  echo '</form>';
}

function show_file_options() {
  global $current_path;
  echo '<form id="options" action="submit.php?path=' . $current_path . '" method="POST">';
  echo '  <h2>Opciones de archivo</h2>';
  echo '  <input type="hidden" name="path" value="' . $current_path . '">';
  echo '  <table>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="file_opt" value="delete"> ';
  echo '        <img src="http://localhost/icons/burst.gif"> Borrar';
  echo '      </td>';
  echo '      <td></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="file_opt" value="copy"> ';
  echo '        <img src="http://localhost/icons/quill.gif"> Copiar:';
  echo '      </td>';
  echo '      <td><input name="copy" type="text" placeholder="Nombre de la copia"></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td>';
  echo '        <input type="radio" name="file_opt" value="rename"> ';
  echo '        <img src="http://localhost/icons/quill.gif"> Renombrar:';
  echo '      </td>';
  echo '      <td><input name="rename" type="text" placeholder="Nuevo nombre"></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td colspan="2"><input type="submit" value="Enviar"></td>';
  echo '    </tr>';
  echo '  </table>';
  echo '</form>';
}

function show_files($path) {
  require 'types.php';
  global $root;
  global $current_path;
  $nesting = sizeof(explode('/', $path)) - sizeof(explode('/', $current_path));

  $handle = opendir($path);
  $content = array();
  while (($entry = readdir($handle)) !== false) {
    array_push($content, $entry);
  }

  // Quito . (carpeta actual) y .. (carpeta padre) del resultado de la búsqueda
  $key = array_search('.', $content);
  if (gettype($key) == 'integer') {
    unset($content[$key]);
  }
  $key = array_search('..', $content);
  if (gettype($key) == 'integer') {
    unset($content[$key]);
  }

  if (sizeof($content) == 0) {
    echo '<tr><td colspan="4">Carpeta vacía</td></tr>';
    return 0;
  }

  sort($content);

  foreach($content as $key => $file) {
    /* fileperms devuelve un número octal que contiene información sobre el tipo de fichero
    *  y los permisos que tiene. */
    $link = pathinfo($path . '/' . $file)['dirname'] . '/' . pathinfo($path . '/' . $file)['basename'];
    $file_perms = fileperms($link);
    $type = get_type($file_perms);
    $perms = get_perms($file_perms);
    $size = get_size($link);

    echo '<tr>';

    echo '<td>';

    if ($path != $current_path) {
      echo '<pre>';
      for ($i = 0; $i < $nesting; $i++) { 
        echo "\t";
      }
      echo '</pre>';
    }

    echo '<img src="http://localhost/icons/' . $abbr['icon'][$type] . '"> ';
    echo '<a href="' . $_SERVER['PHP_SELF'] . '?path=' . $link . '">' . $file . '</a>';
    echo '</td>';

    echo '<td style="text-align: right;">' . get_size($path . '/' . $file) . '</td>';

    echo '<td>' . $abbr['type'][$type] . '</td>';

    echo '<td><pre><abbr class="type" title="' . $abbr['type'][$type] . '">' . $type . '</abbr>';

    foreach ($perms as $usertype => $userperms) {
      foreach ($userperms as $perm => $value) {
        echo '<abbr class="' . $usertype . ' ' . $perm . '" title="' . $abbr[$usertype][$perm][$value] . '">' . $value . '</abbr>';
      }
    }

    echo '</pre></td>';
    echo '</tr>';

    if ($_SESSION['tree'] && $type == 'd') {
      show_files($link);
    }
  }

  if ($path != $root && $path == $current_path) {
    echo '<tr>';
    echo '<td>';
    echo '<img src="http://localhost/icons/back.gif">';
    echo '<a href="' . $_SERVER['PHP_SELF'] . '?path=' . pathinfo($path)['dirname'] . '"> Volver atrás</a>';
    echo '</td>';
    echo '</tr>';
  }

  return sizeof($content);
}

function get_type($file_perms) {
  if ($file_perms >= 0140000) {
    $type = 's';
  } elseif ($file_perms >= 0120000) {
    $type = 'l';
  } elseif ($file_perms >= 0100000) {
    $type = '-';
  } elseif ($file_perms >= 060000) {
    $type = 'b';
  } elseif ($file_perms >= 040000) {
    $type = 'd';
  } elseif ($file_perms >= 020000) {
    $type = 'c';
  } elseif ($file_perms >= 010000) {
    $type = 'p';
  } else {
    $type = 'u';
  }

  return $type;
}

function get_perms($file_perms) {
  $perms = array(
    'user' => array(),
    'group' => array(),
    'other' => array()
  );

  // Usuario
  $perms['user']['read'] = ($file_perms & 0400) ? 'r' : '-';
  $perms['user']['write'] = ($file_perms & 0200) ? 'w' : '-';
  if ($file_perms & 0100) {
    $perms['user']['execute'] = ($file_perms & 04000) ? 's' : 'x';
  } else {
    $perms['user']['execute'] = ($file_perms & 04000) ? 'S' : '-';
  }

  // Grupo
  $perms['group']['read'] = ($file_perms & 040) ? 'r' : '-';
  $perms['group']['write'] = ($file_perms & 020) ? 'w' : '-';
  if ($file_perms & 010) {
    $perms['group']['execute'] = ($file_perms & 02000) ? 's' : 'x';
  } else {
    $perms['group']['execute'] = ($file_perms & 02000) ? 'S' : '-';
  }

  // Mundo
  $perms['other']['read'] = ($file_perms & 04) ? 'r' : '-';
  $perms['other']['write'] = ($file_perms & 02) ? 'w' : '-';
  if ($file_perms & 01) {
    $perms['other']['execute'] = ($file_perms & 01000) ? 't' : 'x';
  } else {
    $perms['other']['execute'] = ($file_perms & 01000) ? 'T' : '-';
  }

  return $perms;
}

function get_size($file) {
  $mult = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
  $i = 0;
  $size = filesize($file);
  while($size > 1023) {
    $size /= 1024;
    $i++;
  }
  if ($i == 0) {
    return $size . ' bytes';
  } else {
    return number_format($size, 2, '.', '') . ' ' . $mult[$i] . '&nbsp;&nbsp;&nbsp;';
  }
}

?>

</hody>
</html>
