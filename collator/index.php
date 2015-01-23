<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
	<link rel='stylesheet' type='text/css' href='estilo.css'>
</head>
<body>

<?php
$array = array('anexo', 'anémona', 'aniñado', 'añil', 'anotar', 'anómalo', 'aorta', 'anisar');

asort($array);
echo '<h1>Ordenación por defecto</h1>';
echo 'Cualquier letra acentuada irá después de la z porque su código es mayor que el código de "z".';
var_dump($array);

$colles = new Collator('es_ES');
collator_asort($colles, $array);
echo '<h1>Usando un cotejador para el español</h1>';
echo 'En español la ñ va después de la n, mientras que las demás letras acentuadas (á, é, í, ó, ú, ü) se consideran variantes de las letras sin acentuar.';
var_dump($array);

$collfr = new Collator('fr_FR');
collator_asort($collfr, $array);
echo '<h1>Usando un cotejador para otros idiomas</h1>';
echo 'Aquí uso un cotejador para el francés, pero sirve cualquier idioma que no tenga una ordenación "especial" para las letras acentuadas del español.';
var_dump($array);

$collpl = new Collator('pl');
collator_asort($collpl, $array);
echo '<h1>Usando un cotejador para el polaco</h1>';
echo 'En polaco hay varias letras acentuadas que tienen su lugar propio en el alfabeto (como pasa en español con la ñ), y una de ellas es la ó (pero no la é, que no se usa en polaco). Por eso anémona va antes de anexo, pero anómalo va después de anotar.';
var_dump($array);
?>

</body>
</html>
