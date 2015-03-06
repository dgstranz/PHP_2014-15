<?php
class Producto {
	private $id;
	private $nombre;
	private $desc;
	private $p_unit;

	public function __construct($id, $nombre, $desc, $p_unit) {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->desc = $desc;
		$this->p_unit = $p_unit;
	}

	public function get_id() {
		return $this->id;
	}
	public function get_nombre() {
		return $this->nombre;
	}
	public function get_desc() {
		return $this->desc;
	}
	public function get_precio() {
		return $this->p_unit;
	}
}

class Carrito {
	private $num_prod;
	private $prods;

	public function __construct() {
		$this->num_prod = 0;
		$this->prods = array();
	}

	public function introduce_producto($producto, $cantidad) {
		if ($cantidad < 0) {
			return false;
		}

		$pos = $producto->get_id();

		if (isset($this->prods[$pos])) {
			$this->prods[$pos]['cantidad'] += $cantidad;
		} else {
			$this->prods[$pos] = array('producto' => $producto, 'cantidad' => $cantidad);
		}


		$this->num_prod = sizeof($this->prods);
	}

	public function elimina_producto($producto) {
		$pos = $producto->get_id();
		unset($this->prods[$pos]);
		$this->num_prod = sizeof($this->prods);
	}

	public function visualizar() {
		$precio_total = 0;
		echo '<table>';
		foreach ($this->prods as $id => $item) {

			$precio_producto = $item['producto']->get_precio() * $item['cantidad'];

			echo '<tr>';
				echo '<td>' . $id . '</td>';
				echo '<td>' . $item['producto']->get_nombre() . '</td>';
				echo '<td>' . $item['producto']->get_precio() . ' € </td>';
				echo '<td>' . $item['cantidad'] . '</td>';
				echo '<td>' . $precio_producto . ' € </td>';
			echo '</tr>';

			$precio_total += $precio_producto;
		}

		echo '<tr>';
		echo '<td colspan="4"></td>';
		echo '<td>' . $precio_total . ' € </td>';
		echo '</tr>';
		echo '</table>';
	}
}

?>
