<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Usuarios</p>
<?php
	include 'funcions.php';
	$pdo = connectar();
	$aa = countResultado($pdo, 31);
	echo($aa);
?>
</body>
</html>
