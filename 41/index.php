<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

class Empleado {
	protected static $num_emp = 0;
	public $id;
	public $nombre;
	public $puesto;
	public $sueldo;

	public function __construct($nombre, $puesto, $sueldo) {
		self::$num_emp++;
		$this->id = self::$num_emp;
		$this->nombre = $nombre;
		$this->puesto = $puesto;
		$this->sueldo = $sueldo;
	}

	public function mostrar() {
		echo '<h2>'. $this->nombre . '</h2>';
		echo '<ul>';
		echo '<li>ID: ' . $this->id . '</li>';
		echo '<li>Puesto: '. $this->puesto . '</li>';
		echo '<li>Sueldo: '. $this->sueldo . '</li>';
		echo '</ul>';
	}
}

$emp1 = new Empleado('Fulano Martínez', 'Analista', 18000);
$emp2 = new Empleado('Mengano Pérez', 'Programador', 23000);
$emp3 = new Empleado('Zutano Gómez', 'Director de proyecto', 28000);

$emp3->mostrar();
$emp2->mostrar();
$emp1->mostrar();

?>
</body>
</html>