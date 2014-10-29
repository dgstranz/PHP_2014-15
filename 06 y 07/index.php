<html>
<head>
	<title>Generación de números pseudoaleatorios - algoritmo LCG</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Generación de números pseudoaleatorios - algoritmo LCG</h1>
<?php
$iterations = 400;
$c = 0;
$seed = 1000000 * microtime();

buildTable($iterations);

function randomLCG($x,$pos) {
	global $c;
	return (219*$x[$pos]+$c)%32749;
}
function noRepeat($x,$pos) {
	global $c;
	$i = 1;
	while($i<$pos) {
		if($x[$pos] != $x[$i]) {
			$i++;
		}
		else {
			$c++;
			return false;
		}
	}
	return true;
}

function buildTable($iterations) {
	global $seed;
	$pos=0;
	$x[0]=$seed;
	$columns=20;
	$rows=ceil($iterations / $columns);
	echo '<table border="4"><tr>';
	for($i=1;$i<=$iterations;$i++) {
		do {
			$x[$pos+1]=randomLCG($x,$pos);
		}
		while(!noRepeat($x,$pos+1));
		echo '<td>' . $x[$pos + 1] . '</td>';
		$pos++;
		if($i%$columns==0) {
			echo '</tr>';
			if($i<$iterations) echo '<tr>';
		}
	}
	echo '</table>';
}
?>
</body>
</html>