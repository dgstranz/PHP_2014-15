<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>

<?php
// Para que se muestren los iconos predefinidos de WAMP
// http://stackoverflow.com/questions/26607363/wampserver-icons-doesnt-work

$dir = '../';

echo '<h2><a href="' . $dir . '">Proyectos PHP</a></h2>';

$handle = opendir($dir);
$content = array();
while (($entry = readdir($handle)) !== false) {
  array_push($content, $entry);
}
sort($content);

$count = 0;

echo '<table>';
echo '<tr>';
echo '  <th>Nombre</th>';
echo '  <th>Tamaño</th>';
echo '  <th>Tipo</th>';
echo '  <th>Permisos</th>';
echo '</tr>';

foreach($content as $key => $value) {
  echo '<tr>';
  echo '<td><a href="' . $dir . $value . '">' . $value . '</a></td>';
  echo '<td>' . filesize($dir . $value) . '</td>';

  $perms = fileperms($dir . $value);

  echo '<td>';
  // echo base_convert($perms, 10, 8) . ' ';

  if ($perms >= 0140000) {
    echo 'Socket';
  } elseif ($perms >= 0120000) {
    echo 'Enlace simbólico';
  } elseif ($perms >= 0100000) {
    echo 'Archivo';
  } elseif ($perms >= 060000) {
    echo 'Arch. especial de bloque';
  } elseif ($perms >= 040000) {
    echo 'Directorio';
  } elseif ($perms >= 020000) {
    echo 'Arch. especial de caracteres';
  } elseif ($perms >= 010000) {
    echo 'Tubería nombrada';
  } else {
    echo 'Desconocido';
  }

  echo '</td>';

  echo '<td>';

  // Usuario
  echo ($perms & 0400) ? 'r' : '-';
  echo ($perms & 0200) ? 'w' : '-';
  if ($perms & 0100) {
    echo ($perms & 04000) ? 's' : 'x';
  } else {
    echo ($perms & 04000) ? 'S' : '-';
  }

  // Grupo
  echo ($perms & 040) ? 'r' : '-';
  echo ($perms & 020) ? 'w' : '-';
  if ($perms & 010) {
    echo ($perms & 02000) ? 's' : 'x';
  } else {
    echo ($perms & 02000) ? 'S' : '-';
  }

  // Mundo
  echo ($perms & 04) ? 'r' : '-';
  echo ($perms & 02) ? 'w' : '-';
  if ($perms & 01) {
    echo ($perms & 01000) ? 't' : 'x';
  } else {
    echo ($perms & 01000) ? 'T' : '-';
  }


  echo '</td>';
  echo '</tr>';
}
echo '</table>';
?>

</hody>
</html>