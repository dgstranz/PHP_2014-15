<?php
function cabecera($pagina) {
	$paginas = array(1 => 'Tipo', 2 => 'Zona', 3 => 'Características', 4 => 'Extras');
	echo '<h1>Búsqueda de vivienda</h1>';
	$indice = array();
	foreach ($paginas as $key => $value) {
		$str = $key . '. ' . $value;
		if ($key == $pagina) {
			$indice[$key] = '<b>' . $str . '</b>';
		} else {
			$indice[$key] = '<span class="gris">' . $str . '</span>';
		}
	}
	echo implode('<span class="azul"> &gt; </span>', $indice);
}
?>