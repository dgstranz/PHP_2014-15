<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

class Opcion {
	private $titulo;
	private $enlace;
	private $color_texto;
	private $color_fondo;

	public function __construct($titulo, $enlace, $color_texto, $color_fondo) {
		$this->titulo = htmlspecialchars($titulo);
		$this->enlace = htmlspecialchars($enlace);
		$this->color_texto = htmlspecialchars($color_texto);
		$this->color_fondo = htmlspecialchars($color_fondo);
	}

	public function dibujar() {
		echo '<div style="padding: 10px; background-color: ' . $this->color_fondo . '">';
		echo '<a style="color:' . $this->color_texto . ';" href="' . $this->enlace . '">' . $this->titulo . '</a>';
		echo '</div>';
	}
}

class Menu {
	private $opciones;
	private $direccion;
	private $color_fondo;

	public function __construct($direccion, $color_fondo) {
		$this->opciones = array();
		$this->direccion = htmlspecialchars($direccion);
		$this->color_fondo = htmlspecialchars($color_fondo);
	}

	public function insertar($opcion) {
		if (get_class($opcion) == 'Opcion') {
			array_push($this->opciones, $opcion);			
		}
	}

	public function dibujar() {
		echo '<div style="display: flex; background-color:' . $this->color_fondo . ';';
		if (strtolower($this->direccion) == 'horizontal') {
			echo 'flex-direction: row; width: 100%';
		} elseif (strtolower($this->direccion) == 'vertical') {
			echo 'flex-direction: column';
		}
		echo '">';
		for ($i=0; $i < sizeof($this->opciones); $i++) { 
			$this->opciones[$i]->dibujar();
		}
		echo '</div>';
	}
}

$opcion1 = new Opcion('Google', 'http://www.google.com', 'black', 'aquamarine');
$opcion2 = new Opcion('Yahoo', 'http://www.yahoo.com', 'red', 'yellow');
$opcion3 = new Opcion('Wikipedia', 'http://www.wikipedia.org', 'white', 'black');
$menu = new Menu('horizontal', 'aquamarine');
$menu->insertar($opcion1);
$menu->insertar($opcion2);
$menu->insertar($opcion3);
$menu->dibujar();

?>
</body>
</html>