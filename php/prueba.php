<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	//$row = $_SESSION['row'];
	
	include 'funcions.php';
	$pdo = connectar();
	
	mostrarTodasConsultas($pdo,1,false);

?>
</body>
</html>
