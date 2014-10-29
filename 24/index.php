<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

define('IMG_FOLDER', 'img/');

class Movie {
	private $title;
	private $image;

	public function __construct($title, $image) {
		$this->title = $title;
		$this->image = $image;
	}

	public function paint() {
		echo '<div style="float:left; align:center; margin:20px">';
			echo '<center><img src="' . $this->image . '" height="250px"></center>';
			echo '<center><b style="color: white">' . $this->title . '</b></center>';
		echo '</div>';
	}
}

$movies = array(
		new Movie('Alguien a quien amar', IMG_FOLDER . 'Alguien-a-quien-amar-2014.jpg'),
		new Movie('Antes del frío invierno', IMG_FOLDER . 'antesdelfrioinvierno.jpg'),
		new Movie('Black Coal', IMG_FOLDER . 'black-coal-espana.jpg'),
		new Movie('Boyhood', IMG_FOLDER . 'boyhood-momentos-de-una-vida-espana.jpg'),
		new Movie('Dioses y perros', IMG_FOLDER . 'dioses_y_perros.jpg'),
		new Movie('La desaparición de Eleanor Rigby', IMG_FOLDER . 'la-desaparicion-de-eleanor-rigby-espana.jpg'),
		new Movie('La gran seducción', IMG_FOLDER . 'lagranseducciona41_grande.jpg'),
		new Movie('Magical Girl', IMG_FOLDER . 'Magical_Girl.jpg'),
		new Movie('Slimane', IMG_FOLDER . 'Slimane.jpg'),
		new Movie('Un viaje de diez metros', IMG_FOLDER . 'un-viaje-de-diez-metros-espana.jpg'),
		new Movie('Viajo sola', IMG_FOLDER . 'viajo_sola.jpg'),
		new Movie('Winter Sleep (Sueño de invierno)', IMG_FOLDER . 'winter_sleep.jpg')
	);

$rand_keys = array_rand($movies, 3);

echo '<div style="width:100%; overflow:auto; background-color:navy">';
foreach ($rand_keys as $key => $value) {
	$movies[$value]->paint();
}
echo '</div>';

?>
</body>
</html>