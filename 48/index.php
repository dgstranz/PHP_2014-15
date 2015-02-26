<html>
<head>
  <meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>

<?php

var_dump($_POST);
form();

function form() {
  echo '<form id="options" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
  echo '  <h2>Búsqueda de archivos por extensión</h2>';
  echo '  <table>';
  echo '    <tr>';
  echo '      <td>Carpeta</td>';
  echo '      <td><input type="file" name="folder" webkitdirectory directory multiple /></td>';
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


?>

</hody>
</html>
