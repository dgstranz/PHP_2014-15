<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

class Cabecera {
	private $titulo;
	private $color_texto;
	private $color_fondo;

	public function __construct($titulo, $color_texto, $color_fondo) {
		$this->titulo = $titulo;
		$this->color_texto = $color_texto;
		$this->color_fondo = $color_fondo;
	}

	public function paint() {
		echo '<div style="color:' . $this->color_texto . '; background-color:' . $this->color_fondo . '; text-align: center"><h1>' . $this->titulo . '</h1></div>';
	}
}

$mi_cabecera = new Cabecera('Hola mundo', '#336699', '#ffffcc');

$mi_cabecera->paint();

?>
</body>
</html>