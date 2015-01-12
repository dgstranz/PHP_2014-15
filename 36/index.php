<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
</head>
<body>

<?php
session_start();

if(!isset($_SESSION['identificativo'])) {
	header('Location: acreditar.php');
} elseif (isset($_GET['fin']) && $_GET['fin'] == 1) {
	$_SESSION = array();
	setcookie('PHPSESSID', '', time() - 3600);
	session_destroy();
	header('Location: acreditar.php');
} else {
	echo 'Bienvenido, ' . $_SESSION['identificativo'] . '.';
}
?>

<ul>
	<li><a href="http://www.google.com">Ver información</a></li>
	<li><a href="acreditar.php">Acreditar</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?fin=1">Terminar sesión</a></li>
</ul>

</hody>
</html>