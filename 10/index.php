<html>
<head>
	<title>Chessboard!</title>
</head>
<body>
<?php
define('SIZE', 8); //número de filas y columnas
define('PIX', 100); //ancho y alto de cada casilla

echo '<div style="height:' . (SIZE * PIX) . '; width:' . (SIZE * PIX).'; border:' . (PIX / 20) . ' solid rgb(128,128,0)">';
for($i = 0; $i < SIZE; $i++) {
        echo '<div style="height:' . PIX . '; width:' . (SIZE * PIX) . '">';
        for($j = 0; $j < SIZE; $j++) {
        		($i + $j) % 2 ? $color="black" : $color="white";
                echo '<div style="height:' . PIX . '; width:' . PIX . '; background-color:'.$color.'; float:left"></div>';
        }
        echo '</div>';
}
echo '</div>';
?>
</body>
</html>