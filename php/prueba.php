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
	
	mostrarResultados($pdo,32,1,'55133c9aa03017a76fd569121c2aea86e981d43a');

?>
</body>
</html>
