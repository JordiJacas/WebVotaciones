<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<title>Web Votaciones</title>
</head>
<body>
<?php
	session_start();
	
	print_r($_SESSION['row']);
	$row = $_SESSION['row'];
?>
	<div id = "principal">
		<nav>
			<p><?php echo $row['nombre'] . " " . $row['apellido']; ?></p>
			<a href="longout.php">Cerrar Session</a>
		</nav>
	</div>


</body>
</html>