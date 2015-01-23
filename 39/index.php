<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

class Tabla {
	private $filas;
	private $columnas;
	private $datos;
	private $estilo;

	public function __construct($filas, $columnas) {
		$this->filas = htmlspecialchars($filas);
		$this->columnas = htmlspecialchars($columnas);
		$this->datos = array();
		$this->estilo = array('table' => array(),
			'tr' => array(),
			'th' => array(),
			'td' => array());

		for ($i=0; $i < $filas; $i++) { 
			$this->datos[$i] = array();
		}
	}

	public function cargar($fila, $columna, $valor) {
		if ($fila == htmlspecialchars($fila)
			&& $columna == htmlspecialchars($columna)) {
			
			$this->datos[$fila][$columna] = $valor;
		}
	}

	public function modificar_estilo($elemento, $atributo, $valor) {
		if ($elemento == htmlspecialchars($elemento)
			&& $atributo == htmlspecialchars($atributo)
			&& $valor == htmlspecialchars($valor)) {
			
			$this->estilo[$elemento][$atributo] = $valor;
		}
	}

	public function mostrar() {
		echo '<table';
		foreach ($this->estilo['table'] as $key => $value) {
			echo ' ' . $key . '="' . $value . '"';
		}
		echo '>';
		for ($i=0; $i < $this->filas; $i++) { 
			echo '<tr';
			foreach ($this->estilo['tr'] as $key => $value) {
				echo ' ' . $key . '="' . $value . '"';
			}
			echo '>';
			for ($j=0; $j < $this->columnas; $j++) { 
				echo '<td';
				foreach ($this->estilo['td'] as $key => $value) {
					echo ' ' . $key . '="' . $value . '"';
				}
				echo '>';
				echo $this->datos[$i][$j];
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
}

$num_fil = 15;
$num_col = 15;
$tabla = new Tabla($num_fil, $num_col);

for ($i=0; $i < $num_fil; $i++) { 
	for ($j=0; $j < $num_col; $j++) { 
		$tabla->cargar($i, $j, $i * $j);
	}
}

$tabla->modificar_estilo('table', 'border', '2px');
$tabla->modificar_estilo('td', 'border', '1px');
$tabla->modificar_estilo('td', 'bgcolor', '#f0f0d0');

$tabla->mostrar();

var_dump($tabla);


?>
</body>
</html>