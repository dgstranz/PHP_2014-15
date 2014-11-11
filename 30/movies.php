<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

include_once 'movie_settings.php';

$rand_keys = array_rand($movies, 3);

echo '<div style="width:100%; overflow:auto; background-color:navy">';
foreach ($rand_keys as $key => $value) {
	$movies[$value]->paint();
}
echo '</div>';

?>
</body>
</html>