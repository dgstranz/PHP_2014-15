<?php
class Pelicula {
	private $titulo;
	private $genero;
	private $anyo;
	private $protagonista;
	private $director;

	public function __construct($titulo, $genero, $anyo, $protagonista, $director) {
		$this->titulo = $titulo;
		$this->genero = $genero;
		$this->anyo = $anyo;
		$this->protagonista = $protagonista;
		$this->director = $director;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}

class Persona {
	private $nombre;
	private $esActor;
	private $esDirector;

	public function __construct($nombre, $esActor, $esDirector) {
		$this->nombre = $nombre;
		$this->esActor = $esActor;
		$this->esDirector = $esDirector;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}
}
?>
