<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
echo '<table align="center" border="4"><tr align="center"><td colspan=17><h1>Tabla de códigos ASCII</h1></td></tr>';
echo '<tr><td></td>';
for ($u=0; $u < 16; $u++) { 
	echo '<td>' . $u . '</td>';
}
echo '</tr>';
for ($d=0; $d < 256; $d+=16) {
	echo '<tr align="center">';
	echo '<td>' . $d . '</td>';
	for ($u=0; $u < 16; $u++) {
		echo '<td>&#' . ($d + $u) . ';</td>';
	}
	echo '</tr>';
}
echo '</table>';
?>
</body>
</html>