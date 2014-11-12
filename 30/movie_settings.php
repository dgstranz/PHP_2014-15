<?php

define('IMG_FOLDER', 'img/');
define('MAX_SIZE', 2500000);

$movie_file = 'movies.csv';

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

$movies = array();

function load_movies() {
	global $movie_file;
	global $movies;
	$handle = fopen($movie_file, "r");
	$row = 1;
	while (($data = fgetcsv($handle, 1000, ",", "'")) != false) {
		array_push($movies, new Movie($data[0], $data[1]));
		$row++;
	}
	fclose($handle);
}

load_movies($movie_file);

function add_movie($movie_entry) {
	global $movie_file;
	global $movies;
	$handle = fopen($movie_file, "a");
	fwrite($handle, "'$movie_entry[0]','$movie_entry[1]'\n");
	array_push($movies, new Movie($movie_entry[0], $movie_entry[1]));
	fclose($handle);
}

?>