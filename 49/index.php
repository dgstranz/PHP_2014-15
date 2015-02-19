<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php
// Para que se muestren los iconos predefinidos de WAMP
// http://stackoverflow.com/questions/26607363/wampserver-icons-doesnt-work

require_once 'types.php';
$root = '../';

if (isset($_GET['path']) && !empty($_GET['path'])) {
  $path = pathinfo($_GET['path'])['dirname'] . '/' . pathinfo($_GET['path'])['basename'] . '/';
} else {
  $path = $root;
}

echo '<h2><a href="' . $path . '">Proyectos PHP</a></h2>';

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

sort($content);

$count = 0;

echo '<table>';
echo '<tr>';
echo '  <th>Nombre</th>';
echo '  <th>Tamaño</th>';
echo '  <th>Tipo</th>';
echo '  <th>Permisos</th>';
echo '  <th colspan="2">Acciones</th>';
echo '</tr>';

foreach($content as $key => $file) {
  /* fileperms devuelve un número octal que contiene información sobre el tipo de fichero
  *  y los permisos que tiene. */
  $link = pathinfo($path . $file)['dirname'] . '/' . pathinfo($path . $file)['basename'];
  $file_perms = fileperms($link);
  $type = get_type($file_perms);
  $perms = get_perms($file_perms);

  $size = get_size($link);

  echo '<tr>';

  echo '<td>';
  echo '<img src="http://localhost/icons/' . $abbr['icon'][$type] . '">';
  echo '<pre>' . "\t" . '</pre>';
  echo '<a href="' . $_SERVER['PHP_SELF'] . '?path=' . $link . '">' . $file . '</a>';
  echo '</td>';

  echo '<td style="text-align: right;">' . get_size($path . $file) . '</td>';

  echo '<td>' . $abbr['type'][$type] . '</td>';

  echo '<td><pre><abbr class="type" title="' . $abbr['type'][$type] . '">' . $type . '</abbr>';

  foreach ($perms as $usertype => $userperms) {
    foreach ($userperms as $perm => $value) {
      echo '<abbr class="' . $usertype . ' ' . $perm . '" title="' . $abbr[$usertype][$perm][$value] . '">' . $value . '</abbr>';
    }
  }

  echo '</pre></td>';
  echo '<td>✗ (borrar)</td>';
  echo '<td>✎ (renombrar)</td>';
  echo '</tr>';
}

if ($path != $root) {
  echo '<tr>';
  echo '<td>';
  echo '<img src="http://localhost/icons/back.gif">';
  echo '<a href="' . $_SERVER['PHP_SELF'] . '?path=' . pathinfo($path)['dirname'] . '">Volver atrás</a>';
  var_dump(pathinfo($path));
  echo '</td>';
  echo '</tr>';
}

echo '</table>';

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