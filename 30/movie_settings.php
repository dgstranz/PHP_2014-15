<?php

define('IMG_FOLDER', 'img/');
define('MAX_SIZE', 2500000);

class Movie {
	private $title;
	private $image;

	public function __construct($title, $image) {
		$this->title = $title;
		$this->image = $image;
	}

	public function paint() {
		echo '<div style="float:left; align:center; margin:20px">';
			echo '<center><img src="' . IMG_FOLDER . $this->image . '" height="250px"></center>';
			echo '<center><b style="color: white">' . $this->title . '</b></center>';
		echo '</div>';
	}
}

$movies = array(
		new Movie('Alguien a quien amar', 'Alguien-a-quien-amar-2014.jpg'),
		new Movie('Antes del frío invierno', 'antesdelfrioinvierno.jpg'),
		new Movie('Black Coal', 'black-coal-espana.jpg'),
		new Movie('Boyhood', 'boyhood-momentos-de-una-vida-espana.jpg'),
		new Movie('Dioses y perros', 'dioses_y_perros.jpg'),
		new Movie('La desaparición de Eleanor Rigby', 'la-desaparicion-de-eleanor-rigby-espana.jpg'),
		new Movie('La gran seducción', 'lagranseducciona41_grande.jpg'),
		new Movie('Magical Girl', 'Magical_Girl.jpg'),
		new Movie('Slimane', 'Slimane.jpg'),
		new Movie('Un viaje de diez metros', 'un-viaje-de-diez-metros-espana.jpg'),
		new Movie('Viajo sola', 'viajo_sola.jpg'),
		new Movie('Winter Sleep (Sueño de invierno)', 'winter_sleep.jpg')
	);

?>