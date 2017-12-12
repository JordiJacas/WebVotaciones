<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	$row = $_SESSION['row'];
	
	include 'funcions.php';
	$pdo = connectar();
	
	echo(crearHash());
?>
</body>
</html>
