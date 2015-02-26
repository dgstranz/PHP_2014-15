<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php

if (!isset($_POST['folder']) || !isset($_POST['ext'])) {
  form();
} elseif (empty($_POST['folder']) || !is_dir($_POST['folder']) || empty($_POST['ext'])) {
  echo 'Deben rellenarse los campos y la ruta de la carpeta debe ser válida.';
  form();
} else {
  results();
}

function form() {
  echo '<form id="options" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
  echo '  <h2>Búsqueda de archivos por extensión</h2>';
  echo '  <table>';
  echo '    <tr>';
  echo '      <td>Carpeta</td>';
  echo '      <td><input type="text" name="folder" /></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td>Extensión</td>';
  echo '      <td><input type="text" name="ext"></td>';
  echo '    </tr>';
  echo '    <tr>';
  echo '      <td colspan="2"><input type="submit" value="Enviar"></td>';
  echo '    </tr>';
  echo '  </table>';
  echo '</form>';
}

function results() {
  $extension = strtolower($_POST['ext']);
  $handle = opendir($_POST['folder']);
  $count = 0;

  echo '<h2>Resultados</h2>';

  echo '<ol>';
  while (($entry = readdir($handle)) !== false) {
    if (isset(pathinfo($entry)['extension']) && strtolower(pathinfo($entry)['extension']) == $extension) {
      echo '<li>' . pathinfo($entry)['basename'] . '</li>';
      $count++;
    };
  }
  echo '</ol>';

  switch (true) {
    case ($count <= 0):
      echo 'No se han encontrado archivos';
      break;
    
    case ($count == 1):
      echo 'Se ha encontrado 1 archivo';
      break;

    default:
      echo 'Se han encontrado ' . $count . ' archivos';
      break;
  }
  echo ' con la extensión ' . $_POST['ext'] . ' en la carpeta ' . $_POST['folder'];

  echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Volver atrás</a></p>';
}

?>

</hody>
</html>
